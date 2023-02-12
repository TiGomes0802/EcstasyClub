<?php

namespace backend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use common\models\Disco;
use common\models\DiscoSearch;
use common\models\Eventos;
use common\models\EventosSearch;
use common\models\EventosUpdate;
use common\models\Pulseiras;
use common\models\PulseirasSearch;
use common\models\Userprofile;
use common\models\UserprofileSearch;

/**
 * EventosController implements the CRUD actions for Eventos model.
 */
class EventosController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        $model = new Eventosupdate();
        $model->UpdateEstadoEvento();
        
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                ],
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'actions' => ['index', 'view', 'create', 'update'],
                            'allow' => true,
                            'roles' => ['gestor','admin'],
                        ],
                    ],
                    'denyCallback' => function ($rule, $action) {
                        Yii::$app->user->logout();
                        return $this->redirect(['site/login']);
                    }
                ],
            ]
        );
    }

    public function actionIndex($estado)
    {
        if (\Yii::$app->user->can('viewEvento')) {

            $model = Eventos::find()
                ->where(['estado' => $estado])
                ->orderBy(['dataevento' => SORT_DESC]);

            $searchModel = new ActiveDataProvider([
                'query' => $model,
                'pagination' => [
                    'pageSize' => 25,
                ],
            ]);

            if($estado == "ativo"){
                return $this->render('index', [
                    'searchModel' => $searchModel,
                ]);
            }else {
                if($estado == "desativo" or $estado == "cancelado") {
                    return $this->render('indexDesaCanc', [
                        'searchModel' => $searchModel,
                    ]);
                }
            }
                

        }else{
            return $this->render('/site/logout', [
                'model' => $this->findModel($id),
            ]);
        }
    }


    public function actionView($id)
    {
        if (\Yii::$app->user->can('viewEvento')) {
            
            $model = $this->findModel($id);

            $valorfaturado = Pulseiras::find()
                ->rightJoin('faturas', 'pulseiras.id = faturas.id_pulseira')
                ->where(['pulseiras.id_evento' => $model->id])
                ->sum('faturas.preco');


            $numbilhetesvendidos = Pulseiras::find()
                ->where(['pulseiras.id_evento' => $model->id])
                ->count();

            $grafico = (new yii\db\Query())
                ->from('userprofile')
                ->select(['sexo', 'COUNT(sexo) AS quantidade'])
                ->leftJoin('user', 'user.id = userprofile.user_id')
                ->leftJoin('auth_assignment', 'auth_assignment.user_id = user.id')
                ->leftJoin('pulseiras', 'pulseiras.id_cliente = userprofile.id')
                ->where(['pulseiras.id_evento' => $model->id])
                ->orderBy(['sexo'=>SORT_ASC])
                ->groupBy('sexo')
                ->all();

            $grafico2 = (new yii\db\Query())
                ->from('pulseiras')
                ->select(['codigorp', 'COUNT(codigorp) AS quantidade'])
                ->where(['pulseiras.id_evento' => $model->id])
                ->andwhere(['!=', 'pulseiras.codigorp', 'null'])
                ->groupBy('codigorp')
                ->all();

            return $this->render('view', [
                'model' => $model,
                'numbilhetesvendidos' => $numbilhetesvendidos,
                'valorfaturado' => $valorfaturado,
                'grafico' => $grafico,
                'grafico2' => $grafico2,
            ]);
            
        }else{
            return $this->render('/site/logout', [
                'model' => $this->findModel($id),
            ]);
        }
    }


    public function actionCreate()
    {
        $disco = Disco::findOne(1);

        if (\Yii::$app->user->can('createEvento')) {

            $model = new Eventos();

            if ($this->request->isPost && $model->load($this->request->post())) {

                $userprofile = Userprofile::find()->where(['user_id' => Yii::$app->user->getId()])->one();

                $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
                
                if($model->imageFile != null){
                    $model->cartaz =  str_replace(' ', '', $model->nome) . date("Ymdhisv") . '.' . $model->imageFile->extension;
                }

                $model->id_tipo_evento = (int)$model->id_tipo_evento;
                $model->id_criador = $userprofile->id;
                
                $input = strtotime($model->dataevento);
                $newdatetime = date('Y-m-d H:i',$input);

                $model->dataevento = $newdatetime;
                $model->estado = "ativo";

                if ($model->save()) {
                    
                    $directoryName = 'cartaz/';
                    
                    if (!file_exists($directoryName)) {
                        mkdir($directoryName, 0777, true);
                    }

                    $model->imageFile->saveAs($directoryName . $model->cartaz);
                    
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } else {
                $model->loadDefaultValues();
            }

            return $this->render('create', [
                'model' => $model,
                'disco' => $disco,
            ]);

        }else{
            return $this->rende('/site/logout', [
                'model' => $this->findModel($id),
            ]);
        }
    }


    public function actionUpdate($id)
    {
        if (\Yii::$app->user->can('updateEvento')) {

            $model = $this->findModel($id);
            
            if($model->estado == 'ativo'){
                if ($this->request->isPost && $model->load($this->request->post())) {

                    $input = strtotime($model->dataevento);
                    $newdatetime = date('Y-m-d H:i',$input);
                    $model->dataevento = $newdatetime;

                    $model->imageFileUpdate = UploadedFile::getInstance($model, 'imageFileUpdate');
                    
                    $model->imageFile = 'nada.png';

                    $model->id_tipo_evento = (int)$model->id_tipo_evento;
                    
                    if($model->validate() && $model->estado == 'cancelado'){
                        $pulseiras = Pulseiras::find()->where(['id_evento' => $model->id])->all();
                        foreach($pulseiras as $pulseira){
                            $pulseiraupdate = Pulseiras::findOne($pulseira->id);
                            $pulseiraupdate->estado = 'cancelada';
                            $pulseiraupdate->save();
                        }
                    }
                    if ($model->save()) {
                        
                        if($model->imageFileUpdate != null){
                            //unlink('cartaz/' . $model->cartaz);
                            $model->imageFileUpdate->saveAs('cartaz/' . $model->cartaz);
                        }
                        
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                }

                return $this->render('update', [
                    'model' => $model,
                ]);
            }else{
                return $this->redirect(['index', 'estado' => 'ativo']);
            }  

        }else{
            Yii::$app->user->logout();
            return $this->redirect(['site/login']);
        }
    }

    protected function findModel($id)
    {
        if (($model = Eventos::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


}
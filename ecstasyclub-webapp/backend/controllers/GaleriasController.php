<?php

namespace backend\controllers;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;    
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use common\models\Galerias;
use common\models\GaleriasSearch;
use common\models\Eventos;
use common\models\EventosSearch;
use common\models\EventosUpdate;

/**
 * GaleriasController implements the CRUD actions for Galerias model.
 */
class GaleriasController extends Controller
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
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'actions' => ['index', 'view', 'create', 'delete'],
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


    public function actionIndex($id_evento)
    {
        if (\Yii::$app->user->can('viewGaleria')) {
      
            $evento = Eventos::findOne(['id' => $id_evento]);

            if($evento->estado == 'desativo'){

                $model = Galerias::find()->where(['id_evento' => $id_evento]);

                $searchModel = new ActiveDataProvider([
                    'query' => $model,
                    'pagination' => [
                        'pageSize' => 25,
                    ],
                ]);

                return $this->render('index', [
                    'searchModel' => $searchModel,
                    'evento' => $evento,
                ]);

            }else{
                return $this->redirect(['eventos/index', 'estado' => 'ativo']);
            }  

        }else{
            Yii::$app->user->logout();
            return $this->redirect(['site/login']);
        }
    }


    public function actionView($id)
    {
        if (\Yii::$app->user->can('viewGaleria')) {

            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);

        }else{
            Yii::$app->user->logout();
            return $this->redirect(['site/login']);
        }
    }


    public function actionCreate($id_evento)
    {

        if (\Yii::$app->user->can('adicionarGaleria')) {

            $modelfotos = new Galerias();
            $evento = Eventos::findOne(['id' => $id_evento]);
            if ($this->request->isPost && $modelfotos->load($this->request->post())) {
                $modelfotos->imageFile = UploadedFile::getInstances($modelfotos, 'imageFile');
                $directoryName = 'galeria/' . $id_evento . '/';
                if (!file_exists($directoryName)) {
                    mkdir($directoryName, 0777, true);
                }
                foreach($modelfotos->imageFile as $image){
                    $model = new Galerias();
                    $model->id_evento = (int)$id_evento;
                    $model->foto = date("Ymdhis") . time().rand(10,999999999) . '.' . $image->extension;
                    if ($model->save()) {
                        $image->saveAs($directoryName . $model->foto);
                    } else{
                        return $this->render('create', [
                            'model' => $model,
                            'evento' => $evento,
                        ]);
                    }
                }
                return $this->redirect(['index', 'id_evento' => $id_evento]);
            }
            return $this->render('create', [
                'model' => $modelfotos,
                'evento' => $evento,
            ]);

        }else{
            Yii::$app->user->logout();
            return $this->redirect(['site/login']);
        }
    }


    public function actionDelete($id)
    {
        if (\Yii::$app->user->can('deleteGaleria')) {

            $model = $this->findModel($id);
            unlink('galeria/'. $model->id_evento . '/' . $model->foto);
            $this->findModel($id)->delete();

            return $this->redirect(['index', 'id_evento' => $model->id_evento]);

        }else{
            Yii::$app->user->logout();
            return $this->redirect(['site/login']);
        }
    }


    protected function findModel($id)
    {
        if (($model = Galerias::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

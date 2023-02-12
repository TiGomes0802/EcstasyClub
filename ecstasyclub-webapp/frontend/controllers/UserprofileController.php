<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\Html;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\EventosUpdate;
use frontend\models\SignupForm;
use common\models\Userprofile;
use common\models\UserprofileSearch;
use common\models\Faturas;
use common\models\FaturasSearch;

/**
 * UserprofileController implements the CRUD actions for Userprofile model.
 */
class UserprofileController extends Controller
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
                            'actions' => ['view', 'update', 'update_password'],
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
            ]
        );
    }

    /**
     * Displays a single Userprofile model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView()
    {
        $userprofile = Userprofile::find()->where(['user_id' => Yii::$app->user->id])->one();
        
        $grafico = (new yii\db\Query())
            ->from('eventos')
            ->select(['tipoevento.tipo AS item_name', 'COUNT(pulseiras.codigorp) AS quantidade_item_name'])
            ->leftJoin('pulseiras', 'pulseiras.id_evento = eventos.id')
            ->leftJoin('tipoevento', 'tipoevento.id = eventos.id_tipo_evento')
            ->where(['pulseiras.codigorp' => $userprofile->codigoRP])
            ->groupBy('tipoevento.tipo')
            ->all();
        
        $grafico2 = (new yii\db\Query())
            ->from('userprofile')
            ->select(['sexo', 'COUNT(pulseiras.codigorp) AS quantidade'])
            ->leftJoin('user', 'user.id = userprofile.user_id')
            ->leftJoin('pulseiras', 'pulseiras.id_cliente = userprofile.id')
            ->leftJoin('auth_assignment', 'auth_assignment.user_id = user.id')
            ->where(['pulseiras.codigorp' => $userprofile->codigoRP])
            ->orderBy(['sexo'=>SORT_ASC])
            ->groupBy('sexo')
            ->all();

        $listaeventos = (new yii\db\Query())
            ->from('eventos')
            ->select(['eventos.nome AS nome', 'eventos.dataevento AS dataevento', 'COUNT(pulseiras.codigorp) AS quantidade_codigos'])
            ->leftJoin('pulseiras', 'pulseiras.id_evento = eventos.id')
            ->where(['pulseiras.codigorp' => $userprofile->codigoRP])
            ->orderBy(['eventos.dataevento'=>SORT_DESC])
            ->groupBy('eventos.nome')
            ->all();

        $faturas = Faturas::find()
            ->leftJoin('pulseiras', 'pulseiras.id = faturas.id_pulseira')
            ->where(['pulseiras.id_cliente' => $userprofile->id])
            ->all();

        return $this->render('view', [
            'model' => $userprofile,
            'grafico' => $grafico,
            'grafico2' => $grafico2,
            'listaeventos' => $listaeventos,
            'faturas' => $faturas,
        ]);
    }


    /**
     * Updates an existing Userprofile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = new SignupForm();

        $model = $model->loadingdados($id);

        if ($model->load($this->request->post()) && $model->updateload($id)) {
            return $this->redirect(['view', 'id' => $id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionUpdate_password($id)
    {
        $model = new SignupForm();

        $model = $model->loadingdados($id);

        if ($model->load($this->request->post()) && $model->updateload($id)) {
            if(Yii::$app->user->getId() == $id){
                return $this->redirect(['/site/login']);
            }else{
                return $this->redirect(['view', 'id' => $id]);
                die;
            }
        }

        return $this->render('update_password', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the Userprofile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Userprofile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Userprofile::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

<?php

namespace frontend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\Eventos;
use common\models\EventosSearch;
use common\models\EventosUpdate;
use common\models\Vip;
use common\models\VipSearch;
use common\models\VipPulseira;
use common\models\VipPulseiraSearch;
use common\models\Pulseiras;
use common\models\PulseirasSearch;
use common\models\Userprofile;
use common\models\UserprofileSearch;

/**
 * PulseirasController implements the CRUD actions for Pulseiras model.
 */
class PulseirasController extends Controller
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
                            'actions' => ['comprar'],
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                    'denyCallback' => function ($rule, $action) {
                        return $this->redirect(['site/login']);
                    }
                ],
            ]
        );
    }


    public function actionComprar($id_evento, $codigorp)
    {
        $user = Userprofile::find()->where(['user_id' => Yii::$app->user->id])->one();
        $pulseira = Pulseiras::find()->where(['id_evento' =>  $id_evento])->andwhere(['id_cliente' =>  $user->id])->one();
        $evento2 = Eventos::find()->where(['estado' => 'ativo'])->andwhere(['id' =>  $id_evento])->one();
        $evento = Eventos::findOne($id_evento);
        $codigorpvalido = Userprofile::find()->where(['codigorp' => $codigorp])->one();
        

        if($pulseira == null && $evento2 != null && ($codigorpvalido != null or $codigorp == null) && $evento->numbilhetesdisp > 0){
            $model = new Pulseiras();
            
            $id_de_vips_ocupados = VipPulseira::find()
                ->leftJoin('pulseiras', 'pulseiras.id = vip_pulseira.id_pulseira')
                ->where(['pulseiras.id_evento' => $id_evento])
                ->all();
    
            $id_de_vips=[];
    
            foreach($id_de_vips_ocupados as $i){
                array_push($id_de_vips, $i->id_vip);
            }
    
            $listavips = Vip::find()->orderBy(['preco'=>SORT_ASC])->all();
    
            return $this->render('comprar', [
                'model' => $model,
                'evento' => $evento,
                'codigorp' => $codigorp,
                'id_de_vips' => $id_de_vips,
                'listavips' => $listavips,
            ]);
        }else{
            return $this->redirect(['eventos/view', 'id' => $id_evento]);
        }
    }

    protected function findModel($id)
    {
        if (($model = Pulseiras::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

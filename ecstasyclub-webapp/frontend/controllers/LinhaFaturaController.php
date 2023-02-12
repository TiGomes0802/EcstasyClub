<?php

namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\Eventos;
use common\models\EventosSearch;
use common\models\EventosUpdate;
use common\models\Faturas;
use common\models\FaturasSearch;
use common\models\Linhafatura;
use common\models\LinhafaturaSearch;
use common\models\Pulseiras;
use common\models\PulseirasSearch;
use common\models\Userprofile;
use common\models\UserprofileSearch;
use common\models\Vip;
use common\models\VipSearch;
use common\models\VipPulseira;
use common\models\VipPulseiraSearch;

/**
 * LinhafaturaController implements the CRUD actions for LinhaFatura model.
 */
class LinhafaturaController extends Controller
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
                            'actions' => ['create'],
                            'allow' => true,
                            'roles' => ['@'],
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

    public function actionCreate($id_evento, $codigorp, $id_vip)
    {
        $user = Userprofile::find()->where(['user_id' => Yii::$app->user->id])->one();
        $pulseira = Pulseiras::find()->where(['id_evento' =>  $id_evento])->andwhere(['id_cliente' =>  $user->id])->one();
        $evento2 = Eventos::find()->where(['estado' => 'ativo'])->where(['id' =>  $id_evento])->one();
        $evento = Eventos::findOne($id_evento);
        $codigorpvalido = Userprofile::find()->where(['codigorp' => $codigorp])->one();

        $id_de_vips_ocupados = VipPulseira::find()
            ->leftJoin('pulseiras', 'pulseiras.id = vip_pulseira.id_pulseira')
            ->where(['pulseiras.id_evento' => $id_evento])
            ->all();

        $id_de_vips=[];

        foreach($id_de_vips_ocupados as $i){
            array_push($id_de_vips, $i->id_vip);
        }

        if($pulseira == null && !in_array($id_vip,$id_de_vips) && $evento->numbilhetesdisp > 0 && $evento2 != null && ($codigorpvalido != null or $codigorp == null)){
        
            $linhasfaturas = new LinhaFatura();
            $fatura = new Faturas();
            $pulseira = new Pulseiras();
            $reserva_vip =  new VipPulseira();

            $vip = Vip::findOne($id_vip);
    
            if ($this->request->isPost && $linhasfaturas->load($this->request->post())) {
                
                $session = Yii::$app->session;
                $session->set('bebidas', $linhasfaturas->bebidas);
                
                return $this->redirect(['faturas/finalizarcomprav', 'id_evento' => $id_evento, 'codigorp'=> $codigorp, 'id_vip' => $id_vip]);

            } else {
                $linhasfaturas->loadDefaultValues();
            }
    
            return $this->render('create', [
                'model' => $linhasfaturas,
                'ngarrafas' => $vip->nbebidas,
            ]);

        }else{
            return $this->redirect(['eventos/view', 'id' => $id_evento]);
        }
    }

    protected function findModel($id)
    {
        if (($model = LinhaFatura::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

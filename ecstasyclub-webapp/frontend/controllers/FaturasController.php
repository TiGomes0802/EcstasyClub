<?php

namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use frontend\models\Finalizarcompra;
use common\models\Disco;
use common\models\DiscoUpdate;
use common\models\Eventos;
use common\models\EventosUpdate;
use common\models\EventosSearch;
use common\models\Faturas;
use common\models\FaturasSearch;
use common\models\Pulseiras;
use common\models\PulseirasSearch;
use common\models\LinhaFatura;
use common\models\LinhaFaturaSearch;
use common\models\Userprofile;
use common\models\UserprofileSearch;
use common\models\Vip;
use common\models\VipSearch;
use common\models\VipPulseira;
use common\models\VipPulseiraSearch;


/**
 * FaturasController implements the CRUD actions for Faturas model.
 */
class FaturasController extends Controller
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
                            'actions' => ['view', 'create', 'finalizarcompra', 'finalizarcomprav', 'fatura'],
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

    public function actionCreate($id_evento, $codigorp)
    {
        $user = Userprofile::find()->where(['user_id' => Yii::$app->user->id])->one();
        $pulseira = Pulseiras::find()->where(['id_evento' =>  $id_evento])->andwhere([ 'id_cliente' =>  $user->id])->one();
        $codigorpvalido = Userprofile::find()->where(['codigorp' => $codigorp])->one();
        $evento = EventosUpdate::findOne($id_evento);

        if($pulseira == null && ($codigorpvalido != null or $codigorp == null && $evento->numbilhetesdisp > 0)){

            $fatura = new Faturas();
            $pulseira = new Pulseiras();

            $pulseira->estado = 'ativa';
            $pulseira->tipo = 'normal';
            if($codigorp != null){
                $pulseira->codigorp = $codigorp;
            }

            $pulseira->id_evento = $evento->id;
            $pulseira->id_cliente = $user->id;
            $pulseira->save(false);

            $fatura->datahora_compra = date("Y-m-d H:i:s");
            $fatura->preco = $evento->preco;
            $fatura->id_pulseira = $pulseira->id;

            $evento->numbilhetesdisp -= 1;
            $date = strtotime($evento->dataevento);
            $evento->dataevento = date('Y-m-d H:i', $date); 

            if ($evento->save() && $pulseira->save() && $fatura->save()) {    
                return $this->redirect(['eventos/view', 'id' => $id_evento]);
            }

            return $this->redirect(['eventos/view', 'id' => $id_evento]);
        }else{
            return $this->redirect(['eventos/view', 'id' => $id_evento]);
        }
    }

    public function actionFinalizarcompra($id_evento, $codigorp)
    {
        $model = new Finalizarcompra();
        $user = Userprofile::find()->where(['user_id' => Yii::$app->user->id])->one();
        $pulseira = Pulseiras::find()->where(['id_evento' =>  $id_evento])->andwhere([ 'id_cliente' =>  $user->id])->one();
        $codigorpvalido = Userprofile::find()->where(['codigorp' => $codigorp])->one();
        $evento = EventosUpdate::findOne($id_evento);

        $model->nome = $user->nome;
        $model->apelido = $user->apelido;
        $model->email = $user->user->email;
        $model->titularcartao = $user->nome . " " . $user->apelido;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if($pulseira == null && ($codigorpvalido != null or $codigorp == null && $evento->numbilhetesdisp > 0)){

                $fatura = new Faturas();
                $pulseira = new Pulseiras();

                $pulseira->estado = 'ativa';
                $pulseira->tipo = 'normal';
                if($codigorp != null){
                    $pulseira->codigorp = $codigorp;
                }

                $pulseira->id_evento = $evento->id;
                $pulseira->id_cliente = $user->id;
                $pulseira->save(false);

                $fatura->datahora_compra = date("Y-m-d H:i:s");
                $fatura->preco = $evento->preco;
                $fatura->id_pulseira = $pulseira->id;

                $evento->numbilhetesdisp -= 1;
                $date = strtotime($evento->dataevento);
                $evento->dataevento = date('Y-m-d H:i', $date); 

                if ($evento->save() && $pulseira->save() && $fatura->save()) {    
                    return $this->redirect(['eventos/view', 'id' => $id_evento]);
                }

                return $this->redirect(['eventos/view', 'id' => $id_evento]);
            }else{
                return $this->redirect(['eventos/view', 'id' => $id_evento]);
            }
        }

        return $this->render('finalizar_compra', [
            'model' => $model,
        ]);

    }

    public function actionFinalizarcomprav($id_evento, $codigorp, $id_vip)
    {
        $model = new Finalizarcompra();
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

        $model->nome = $user->nome;
        $model->apelido = $user->apelido;
        $model->email = $user->user->email;
        $model->titularcartao = $user->nome . " " . $user->apelido;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if($pulseira == null && !in_array($id_vip,$id_de_vips) && $evento->numbilhetesdisp > 0 && $evento2 != null && ($codigorpvalido != null or $codigorp == null)){
        
                $linhasfaturas = new LinhaFatura();
                $fatura = new Faturas();
                $pulseira = new Pulseiras();
                $reserva_vip =  new VipPulseira();
    
                $vip = Vip::findOne($id_vip);

                $session = Yii::$app->session;
                $bebidas = $session->get('bebidas');

                $pulseira->estado = 'ativa';
                $pulseira->tipo = 'vip';

                if($codigorp != null){
                    $pulseira->codigorp = $codigorp;
                }
                $pulseira->id_evento = intval($id_evento);
                $pulseira->id_cliente = $user->id;
                $pulseira->save(false);
                
                
                $reserva_vip->id_pulseira = $pulseira->id;
                $reserva_vip->id_vip = $vip->id;
    
                $fatura->datahora_compra = date("Y-m-d H:i:s");
                $fatura->preco = $vip->preco;
                $fatura->id_pulseira = $pulseira->id;
                $fatura->save(false);
    
                foreach($bebidas as $bebida){
                    $novalinha = new LinhaFatura();
                    $novalinha->id_bebida = $bebida;
                    $novalinha->id_fatura = $fatura->id;
                    $novalinha->bebidas = $bebida;
                    $novalinha->save();
                }
                
                $evento->numbilhetesdisp = $evento->numbilhetesdisp - 1;
                $input = strtotime($evento->dataevento);
                $newdatetime = date('Y-m-d H:i', $input);
                $evento->dataevento = $newdatetime;
                $evento->imageFile = 'nada.png';

                if ($pulseira->save() && $fatura->save() && $reserva_vip->save() && $evento->save()) {    
                    return $this->redirect(['eventos/view', 'id' => $id_evento]);
                }

                if ($evento->save() && $pulseira->save() && $fatura->save()) {    
                    return $this->redirect(['eventos/view', 'id' => $id_evento]);
                }

                return $this->redirect(['eventos/view', 'id' => $id_evento]);
            }else{
                return $this->redirect(['eventos/view', 'id' => $id_evento]);
            }
        }

        return $this->render('finalizar_compra', [
            'model' => $model,
        ]);

    }

    public function actionView($id_fatura)
    {
        $disco = Disco::findOne(1);
        $fatura = Faturas::findOne($id_fatura);
        $linhasfatura = LinhaFatura::find()->where(['id_fatura' => $id_fatura])->all();

        return $this->render('view', [
            'disco' =>  $disco,
            'fatura' =>  $fatura,
            'linhasfatura' =>  $linhasfatura,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Faturas::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

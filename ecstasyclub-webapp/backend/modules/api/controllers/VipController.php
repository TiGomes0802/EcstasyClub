<?php

namespace backend\modules\api\controllers;

use Yii;
use common\models\Vip;
use common\models\VipPulseira;
use common\models\Eventos;

class VipController extends \yii\web\Controller
{
    public function actionViewvip($id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $vippulseira = VipPulseira::find()->where(['id_pulseira' => $id])->one();
        $infovip = Vip::find($vippulseira->id_vip)->one();

        $vip = (object) [
            'id' => $infovip->id,
            'npessoas' => $infovip->npessoas,
            'nbebidas' => $infovip->nbebidas,
            'preco' => $infovip->preco,
          ];

        return $vip;
    }

    public function actionVipsocupados($id_evento)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $vips_ocupados = VipPulseira::find()
            ->leftJoin('pulseiras', 'pulseiras.id = vip_pulseira.id_pulseira')
            ->where(['pulseiras.id_evento' => $id_evento])
            ->all();

        $vips = Vip::find()->orderby(['preco'=>SORT_ASC])->all();
        $evento = Eventos::findOne($id_evento);

        $vips_livres = array();

        array_push($vips_livres,array('id' => 0,'npessoas' => 1,'nbebidas' => 0,'preco' => $evento->preco));

        foreach ($vips as $vip) {
            $livre = true;
            foreach ($vips_ocupados as $vip_ocupados) {
                if($vip->id ===  $vip_ocupados->id_vip){
                    $livre = false;
                }
            }
            if($livre){
                array_push($vips_livres,array('id' => $vip->id,'npessoas' => $vip->npessoas,'nbebidas' => $vip->nbebidas,'preco' => $vip->preco));
            }
        }

        return $vips_livres;
    }
}

<?php

namespace backend\modules\api\controllers;

use Yii;
use common\models\Faturas;

class FaturasController extends \yii\web\Controller
{
    public function actionViewfaturas($id_cliente)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $fatura_completa = array();
        $faturas = Faturas::find()
            ->leftJoin('pulseiras', 'pulseiras.id = faturas.id_pulseira')
            ->where(['pulseiras.id_cliente' => $id_cliente])
            ->orderby(['datahora_compra'=>SORT_DESC])
            ->all();

        foreach ($faturas as $fatura) {
            $fatura_completa[] = array(
                "id_fatura" => $fatura->id,
                "data" => $fatura->datahora_compra,
                "preco" => $fatura->preco,
                "tipo_pulseira" => $fatura->pulseira->tipo,
                "nome_evento" => $fatura->pulseira->evento->nome,
            );
        }

        return $fatura_completa;
    }
}

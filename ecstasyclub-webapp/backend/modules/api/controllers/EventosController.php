<?php

namespace backend\modules\api\controllers;

use Yii;
use common\models\Eventos;
use common\models\Faturas;

class EventosController extends \yii\web\Controller
{

    public function actionViewalleventos($estado)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $alleventos = Eventos::find()->where(['estado' => 'ativo'])->orderby(['dataevento'=>SORT_DESC])->all();
        
        foreach($alleventos as $evento){
            $evento->id_criador = $evento->criador->nome . ' ' . $evento->criador->apelido;
            $evento->id_tipo_evento = $evento->tipoEvento->tipo;
        };

        return $alleventos;
    }

    public function actionEvento($id_fatura)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $faturas = Faturas::findOne($id_fatura);

        $evento = Eventos::find()
            ->leftJoin('pulseiras', 'pulseiras.id_evento = eventos.id')
            ->leftJoin('faturas', 'faturas.id_pulseira = pulseiras.id')
            ->where(['faturas.id' => $id_fatura])
            ->all();

        return $evento;
    }
}

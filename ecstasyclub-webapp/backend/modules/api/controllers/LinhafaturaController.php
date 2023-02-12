<?php

namespace backend\modules\api\controllers;

use Yii;
use common\models\Faturas;
use common\models\Pulseiras;
use common\models\LinhaFatura;

class LinhafaturaController extends \yii\web\Controller
{
    public function actionViewlinhafatura($id_fatura)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $fatura = Faturas::findOne($id_fatura);
        if($fatura != null){
            $pulseira = Pulseiras::find()
            ->where(['id' => $fatura->id_pulseira])
            ->one();
            
            if($pulseira->tipo == 'vip'){
                $linhasfatura = LinhaFatura::find()
                    ->where(['id_fatura' => $fatura->id])
                    ->all();
                
                foreach($linhasfatura as $linhafatura){
                    $linhafatura->id_bebida = $linhafatura->bebida->nome;
                }

                return $linhasfatura;
            }
        } 
        
        return null;
    }
}

<?php

namespace backend\modules\api\controllers;

use Yii;
use common\models\Noticias;

class NoticiasController extends \yii\web\Controller
{
    public function actionViewnoticias()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $noticias = Noticias::find()->orderby(['datanoticia'=>SORT_DESC])->all();

        return $noticias;
    }
}

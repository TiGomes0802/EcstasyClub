<?php

namespace backend\modules\api\controllers;

use Yii;
use common\models\AuthAssignment;
use common\models\Userprofile;
use common\models\LoginForm;

class UserprofileController extends \yii\web\Controller
{
    public function actionLogin($username, $password)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $model = new LoginForm();
        $model->username = $username;
        $model->password = $password;
        if ($model->login()) {
            $userprofile = Userprofile::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
            $role = AuthAssignment::find()->where(['user_id' => Yii::$app->user->identity->id])->one();

            $user = (object) [
                'id' => $userprofile->id,
                'nome' => $userprofile->nome,
                'apelido' => $userprofile->apelido,
                'username' => Yii::$app->user->identity->username,
                'email' => Yii::$app->user->identity->email,
                'datanascimento' => date("d-m-Y", strtotime($userprofile->datanascimento)),
                'sexo' => $userprofile->sexo,
                'role' => $role->item_name,
              ];
              
            return $user;
        };
        return null;
    }

    public function actionVerifycodigorp($codigo)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $userprofile = Userprofile::find()->where(['codigorp' =>$codigo])->one();
        if($userprofile != null){
            $resposta = "valido";
            return $resposta;
        }else{
            return 'naovalido';
        }
    }

    public function actionAllinfocodigorp($id_rp)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $user =  Userprofile::findOne($id_rp);

        if($user != null){
            $listaeventos = (new yii\db\Query())
            ->from('eventos')
            ->select(['eventos.id AS id_evento', 'eventos.nome AS nomeEvento', 'COUNT(pulseiras.codigorp) AS bilhetes_vendidos'])
            ->leftJoin('pulseiras', 'pulseiras.id_evento = eventos.id')
            ->where(['pulseiras.codigorp' => $user->codigoRP])
            ->orderBy(['eventos.dataevento'=>SORT_DESC])
            ->groupBy('eventos.nome')
            ->all();

            return $listaeventos;
        }
        return null;
    }
    
}

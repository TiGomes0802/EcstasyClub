<?php

use common\models\Userprofile;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\UserprofileSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = '';
?>
<div class="userprofile-index">

    <h1><?= Html::encode('Clientes') ?></h1>

    <?= 
    GridView::widget([
        'dataProvider' => $searchModel,
        'columns' => [
            [
                'label' => '',
                'value' => function ($data) {
                    return array_keys(Yii::$app->authManager->getRolesByUser($data->user_id))[0];
                },
            ],
            [
                'label' => 'Nome',
                'value' => function ($data) {
                    return $data->nome .' '. $data->apelido;
                },
            ],
            [
                'label' => 'Username',
                'value' => function ($data) {
                    return $data->user->username;
                },
            ],
            [
                'label' => 'Email',
                'value' => function ($data) {
                    return $data->user->email;
                },
            ],
            [
                'label' => 'Sexo',
                'value' => function ($data) {
                    return $data->sexo;
                },
            ],
            [
                'label' => 'Data de Nascimento',
                'format' => ['date', 'php:d/m/Y'],
                'value' => function ($data) {
                    return $data->datanascimento;
                },
            ],
            
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {update}',
                'urlCreator' => function ($action, Userprofile $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->user_id]);
                 }
            ],
        ],
    ]); ?>


</div>

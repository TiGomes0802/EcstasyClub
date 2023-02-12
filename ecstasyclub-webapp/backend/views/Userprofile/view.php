<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Userprofile $model */

$this->title = $model->nome . ' ' . $model->apelido;
\yii\web\YiiAsset::register($this);
?>
<div class="userprofile-view">

    <h2><?= array_keys(Yii::$app->authManager->getRolesByUser($model->user_id))[0] ?></h2>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Update password', ['update_password', 'id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
    </p>
    <?php if(array_keys(Yii::$app->authManager->getRolesByUser($model->user_id))[0] == 'rp'){ ?>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                [
                    'label' => 'Nome',
                    'value' => function ($data) {
                        return $data->nome .' '. $data->apelido;;
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
                    'label' => 'Data de Nascimento',
                    'format' => ['date', 'php:d/m/Y'],
                    'value' => function ($data) {
                        return $data->datanascimento;
                    },
                ],
                [
                    'label' => 'Sexo',
                    'value' => function ($data) {
                        return $data->sexo;
                    },
                ],
                [
                    'label' => 'codigo RP',
                    'value' => function ($data) {
                        return $data->codigoRP;
                    },
                ],
            ],
        ]);?>
    <?php }else{ ?>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                [
                    'label' => 'Nome',
                    'value' => function ($data) {
                        return $data->nome .' '. $data->apelido;;
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
                    'label' => 'Data de Nascimento',
                    'format' => ['date', 'php:d/m/Y'],
                    'value' => function ($data) {
                        return $data->datanascimento;
                    },
                ],
                [
                    'label' => 'Sexo',
                    'value' => function ($data) {
                        return $data->sexo;
                    },
                ],
            ],
        ]);?>
    <?php } ?>
    

    
    <br>
    <?php if(array_keys(Yii::$app->authManager->getRolesByUser($model->user_id))[0] == 'gestor' or array_keys(Yii::$app->authManager->getRolesByUser($model->user_id))[0] == 'admin') {?>
        <?= $this->render('viewgraficosgestor', [
            'grafico' => $grafico,
            'numeventosuser' => $numeventosuser,
            'valorfaturadouser' => $valorfaturadouser,
            'bilhetesveendidosuser' => $bilhetesveendidosuser,
        ]) ?>
    <?php } 
        if(array_keys(Yii::$app->authManager->getRolesByUser($model->user_id))[0] == 'rp') { ?>
            <?= $this->render('viewgraficosrp', [
                'graficorp' => $graficorp,
                'grafico2rp' => $grafico2rp,
                'listaeventosrp' => $listaeventosrp,
            ]) ?>
    <?php } ?>
</div>

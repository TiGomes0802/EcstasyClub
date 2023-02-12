<?php

use common\models\Noticias;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\NoticiasSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = '';
?>
<div class="noticias-index">

    <h1><?= Html::encode('Notícias') ?></h1>

    <p>
        <?= Html::a('Create Noticias', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'label' => 'Título',
                'value' => function ($data) {
                    return $data->titulo;
                },
            ],
            [
                'label' => 'Data da notícia',
                'format' => ['date', 'php:d/m/Y H:i'],
                'value' => function ($data) {
                    return $data->datanoticia;
                },
            ],
            [
                'label' => 'Descrição',
                'format' => 'html',
                'value' => function ($data) {
                    return $data->descricao;
                },
            ],
            [
                'label' => 'Criador',
                'value' => function ($data) {
                    return $data->criador->nome . ' ' . $data->criador->apelido;
                },
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Noticias $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>

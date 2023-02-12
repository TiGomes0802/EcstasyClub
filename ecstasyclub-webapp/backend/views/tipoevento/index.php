<?php

use common\models\Tipoevento;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\TipoeventoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = '';
?>
<div class="tipoevento-index">

    <h1><?= Html::encode('Tipo de eventos') ?></h1>

    <p>
        <?= Html::a('Create Tipoevento', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'label' => 'Tipos de eventos',
                'value' => function ($data) {
                    return $data->tipo;
                },
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{update}',
                'urlCreator' => function ($action, Tipoevento $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>

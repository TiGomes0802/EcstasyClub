<?php

use common\models\Bebidas;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\BebidasSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = '';
?>
<div class="bebidas-index">

    <h1><?= Html::encode('Bebidas') ?></h1>

    <p>
        <?= Html::a('Create Bebidas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'label' => 'Bebidas',
                'value' => function ($data) {
                    return $data->nome;
                },
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {update}',
                'urlCreator' => function ($action, Bebidas $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>

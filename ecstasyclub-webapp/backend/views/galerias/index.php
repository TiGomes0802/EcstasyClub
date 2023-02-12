<?php

use common\models\Galerias;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\GaleriasSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = '';
?>
<div class="galerias-index">

    <h1><?= Html::encode('Galeria do ' . $evento->nome) ?></h1>

    <p>
        <?= Html::a('Adicionar foto', ['create', 'id_evento' => $evento->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $searchModel,
        'columns' => [
            [
                'format' => 'html',
                'label' => 'Foto',
                'value' => function ($data) {
                    return Html::img('galeria/' . $data->id_evento . '/' . $data->foto,
                    ['width' => '260px','height' => '350px', 'alt' => 'galeira/'.$data->id_evento . '/' . $data->foto]);
                },
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {delete}',
                'urlCreator' => function ($action, Galerias $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
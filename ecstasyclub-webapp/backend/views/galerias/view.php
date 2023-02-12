<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Galerias $model */

$this->title = '';
\yii\web\YiiAsset::register($this);
?>
<div class="galerias-view">

    <h1><?= Html::encode('Galeria ' . $model->evento->nome) ?></h1>

    <p>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'format' => 'html',
                'label' => '',
                'value' => function ($data) {
                    return Html::img('galeria/' . $data->id_evento . '/' . $data->foto,
                    ['width' => '460px','height' => '570px', 'alt' => 'galeira/'.$data->id_evento . '/' . $data->foto]);
                },
            ],
        ],
    ]) ?>

</div>

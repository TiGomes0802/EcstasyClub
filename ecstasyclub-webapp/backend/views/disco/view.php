<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Disco $model */

$this->title = $model->id;
\yii\web\YiiAsset::register($this);
?>
<div class="disco-view">

    <h1><?= Html::encode('Disco') ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nome',
            [
                'label' => 'NIF',
                'value' => function ($data) {
                    return $data->nif;
                },
            ],
            'localidade',
            [
                'label' => 'Código postal',
                'value' => function ($data) {
                    return $data->codpostal;
                },
            ],
            'morada',
            [
                'label' => 'Lotação',
                'value' => function ($data) {
                    return $data->lotacao;
                },
            ],
        ],
    ]) ?>

</div>

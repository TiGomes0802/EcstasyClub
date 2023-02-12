<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Bebidas $model */

$this->title = '';
\yii\web\YiiAsset::register($this);
?>
<div class="bebidas-view">

    <h1><?= Html::encode($model->nome) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Bebida',
                'value' => function ($data) {
                    return $data->nome;
                },
            ],
        ],
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Noticias $model */

$this->title = '';
\yii\web\YiiAsset::register($this);
?>
<div class="noticias-view">

    <h1><?= Html::encode($model->titulo) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
        ],
    ]) ?>

</div>

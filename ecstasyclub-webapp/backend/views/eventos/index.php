<?php

use common\models\Eventos;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\EventosSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = '';
?>
<div class="eventos-index">

    <h1><?= Html::encode('Eventos') ?></h1>

    <p>
        <?= Html::a('Eventos Ativos', ['index', 'estado' => 'ativo'], ['class' => 'btn btn-info']) ?>
        <?= Html::a('Eventos Desativos', ['index', 'estado' => 'desativo'], ['class' => 'btn btn-info']) ?>
        <?= Html::a('Eventos Cancelados', ['index', 'estado' => 'cancelado'], ['class' => 'btn btn-info']) ?>
    </p>   
    <p>
        <?= Html::a('Create Eventos', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Tipo eventos', ['tipoevento/index'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $searchModel,
        'columns' => [
            [
                'label' => 'Nome',
                'value' => function ($data) {
                    return $data->nome;
                },
            ],
            [
                'format' => 'html',
                'label' => 'Cartaz',
                'value' => function ($data) {
                    return Html::img('cartaz/' . $data->cartaz,
                    ['width' => '80px','height' => '100px']);
                },
            ],
            [
                'label' => 'Descrição',
                'format' => 'html',
                'headerOptions' => ['width' => '670px'],
                'contentOptions' => ['style'=>'text-align:justify;'],
                'value' => function ($data) {
                    return $data->descricao;
                },
            ],
            [
                'label' => 'Data do evento',
                'format' => ['date', 'php:d/m/Y H:i'],
                'value' => function ($data) {
                    return $data->dataevento;
                },
            ],
            [
                'label' => 'Bilhetes disponiveis',
                'value' => function ($data) {
                    return $data->numbilhetesdisp;
                },
            ],
            [
                'label' => 'Preço',
                'value' => function ($data) {
                    return number_format( $data->preco, 2 ) . '€';
                },
            ],
            [
                'label' => 'Criador',
                'value' => function ($data) {
                    return $data->criador->nome . ' ' . $data->criador->apelido;
                },
            ],
            [
                'label' => 'Tipo de evento',
                'value' => function ($data) {
                    return $data->tipoEvento->tipo;
                },
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {update}',
                'urlCreator' => function ($action, Eventos $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>

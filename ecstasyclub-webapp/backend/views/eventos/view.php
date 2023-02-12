<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Eventos $model */

$this->title = '';
\yii\web\YiiAsset::register($this);
?>
<div class="eventos-view">

    <h1><?= Html::encode($model->nome)?></h1>

    <p>
        <?php 
        if($model->estado == "ativo"){
            echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
        }
        if($model->estado == "desativo"){
            echo Html::a('Galeria', ['galerias/index', 'id_evento' => $model->id], ['class' => 'btn btn-primary']) ;
        } ?>
    </p>

    <div class="row">
        <div class="col-3">
            <img src='cartaz/<?= $model->cartaz ?>' class="img-thumbnail" alt="<?= $model->nome ?> cartaz">
        </div>
        <div class="col-1"></div>
        <div class="col-7" style="text-align:justify;">
            <?= $model->descricao ?>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <h5><strong>Bilhetes disponiveis:&nbsp;</strong><?=$model->numbilhetesdisp?></h5>
            <h5><strong>Bilhetes vendidos:&nbsp;</strong><?=$numbilhetesvendidos?></h5>
            <h5><strong>Valor faturado:&nbsp;</strong><?=number_format($valorfaturado,2).'€'?></h5>
            <h5><strong>Preço:&nbsp;</strong><?=number_format($model->preco,2).'€'?></h5>
            <h5><strong>Data:&nbsp;</strong><?=$model->dataevento?></h5>
            <h5><strong>Tipo de evento:&nbsp;</strong><?=$model->tipoEvento->tipo?></h5>
            <h5><strong>Criador:&nbsp;</strong><?=$model->criador->nome.' '.$model->criador->apelido?></h5>
        </div>
        <div class="col-1"></div>
    </div>

    <br>

    <div class="row">
        <script>
            var model2 = <?php print json_encode($grafico); ?>;
            var model4 = <?php print json_encode($grafico2); ?>;
        </script>
        
        <div class="col-6">
            <div class="card card-olive">
                <div class="card-header">
                    <h3 class="card-title">Clientes que compraram o bilhete</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div id="chart_div2"></div>
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="card card-olive">
                <div class="card-header">
                    <h3 class="card-title">Codigos de Rp usados</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div id="chart_div4"></div>
                </div>
            </div>
        </div>
    </div>

</div>

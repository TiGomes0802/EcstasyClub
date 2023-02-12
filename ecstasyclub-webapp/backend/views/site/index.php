<?php
$this->title = '';
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-success alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fas fa-check"></i> Login!</h4>
                <h3>Olá <?php echo "$model->nome $model->apelido" ?><h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="info-box">
                <span class="info-box-icon bg-olive">
                    <i class="far fa-calendar-alt"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Eventos</span>
                    <span class="info-box-number"><?=$numeventos?></span>
                </div>
                <span class="info-box-icon bg-olive"><i class="fa fa-money"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Retorno</span>
                    <span class="info-box-number"><?=number_format($valorfaturado,2).'€'?></span>
                </div>
                <span class="info-box-icon bg-olive"><i class="fa fa-ticket"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Pulseiras</span>
                    <span class="info-box-number"><?=$bilhetesveendidos?></span>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="info-box">
                <span class="info-box-icon bg-olive">
                    <i class="far fa-calendar-alt"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Eventos</span>
                    <span class="info-box-number"><?=$numeventosuser?></span>
                </div>
                <span class="info-box-icon bg-olive"><i class="fa fa-money"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Retorno</span>
                    <span class="info-box-number"><?=number_format($valorfaturadouser,2).'€'?></span>
                </div>
                <span class="info-box-icon bg-olive"><i class="fa fa-ticket"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Pulseiras</span>
                    <span class="info-box-number"><?=$bilhetesveendidosuser?></span>
                </div>
            </div>
        </div>

        <script>
            var model = <?php print json_encode($grafico); ?>;
            var model2 = <?php print json_encode($grafico2); ?>;
            var model3 = <?php print json_encode($grafico3); ?>;
            var listatiposeventos = <?php print json_encode($listatiposeventos); ?>;
        </script>
        
        <div class="col-6">
            <div class="card card-olive">
                <div class="card-header">
                    <h3 class="card-title">Staff</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div id="chart_div"></div>
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="card card-olive">
                <div class="card-header">
                    <h3 class="card-title">Clientes</h3>
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

        <div class="col-12">
            <div class="card card-olive">
                <div class="card-header">
                    <h3 class="card-title">Últimos 12 meses</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    
                    <div id="chart_div3" style=" height: 450px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

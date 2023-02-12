<script>
    var model = <?php print json_encode($grafico); ?>;
</script>
<div class="row">
    <div class="col-6">
        <div class="card card-olive">
            <div class="card-header">
                <h3 class="card-title">Número dos tipos de eventos criados</h3>
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
</div>
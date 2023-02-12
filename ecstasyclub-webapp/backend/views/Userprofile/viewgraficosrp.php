<style>
    table {
    border-collapse: collapse;
    border-spacing: 0;
    width: 100%;
    border: 1px solid #ddd;
    }

    th, td {
    text-align: left;
    padding: 20px;
    width:33.33%;
    }

    tr:nth-child(even) {
    background-color: #f2f2f2;
    }
</style>
<script>
    var model = <?php print json_encode($graficorp); ?>;
    var model2 = <?php print json_encode($grafico2rp); ?>;
</script>
<div class="row">
    <div class="col-6">
        <div class="card card-olive">
            <div class="card-header">
                <h4 class="card-title">Número dos tipos de eventos que usam o código</h4>
            </div>
            <div class="card-body">
                <div id="chart_div"></div>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card card-olive">
            <div class="card-header">
                <h4 class="card-title">Género das pessoas que usam o código</h4>
            </div>
            <div class="card-body">
                <div id="chart_div2"></div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-12">
        <div class="card card-olive">
            <div class="card-header">
                <h4 class="card-title">Eventos</h4>
            </div>
            <div class="card-body">
                <table>
                    <tr>
                        <th>Nome</th>
                        <th>Data</th>
                        <th>Número de codigos usados</th>
                    </tr>
                    <?php foreach ($listaeventosrp as $evento) { ?>
                        <tr>
                            <td><?=$evento['nome']?></td>
                            <td><?=date("d/m/Y", strtotime($evento['dataevento'])); ?></td>
                            <td><?=$evento['quantidade_codigos']?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
        font-size: x-small;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }
    .gray {
        background-color: lightgray
    }
</style>
<body>
    <h3> <?= $disco->nome ?></h3>
  <table>
    <tr>
        <td valign="top">
          <img src="C:/wamp64/www/ecstasyclub/frontend/web/ico/ecstasyclublogo.png" alt="Logo Ecstasy Club"width="200"/>
        </td>
        <td align="left">
            <pre>
              Morada: <?= $disco->morada ?>, <?= $disco->localidade ?>
              <br>
              Codigo Postal: <?= $disco->codpostal ?>
            </pre>
        </td>
    </tr>
  </table>
  <br>
    <p><strong>From:</strong> <?= $disco->nome ?></p>
    <p><strong>To:</strong> <?= $fatura->pulseira->cliente->nome . ' ' . $fatura->pulseira->cliente->apelido ?></p>
  <br>
  <table width="100%">
    <thead style="background-color: lightgray;">
      <tr>
        <th>Nome do evento</th>
        <th>Data de compra</th>
        <th>Tipo de pulseira</th>
        <th>Preço</th>
      </tr>
    </thead>
    <tbody>
        <tr>
          <td align="center"><?= $fatura->pulseira->evento->nome ?></td>
          <td align="center"><?= $fatura->datahora_compra ?></td>
          <td align="center"><?= $fatura->pulseira->tipo ?></td>
          <td align="center"><?= number_format( $fatura->preco, 2 ) . '€' ?></td>
        </tr>
    </tbody>
  </table>
  <br><br>
  <?php if($fatura->pulseira->tipo == "vip") {?>
    <table width="30%">
        <thead style="background-color: lightgray;">
        <tr>
          <th>Bebida</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach ($linhasfatura as $linhafatura) { ?>
                <tr>
                  <td align="center"><?= $linhafatura->bebida->nome ?></td>
                </tr>
          <?php }?>
        </tbody>
    </table>
  <?php }?>
</body>
<link rel="stylesheet" href="././css/nicepage2.css" media="screen">
<link rel="stylesheet" href="././css/form_add_empregado.css" media="screen">
<style>
    table {
    border-collapse: collapse;
    border-spacing: 0;
    width: 100%;
    border: 1px solid #ddd;
    }

    th, td {
    text-align: center;
    padding: 20px;
    }

</style>
<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Pulseiras $model */

$this->title = '';
?>

<section class="u-align-center u-clearfix u-custom-color-2 u-section-6" id="sec-1a0b">
    <div class="u-clearfix u-sheet u-sheet-1">
        <h2 class="u-text u-text-default u-text-1">Escolher&nbsp; pulseira</h2>
        <br><br><br>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <table>
                    <tr>
                        <th>Número de pessoas</th>
                        <th>Descrição</th>
                        <th>Preço</th>
                        <th>Número de garrafas</th>
                        <th></th>
                    </tr>
                    <tr>
                        <td style="width:15%">1</td>
                        <td style="width:40%">Pulseira normal</td>
                        <td style="width:17%"><?=number_format( $evento->preco, 2 ) . '€'?></td>
                        <td style="width:18%">0</td>
                        <td style="width:10%"><a href="index.php?r=faturas%2Ffinalizarcompra&id_evento=<?=$evento->id?>&codigorp=<?=$codigorp?>"><input type="button" class="btn btn-success" value="Comprar" id="comprar"></a></td>
                    </tr>
                    <?php foreach ($listavips as $vip) { ?>
                        <tr>
                            <td style="width:15%"><?=$vip->npessoas?></td>
                            <td style="width:40%"><?=$vip->descricao?></td>
                            <td style="width:17%"><?=number_format( $vip->preco, 2 ) . '€'?></td>
                            <td style="width:18%"><?=$vip->nbebidas?></td>
                            <?php if(in_array($vip->id,$id_de_vips)) {?>
                                <td style="width:10%"><input type="button" class="btn btn-danger" value="Indisponivel" disabled ></td>
                            <?php } else {?>
                                <td style="width:10%"><a href='index.php?r=linhafatura%2Fcreate&id_evento=<?=$evento->id?>&codigorp=<?=$codigorp?>&id_vip=<?=$vip->id?>'><input type="button" class="btn btn-success" value="Comprar" id="comprarvip"></a></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
    <br><br><br>
</section>

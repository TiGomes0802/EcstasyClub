<link rel="stylesheet" href="././css/nicepage2.css" media="screen">
<link rel="stylesheet" href="././css/form_add_empregado.css" media="screen">
<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = '';?>

<section class="u-align-center u-clearfix u-custom-color-2 u-section-1" id="sec-1a0b">
    <div class="u-clearfix u-sheet u-sheet-1">
        <h2 class="u-text u-text-default u-text-1">Dados para finalizar a compra</h2>

        <div class="u-form u-form-1">    
        <?php $form = ActiveForm::begin(); ?>

        <div class="u-form-group u-form-name u-label-top">
            <label class="u-label u-spacing-0 u-text-custom-color-1 u-label">Nome</label>
            <?= $form->field($model, 'nome')->input('text', ['placeholder' => 'Nome', 'id' => 'nome'])->label(false); ?>
        </div>

        <div class="u-form-group u-form-name u-label-top">
            <label class="u-label u-spacing-0 u-text-custom-color-1 u-label">Apelido</label>
            <?= $form->field($model, 'apelido')->input('text', ['placeholder' => 'Apelido', 'id' => 'apelido'])->label(false); ?>
        </div>

        <div class="u-form-group u-form-name u-label-top">
            <label class="u-label u-spacing-0 u-text-custom-color-1 u-label">E-mail</label>
            <?= $form->field($model, 'email')->input('text', ['placeholder' => 'E-mail', 'id' => 'email'])->label(false); ?>
        </div>

        <div class="u-form-group u-form-name u-label-top">
            <label class="u-label u-spacing-0 u-text-custom-color-1 u-label">Titular do cartão</label>
            <?= $form->field($model, 'titularcartao')->input('text', ['placeholder' => 'Titular do cartão', 'id' => 'Titular do cartao'])->label(false); ?>
        </div>

        <div class="u-form-group u-form-name u-label-top">
            <label class="u-label u-spacing-0 u-text-custom-color-1 u-label">Número do cartão</label>
            <?= $form->field($model, 'numerocartao')->input('number', ['placeholder' => 'Número do cartão', 'id' => 'numero_do_cartao', 'step'=>'1'])->label(false); ?>
        </div>

        <div class="u-form-group u-form-name u-label-top">
            <label class="u-label u-spacing-0 u-text-custom-color-1 u-label">Data do cartão</label>
            <?= $form->field($model, 'datacartao')->input('text', ['placeholder' => '00/00', 'id' => 'data_do_cartao'])->label(false); ?>
        </div>

        <div class="u-form-group u-form-name u-label-top">
            <label class="u-label u-spacing-0 u-text-custom-color-1 u-label">Código de segurança</label>
            <?= $form->field($model, 'cvvcartao')->input('number', ['placeholder' => 'CVV','step'=>'1'])->label(false); ?>
        </div>

        <?= Html::submitButton('Login', ['class' => 'u-active-custom-color-2 u-border-2 u-border-active-custom-color-1 u-border-custom-color-1 u-border-hover-custom-color-1 u-btn u-btn-round u-btn-submit u-button-style u-custom-color-1 u-hover-custom-color-2 u-radius-4 u-text-active-custom-color-1 u-text-custom-color-2 u-text-hover-custom-color-1 u-btn-1', 'id' => 'login']) ?>
      <?php ActiveForm::end(); ?>
      <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</section>
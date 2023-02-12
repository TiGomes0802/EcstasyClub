<link rel="stylesheet" href="././css/nicepage2.css" media="screen">
<link rel="stylesheet" href="././css/form_add_empregado.css" media="screen">
<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

?>

<section class="u-align-center u-clearfix u-custom-color-2 u-section-1" id="sec-1a0b">
    <div class="u-clearfix u-sheet u-sheet-1">
        <h2 class="u-text u-text-default u-text-1">Registar</h2>

        <div class="u-form u-form-1">    
      <?php $form = ActiveForm::begin(); ?>

        <div class="u-form-group u-form-name u-label-top">
          <label for="name-3b9a" class="u-label u-spacing-0 u-text-custom-color-1 u-label">Nome</label>
          <?= $form->field($model, 'nome')->input('text', ['placeholder' => 'Nome', 'id' => 'nome'])->label(false); ?>
        </div>

        <div class="u-form-group u-form-name u-label-top">
          <label for="text-33e6" class="u-label u-spacing-0 u-text-custom-color-1 u-label">Apelido</label>
          <?= $form->field($model, 'apelido')->input('text', ['placeholder' => 'Apelido', 'id' => 'apelido'])->label(false); ?>
        </div>

        <div class="u-form-group u-form-name u-label-top">
          <label for="name-40e2" class="u-label u-spacing-0 u-text-custom-color-1 u-label">Username</label>
          <?= $form->field($model, 'username')->input('text', ['placeholder' => 'Username', 'id' => 'username'])->label(false); ?>
        </div>

        <div class="u-form-group u-form-name u-label-top">
          <label for="name-818d" class="u-label u-spacing-0 u-text-custom-color-1 u-label">Password</label>
          <?= $form->field($model, 'password')->input('password',['placeholder' => 'Password', 'id' => 'password'])->label(false); ?>
        </div>

        <div class="u-form-group u-form-name u-label-top">
          <label for="name-818d" class="u-label u-spacing-0 u-text-custom-color-1 u-label">Confirmar Password</label>
          <?= $form->field($model, 'passwordrepet')->input('password',['placeholder' => 'Password', 'id' => 'passwordrepet'])->label(false); ?>
        </div>

        <div class="u-form-group u-form-name u-label-top">
          <label for="email-3b9a" class="u-label u-spacing-0 u-text-custom-color-1 u-label">Email</label>
          <?= $form->field($model, 'email')->input('email',['placeholder' => 'Email', 'id' => 'email'])->label(false); ?>
        </div>

        <div class="u-form-group u-form-name u-label-top">
          <label for="sexo" class="u-label u-spacing-0 u-text-custom-color-1 u-label">Sexo</label>
          <?= $form->field($model, 'sexo')->dropdownList(['masculino' => 'Masculino', 'femenino' => 'Femenino'],['prompt'=>'Seleciona o sexo','id' => 'sexo'])->label(false); ?>
        </div>

        <div class="u-form-group u-form-name u-label-top">
          <label for="date-f1bc" class="u-label u-spacing-0 u-text-custom-color-1 u-label">Data de nascimento</label>
          <?= $form->field($model, 'datanascimento')->input('date',['id' => 'date'])->label(false); ?>
        </div>
      
        <?= Html::submitButton('Submit', ['class' => 'u-active-custom-color-2 u-border-2 u-border-active-custom-color-1 u-border-custom-color-1 u-border-hover-custom-color-1 u-btn u-btn-round u-btn-submit u-button-style u-custom-color-1 u-hover-custom-color-2 u-radius-4 u-text-active-custom-color-1 u-text-custom-color-2 u-text-hover-custom-color-1 u-btn-1']) ?>
      <?php ActiveForm::end(); ?>
</section>


<?php
  use yii\helpers\Html;
  use yii\widgets\ActiveForm;
?>
    
<div class="u-form u-form-1">    
  <?php $form = ActiveForm::begin(); ?>

    <div class="u-form-group u-form-name u-label-top">
      <label for="name-3b9a" class="u-label u-spacing-0 u-text-custom-color-1 u-label">Nome</label>
      <?= $form->field($model, 'nome')->input('text', ['placeholder' => 'Nome'])->label(false); ?>
    </div>

    <div class="u-form-group u-form-name u-label-top">
      <label for="text-33e6" class="u-label u-spacing-0 u-text-custom-color-1 u-label">Apelido</label>
      <?= $form->field($model, 'apelido')->input('text', ['placeholder' => 'Apelido'])->label(false); ?>
    </div>

    <div class="u-form-group u-form-name u-label-top">
      <label for="name-40e2" class="u-label u-spacing-0 u-text-custom-color-1 u-label">Username</label>
      <?= $form->field($model, 'username')->input('text', ['placeholder' => 'Username'])->label(false); ?>
    </div>

    <div class="u-form-group u-form-name u-label-top">
      <label for="email-3b9a" class="u-label u-spacing-0 u-text-custom-color-1 u-label">Email</label>
      <?= $form->field($model, 'email')->input('email',['placeholder' => 'Email'])->label(false); ?>
    </div>
    
    <div class="u-form-group u-form-name u-label-top">
      <label for="sexo" class="u-label u-spacing-0 u-text-custom-color-1 u-label">Sexo</label>
      <?= $form->field($model, 'sexo')->dropdownList(['masculino' => 'Masculino', 'feminino' => 'Feminino'],['prompt'=>'Seleciona o sexo'])->label(false); ?>
    </div>

    <div class="u-form-group u-form-name u-label-top">
      <label for="date-f1bc" class="u-label u-spacing-0 u-text-custom-color-1 u-label">Data de nascimento</label>
      <?= $form->field($model, 'datanascimento')->input('date')->label(false); ?>
    </div>
  
    <?= Html::submitButton('Submit', ['class' => 'u-active-custom-color-2 u-border-2 u-border-active-custom-color-1 u-border-custom-color-1 u-border-hover-custom-color-1 u-btn u-btn-round u-btn-submit u-button-style u-custom-color-1 u-hover-custom-color-2 u-radius-4 u-text-active-custom-color-1 u-text-custom-color-2 u-text-hover-custom-color-1 u-btn-1']) ?>
  <?php ActiveForm::end(); ?>
</div>
<?php
  use yii\helpers\Html;
  use yii\widgets\ActiveForm;
?>
    
    <div class="u-form u-form-1">    
      <?php $form = ActiveForm::begin(); ?>

        <div class="u-form-group u-form-name u-label-top">
          <label for="name-818d" class="u-label u-spacing-0 u-text-custom-color-1 u-label">Password Nova</label>
          <?= $form->field($model, 'password')->input('password',['placeholder' => 'Password'])->label(false); ?>
        </div>

        <div class="u-form-group u-form-name u-label-top">
          <label for="name-818d" class="u-label u-spacing-0 u-text-custom-color-1 u-label">Confirmar Password</label>
          <?= $form->field($model, 'passwordrepet')->input('password',['placeholder' => 'Password'])->label(false); ?>
        </div>
      
        <?= Html::submitButton('Submit', ['class' => 'u-active-custom-color-2 u-border-2 u-border-active-custom-color-1 u-border-custom-color-1 u-border-hover-custom-color-1 u-btn u-btn-round u-btn-submit u-button-style u-custom-color-1 u-hover-custom-color-2 u-radius-4 u-text-active-custom-color-1 u-text-custom-color-2 u-text-hover-custom-color-1 u-btn-1']) ?>
      <?php ActiveForm::end(); ?>
    </div>

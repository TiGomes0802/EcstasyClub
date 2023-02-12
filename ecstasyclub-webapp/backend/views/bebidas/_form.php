<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Bebidas $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="u-form u-form-1">    
  <?php $form = ActiveForm::begin(); ?>

    <div class="u-form-group u-form-name u-label-top">
      <label class="u-label u-spacing-0 u-text-custom-color-1 u-label">Bebida</label>
      <?= $form->field($model, 'nome')->input('text', ['placeholder' => 'Nome da Bebida'])->label(false); ?>
    </div>
  
    <?= Html::submitButton('Submit', ['class' => 'u-active-custom-color-2 u-border-2 u-border-active-custom-color-1 u-border-custom-color-1 u-border-hover-custom-color-1 u-btn u-btn-round u-btn-submit u-button-style u-custom-color-1 u-hover-custom-color-2 u-radius-4 u-text-active-custom-color-1 u-text-custom-color-2 u-text-hover-custom-color-1 u-btn-1']) ?>
  <?php ActiveForm::end(); ?>
</div>

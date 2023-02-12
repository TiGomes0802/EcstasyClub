<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Disco $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="u-form u-form-1">    
  <?php $form = ActiveForm::begin(); ?>

    <div class="u-form-group u-form-name u-label-top">
      <label class="u-label u-spacing-0 u-text-custom-color-1 u-label">Nome</label>
      <?= $form->field($model, 'nome')->input('text', ['placeholder' => 'Nome'])->label(false); ?>
    </div>

    <div class="u-form-group u-form-name u-label-top">
      <label class="u-label u-spacing-0 u-text-custom-color-1 u-label">NIF</label>
      <?= $form->field($model, 'nif')->input('text', ['placeholder' => 'NIF'])->label(false); ?>
    </div>

    <div class="u-form-group u-form-name u-label-top">
      <label class="u-label u-spacing-0 u-text-custom-color-1 u-label">Localidade</label>
      <?= $form->field($model, 'localidade')->input('text', ['placeholder' => 'Localidade'])->label(false); ?>
    </div>

    <div class="u-form-group u-form-name u-label-top">
      <label class="u-label u-spacing-0 u-text-custom-color-1 u-label">Codigo Postal</label>
      <?= $form->field($model, 'codpostal')->input('text', ['placeholder' => 'Codigo Postal'])->label(false); ?>
    </div>

    <div class="u-form-group u-form-name u-label-top">
      <label class="u-label u-spacing-0 u-text-custom-color-1 u-label">Morada</label>
      <?= $form->field($model, 'morada')->input('text', ['placeholder' => 'Morada'])->label(false); ?>
    </div>

    <div class="u-form-group u-form-name u-label-top">
      <label class="u-label u-spacing-0 u-text-custom-color-1 u-label">Lotação</label>
      <?= $form->field($model, 'lotacao')->input('number', ['step'=>'1'])->label(false); ?>
    </div>
  
    <?= Html::submitButton('Submit', ['class' => 'u-active-custom-color-2 u-border-2 u-border-active-custom-color-1 u-border-custom-color-1 u-border-hover-custom-color-1 u-btn u-btn-round u-btn-submit u-button-style u-custom-color-1 u-hover-custom-color-2 u-radius-4 u-text-active-custom-color-1 u-text-custom-color-2 u-text-hover-custom-color-1 u-btn-1']) ?>
  <?php ActiveForm::end(); ?>
</div>

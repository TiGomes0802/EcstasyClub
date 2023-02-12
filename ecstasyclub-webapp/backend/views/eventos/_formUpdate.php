<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/** @var yii\web\View $this */
/** @var common\models\Eventos $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="u-form u-form-1">    
      <?php $form = ActiveForm::begin(); ?>

        <div class="u-form-group u-form-name u-label-top">
          <label class="u-label u-spacing-0 u-text-custom-color-1 u-label">Nome</label>
          <?= $form->field($model, 'nome')->input('text', ['placeholder' => 'Nome'])->label(false); ?>
        </div>

        <div class="u-form-group u-form-name u-label-top">
          <label class="u-label u-spacing-0 u-text-custom-color-1 u-label">Descricao</label>
          <?= $form->field($model, 'descricao')->widget(CKEditor::className(), ['options' => ['rows' => 6],'preset' => 'basic'])->label(false);?>
        </div>

        <div class="u-form-group u-form-name u-label-top">
          <label class="u-label u-spacing-0 u-text-custom-color-1 u-label">Cartaz</label>
          <?= $form->field($model, 'imageFileUpdate')->fileInput()->label(false); ?>
        </div>

        <div class="u-form-group u-form-name u-label-top">
          <label for="date-f1bc" class="u-label u-spacing-0 u-text-custom-color-1 u-label">Data do evento</label>
          <?= $form->field($model, 'dataevento')->input('datetime-local')->label(false); ?>
        </div>

        <div class="u-form-group u-form-name u-label-top">
          <label class="u-label u-spacing-0 u-text-custom-color-1 u-label">Preço</label>
          <?= $form->field($model, 'preco')->input('number', ['step'=>'0.01'])->label(false); ?>
        </div>

        <div class="u-form-group u-form-name u-label-top">
          <label class="u-label u-spacing-0 u-text-custom-color-1 u-label">Tipo de evento</label>
          <?= $form ->field($model, 'id_tipo_evento')
                    ->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Tipoevento::find()
                    ->asArray()
                    ->all(), 'id', 'tipo'))
                    ->label(false)?>
        </div>

        <div class="u-form-group u-form-name u-label-top">
          <label for="estado" class="u-label u-spacing-0 u-text-custom-color-1 u-label">Estado</label>
          <?= $form->field($model, 'estado')->dropdownList(['ativo' => 'Ativo', 'desativo' => 'Desativo', 'cancelado' => 'Cancelado'],['prompt'=>'Estado'])->label(false); ?>
        </div>
      
        <?= Html::submitButton('Submit', ['class' => 'u-active-custom-color-2 u-border-2 u-border-active-custom-color-1 u-border-custom-color-1 u-border-hover-custom-color-1 u-btn u-btn-round u-btn-submit u-button-style u-custom-color-1 u-hover-custom-color-2 u-radius-4 u-text-active-custom-color-1 u-text-custom-color-2 u-text-hover-custom-color-1 u-btn-1']) ?>
      <?php ActiveForm::end(); ?>
    </div>


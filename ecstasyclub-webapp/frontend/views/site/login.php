<link rel="stylesheet" href="././css/nicepage2.css" media="screen">
<link rel="stylesheet" href="././css/form_add_empregado.css" media="screen">
<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Login';?>

<section class="u-align-center u-clearfix u-custom-color-2 u-section-1" id="sec-1a0b">
    <div class="u-clearfix u-sheet u-sheet-1">
        <h2 class="u-text u-text-default u-text-1">Login</h2>

        <div class="u-form u-form-1">    
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

        <div class="u-form-group u-form-name u-label-top">
          <label class="u-label u-spacing-0 u-text-custom-color-1 u-label">Username</label>
          <?= $form->field($model, 'username')->input('text', ['placeholder' => 'Username', 'id' => 'username'])->label(false); ?>
        </div>

        <div class="u-form-group u-form-name u-label-top">
          <label class="u-label u-spacing-0 u-text-custom-color-1 u-label">Password</label>
          <?= $form->field($model, 'password')->input('password',['placeholder' => 'Password', 'id' => 'password'])->label(false); ?>
        </div>

        <?= $form->field($model, 'rememberMe')->checkbox() ?>

        <?= Html::submitButton('Login', ['class' => 'u-active-custom-color-2 u-border-2 u-border-active-custom-color-1 u-border-custom-color-1 u-border-hover-custom-color-1 u-btn u-btn-round u-btn-submit u-button-style u-custom-color-1 u-hover-custom-color-2 u-radius-4 u-text-active-custom-color-1 u-text-custom-color-2 u-text-hover-custom-color-1 u-btn-1', 'id' => 'login']) ?>
      <?php ActiveForm::end(); ?>
      <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</section>
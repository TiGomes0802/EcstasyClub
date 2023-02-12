<link rel="stylesheet" href="././css/nicepage2.css" media="screen">
<link rel="stylesheet" href="././css/form_add_empregado.css" media="screen">

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Eventos $model */

$this->title = '';
?>

<section class="u-align-center u-clearfix u-custom-color-2 u-section-1" id="sec-1a0b">
    <div class="u-clearfix u-sheet u-sheet-1">
        <br>
        <h2 class="u-text u-text-default u-text-1">Escolher Bebidas</h2>

        <div class="u-form u-form-1">    
            <?php $form = ActiveForm::begin(); ?>
                    
                <div class="u-form-group u-form-name u-label-top">
                    <?php for ($i = 1; $i <= $ngarrafas; $i++) { ?>
                        <label class="u-label u-spacing-0 u-text-custom-color-1 u-label">Bebida <?= $i ?>:</label>
                    
                        <?= $form->field($model, 'bebidas[]')
                            ->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Bebidas::find()
                            ->asArray()
                            ->all(), 'id', 'nome'), ['id' => 'bebida'.$i])
                            ->label(false)?>
                            <br>
                    <?php } ?>

                        
                </div>
                <br>
                <?= Html::submitButton('Submit', ['class' => 'u-active-custom-color-2 u-border-2 u-border-active-custom-color-1 u-border-custom-color-1 u-border-hover-custom-color-1 u-btn u-btn-round u-btn-submit u-button-style u-custom-color-1 u-hover-custom-color-2 u-radius-4 u-text-active-custom-color-1 u-text-custom-color-2 u-text-hover-custom-color-1 u-btn-1']) ?>
                <br><br><br><br>
            <?php ActiveForm::end(); ?>
        </div>

    </div>
</section>
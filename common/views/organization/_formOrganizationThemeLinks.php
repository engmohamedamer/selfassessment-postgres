<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\color\ColorInput;

/* @var $this yii\web\View */
/* @var $model common\models\OrganizationTheme */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="row">

    <div class="col-md-6 col-sm-12">
        <?php echo  $form->field($OrganizationTheme, 'facebook')->textInput(['maxlength' => true, 'placeholder' => 'Facebook']) ?>
    </div>
    <div class="col-md-6 col-sm-12">
        <?php echo  $form->field($OrganizationTheme, 'twitter')->textInput(['maxlength' => true, 'placeholder' => 'Twitter']) ?>
    </div>
    <div class="col-md-6 col-sm-12">
        <?php echo  $form->field($OrganizationTheme, 'linkedin')->textInput(['maxlength' => true, 'placeholder' => 'Linkedin']) ?>
    </div>
    <div class="col-md-6 col-sm-12">
        <?php echo  $form->field($OrganizationTheme, 'instagram')->textInput(['maxlength' => true, 'placeholder' => 'Instagram']) ?>
    </div>
    
</div>

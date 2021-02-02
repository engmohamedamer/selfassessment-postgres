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
        <?php echo  $form->field($OrganizationTheme, 'brandPrimColor')->widget(ColorInput::classname(), [
        'options' => ['placeholder' => Yii::t('common','Select color ...'),'value'=>$OrganizationTheme->brandPrimColor ?: '#8e44ad'],
        ]) ?>
    </div>
    <div class="col-md-6 col-sm-12">
        <?php echo  $form->field($OrganizationTheme, 'brandSecColor')->widget(ColorInput::classname(), [
        'options' => ['placeholder' => Yii::t('common','Select color ...'),'value'=>$OrganizationTheme->brandSecColor ?: '#f7f3ff'],
        ]) ?>
    </div>
    <div class="col-md-6 col-sm-12">
        <?php // echo  $form->field($OrganizationTheme, 'brandHTextColor')->widget(ColorInput::classname(), ['options' => ['placeholder' => Yii::t('common','Select color ...')],    ]) ?>
    </div>
    <div class="col-md-6 col-sm-12">
        <?php // echo  $form->field($OrganizationTheme, 'brandPTextColor')->widget(ColorInput::classname(), ['options' => ['placeholder' => Yii::t('common','Select color ...')],    ]) ?>
    </div>
    <div class="col-md-6 col-sm-12">
        <?php // echo  $form->field($OrganizationTheme, 'brandBlackColor')->widget(ColorInput::classname(), ['options' => ['placeholder' => Yii::t('common','Select color ...')],    ]) ?>
    </div>
    <div class="col-md-6 col-sm-12">
        <?php // echo  $form->field($OrganizationTheme, 'brandGrayColor')->widget(ColorInput::classname(), ['options' => ['placeholder' => Yii::t('common','Select color ...')],    ]) ?>
    </div>
    <div class="col-md-6 col-sm-12">
        <?php // echo  $form->field($OrganizationTheme, 'arfont')->textInput(['maxlength' => true, 'placeholder' => 'Arfont']) ?>
    </div>
    <div class="col-md-6 col-sm-12">
        <?php // echo  $form->field($OrganizationTheme, 'enfont')->textInput(['maxlength' => true, 'placeholder' => 'Enfont']) ?>
    </div>
</div>

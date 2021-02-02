<?php

use common\helpers\multiLang\MyMultiLanguageActiveField;
use kartik\color\ColorInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\organizationFooterLinks */
/* @var $form yii\widgets\ActiveForm */

?>


    <div class='row mb-4' style='    background: #f4f5f9; margin-left: 10px !important; margin-right: 10px !important; padding: 10px 0'>
        <div class="col-md-6 col-sm-12">
            <?= $form->field($organizationFooterLinks, 'name_link1')->textInput(['maxlength' => true, 'placeholder' => 'Name'])->widget(MyMultiLanguageActiveField::className());  ?>
        </div>

        <div class="col-md-6 col-sm-12 pt-45">
            <?php echo  $form->field($organizationFooterLinks, 'link1')->textInput() ?>
        </div>
    </div>

    <div class='row mb-4' style='    background: #f4f5f9; margin-left: 10px !important; margin-right: 10px !important; padding: 10px 0'>
        <div class="col-md-6 col-sm-12">
            <?= $form->field($organizationFooterLinks, 'name_link2')->textInput()
            ->widget(MyMultiLanguageActiveField::className());  ?>
        </div>

        <div class="col-md-6 col-sm-12 pt-45">
            <?php echo  $form->field($organizationFooterLinks, 'link2')->textInput() ?>
        </div>
    </div>

    <div class='row mb-4' style='    background: #f4f5f9; margin-left: 10px !important; margin-right: 10px !important; padding: 10px 0'>
        <div class="col-md-6 col-sm-12">
            <?= $form->field($organizationFooterLinks, 'name_link3')->textInput()
            ->widget(MyMultiLanguageActiveField::className());  ?>
        </div>

        <div class="col-md-6 col-sm-12 pt-45">
            <?php echo  $form->field($organizationFooterLinks, 'link3')->textInput() ?>
        </div>

    </div>


    <div class='row mb-4' style='    background: #f4f5f9; margin-left: 10px !important; margin-right: 10px !important; padding: 10px 0'>
        <div class="col-md-6 col-sm-12">
            <?= $form->field($organizationFooterLinks, 'name_link4')->textInput()
            ->widget(MyMultiLanguageActiveField::className());  ?>
        </div>

        <div class="col-md-6 col-sm-12 pt-45">
            <?php echo  $form->field($organizationFooterLinks, 'link4')->textInput() ?>
        </div>

    </div>

    <div class='row mb-4' style='    background: #f4f5f9; margin-left: 10px !important; margin-right: 10px !important; padding: 10px 0'>
        <div class="col-md-6 col-sm-12">
            <?= $form->field($organizationFooterLinks, 'name_link5')->textInput()
            ->widget(MyMultiLanguageActiveField::className());  ?>
        </div>

        <div class="col-md-6 col-sm-12 pt-45">
            <?php echo  $form->field($organizationFooterLinks, 'link5')->textInput() ?>
        </div>

    </div>

<?php

use common\models\UserProfile;
use kartik\color\ColorInput;
use trntv\filekit\widget\Upload;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model common\models\OrganizationTheme */
/* @var $form yii\widgets\ActiveForm */

?>


  

   
    <div class="col-md-12 cloneDivHeader">
        <h5><i class="fas fa-sign-in-alt"></i> <b><?= Yii::t('common', 'Login using SSO') ?></b>
        </h5>
        <div class="clearfix"></div>
    </div>

    <div class="col-md-12 container-items"><!-- widgetContainer -->

        <div class="form-group">
            <div class="checkbox">
                <label for="organization-allow_sso">
                    <?= $form->field($model,'sso_login')->checkBox(); ?>
            </label>

            </div>
        </div>
        <div class="form-group highlight-addon field-organizationtheme-facebook">
            <?php echo  $form->field($model, 'authServerUrl')->textInput(['maxlength' => true, 'placeholder' => 'https://sso.xxxx.land/auth']) ?>
        </div>    
        <div class="form-group highlight-addon field-organizationtheme-facebook">
            <?php echo  $form->field($model, 'realm')->textInput(['maxlength' => true, 'placeholder' => 'xxxxx']) ?>
        </div> 
        <div class="form-group highlight-addon field-organizationtheme-facebook">
            <?php echo  $form->field($model, 'clientId')->textInput(['maxlength' => true, 'placeholder' => 'xxxxx']) ?>
        </div> 
        <div class="form-group highlight-addon field-organizationtheme-facebook">
            <?php echo  $form->field($model, 'clientSecret')->textInput(['maxlength' => true, 'placeholder' => 'xxxx-xxx-xxxxxx-xxxxx']) ?>
        </div> 
        
    </div>





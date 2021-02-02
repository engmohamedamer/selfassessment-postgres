<?php

use common\models\User;
use common\models\UserProfile;
use trntv\filekit\widget\Upload;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model backend\models\UserForm */
/* @var $roles yii\rbac\Role[] */
/* @var $permissions yii\rbac\Permission[] */

$model->roles =Yii::$app->session->get('UserRole');

?>

<?php $form = ActiveForm::begin() ?>


<!-- Content Header (Page header) -->
<div class="content-header">
    <div>
        <div class="">
            <h1><?=  ($profile->isNewRecord)? Yii::t('backend','Add Admin') : Yii::t('backend','Update Admin');?> </h1>
        </div>
        <div class=" actionBtns">
            <button type="submit" class="btn btn-success"><i class="icofont-verification-check mr-2 ml-2"></i> <?= Yii::t('backend','Save');?></button>
    </div>
    </div>

    <!-- /.col -->
</div>
<!-- /.content-header -->

<div class="row">
    <div class="col-lg-12">
        <div class="card">


            <div class="card-body">

                        <?php echo $form->field($profile, 'picture')->widget(Upload::class, [
                            'url'=>['avatar-upload'],
                            'acceptFileTypes' => new JsExpression('/(\.|\/)(gif|jpeg|png)$/i'),
                            'maxFileSize' => 10485760,
                        ]) ?>



                <div class="row">

                    <div class="col-md-4 col-sm-12">
                        <?php echo $form->field($profile, 'firstname') ?>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <?php echo $form->field($model, 'email') ?>
                    </div>
                    <?php if($profile->isNewRecord):?>
                        <div class="col-md-4 col-sm-12">
                            <?php echo $form->field($model, 'password')->passwordInput() ?>
                        </div>
                    <?php endif;?>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <?php echo $form->field($profile, 'gender')->dropDownlist([
                            UserProfile::GENDER_MALE => Yii::t('backend', 'Male'),
                            UserProfile::GENDER_FEMALE => Yii::t('backend', 'Female'),
                        ]) ?>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <?php echo $form->field($profile, 'mobile') ?>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <?php echo $form->field($model, 'status')->dropDownList(User::statuses()) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mt-5 mb-5 center-align">
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php ActiveForm::end() ?>


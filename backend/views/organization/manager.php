<?php

use common\models\User;
use common\models\UserProfile;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use trntv\filekit\widget\Upload;

/* @var $this yii\web\View */
/* @var $model backend\models\UserForm */
/* @var $roles yii\rbac\Role[] */
/* @var $permissions yii\rbac\Permission[] */

$model->roles =Yii::$app->session->get('UserRole');



?>

<?php

if($saved == true){
    $this->registerJs("

     $(function() {
          parent.jQuery.fancybox.close();
          location.reload();
           // parent.location.reload();
     });
    ");
}

?>
<div class="container-fluid orgmanager">
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="row mb-2">
        <div class="col-md-6">
            <h1 class="m-0 text-dark"><?php echo Yii::t('common', 'Organization Admin') ?></h1>
        </div>

        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
<!-- /.content-header -->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <?php $form = ActiveForm::begin() ?>
                <?php echo $form->field($profile, 'picture')->widget(Upload::class, [
                            'url'=>['avatar-upload']
                        ]) ?>
                <div class="row">


                            <div class="col-sm-3">
                                <?php echo $form->field($model, 'email') ?>
                            </div>
                            <div class="col-sm-3">
                                <?php echo $form->field($model, 'password')->passwordInput() ?>
                            </div>
                            <div class="col-sm-3">
                                <?php echo $form->field($profile, 'firstname') ?>
                            </div>
                            <div class="col-sm-3">
                                <?php echo $form->field($profile, 'lastname') ?>
                            </div>



                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <?php echo $form->field($profile, 'gender')->dropDownlist([
                            UserProfile::GENDER_MALE => Yii::t('backend', 'Male'),
                            UserProfile::GENDER_FEMALE => Yii::t('backend', 'Female')
                        ]) ?>
                    </div>

                    <div class="col-sm-4">
                        <?php echo $form->field($profile, 'mobile') ?>
                    </div>


                    <div class="col-sm-4">
                        <?php echo $form->field($model, 'status')->dropDownList(User::statuses()) ?>
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <?php echo Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                    </div>
                </div>
                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
</div>
</div>


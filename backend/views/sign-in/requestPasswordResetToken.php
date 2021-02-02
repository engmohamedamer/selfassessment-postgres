<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \organization\models\LoginForm */

\organization\assets\LoginAsset::register($this);
?>


<div class="wrapper">
        <header>
            <div class="container">
               


                <div class="row">
                    <div class="col-md-4">
                        <div class="login">
                        <a href="" class="brand-link"><img src="/img/tamkeen-logo2.png" width="150"> </a>
                            <h2>Change Password,</h2>
                            <h4>Tamkeen Admin!</h4>
                            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
                                <?php echo $form->field($model, 'email') ?> 
                                <div class="form-group">
                                  <button type="submit" class='btn btn-primary'>Change Password</button>
                                </div>
                            <?php ActiveForm::end() ?>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    </div>





<?php

use backend\models\City;
use backend\models\District;
use common\helpers\multiLang\MyMultiLanguageActiveField;
use common\models\Organization;
use common\models\User;
use common\models\UserProfile;
use kartik\widgets\ActiveForm;
use kartik\widgets\DepDrop;
use trntv\filekit\widget\Upload;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
\organization\assets\OrgUpdate::register($this);


$js = '
jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
        jQuery(this).html("Admin: " + (index + 1))
    });
});

jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
        jQuery(this).html("Admin: " + (index + 1))
    });
});
';

$this->registerJs($js);

/* @var $this yii\web\View */
/* @var $model common\models\Organization */
/* @var $form yii\widgets\ActiveForm */

$city = City::find()->all();
if (isset($model->city_id) and !empty($model->city_id)) {
    $district = District::find()->where("city_id = $model->city_id")->all();
}else{
    $district = [];
}

?>



    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <div class="alert alert-danger error-summary mt-2" style="display: none;">
        <?php  echo $form->errorSummary($model); ?>
    </div>

    <?php if (Yii::$app->session->hasFlash('errors')): ?>
        <div class="alert alert-danger error-summary mt-2">
            <?= Yii::$app->session->getFlash('errors') ?>
        </div>
    <?php endif; ?>

    <div class="content-header" style="">
        <div class="">
            <div class="">
                <h1><?= Html::encode($this->title) ?></h1>
            </div>
            <div class="actionBtns">
                <?php if($model->isNewRecord) :?>
                    <button type="submit" class="btn btn-success"><i class="icofont-verification-check mr-2 ml-2"></i> <?= Yii::t('common','Create');?></button>
                <?php else: ?>
                    <button type="submit" class="btn btn-success" name="Organization[save_exit]" value="save"><i class="icofont-verification-check mr-2 ml-2"></i> <?= Yii::t('common','Save Data');?></button>
                    <button type="submit" class="btn btn-success saveAndExit" name="Organization[save_exit]" value="exit"><i class="icofont-exit mr-2 ml-2"></i> <?= Yii::t('common','Save and Exit');?></button>
                <?php endif ?>
            </div>
            
        </div>
    </div>


<div class="row theme-edit" style='margin-right:0; margin-left:0;'>

    <div class='col-sm-2 col-lg-1 theme-nav' >
        <ul class="nav nav-pills nav-stacked">
            <li role="presentation" class="active"><a  href="#tab_1-1" data-toggle="tab" aria-expanded="true"><span ><i class="fas fa-edit"></i></span><p><?php echo Yii::t('backend', 'Main Details') ?></p></a></li>
            <?php if($model->isNewRecord) :?>
            <li role="presentation" class=""><a  href="#tab_6-6" data-toggle="tab" aria-expanded="true"><span ><i class="fas fa-eye"></i></span><p><?php echo Yii::t('common', 'Organization Admin') ?></p></a></li>
            <?php endif ?>
            <li role="presentation" class=""><a  href="#tab_2-2" data-toggle="tab" aria-expanded="true"><span ><i class="fas fa-eye"></i></span><p><?php echo Yii::t('common', 'Organization Theme') ?></p></a></li>

            <li role="presentation" class=""><a  href="#tab_3-3" data-toggle="tab" aria-expanded="true"><span > <i class="fas fa-palette"></i></span><p><?php echo Yii::t('common', 'Colors') ?></p></a></li>
            <li role="presentation" class=""><a  href="#tab_4-4" data-toggle="tab" aria-expanded="true"><span > <i class="fas fa-link"></i></span><p><?php echo Yii::t('common', 'Footer Links') ?></p></a></li>
            <li role="presentation" class=""><a  href="#tab_5-5" data-toggle="tab" aria-expanded="true"><span > <i class="fas fa-users"></i></span><p><?php echo Yii::t('common', 'Socail Links') ?></p></a></li>
            <?php if(Yii::$app->user->can('administrator') || Yii::$app->user->can('manager')): ?>
                <li role="presentation" class=""><a  href="#tab_7-7" data-toggle="tab" aria-expanded="true"><span > <i class="fas fa-sign-in-alt"></i></span><p><?php echo Yii::t('common', 'Login Settings') ?></p></a></li>
            <?php endif ?>

        
        </ul>
    </div>
    

    <div class='col-sm-10 col-lg-11 theme-edit-content'>
       
        <div class='theme-edit-form'>
            
            <div class="tab-content mt-5">




                <div class="tab-pane active" id="tab_1-1">
                    <div class="row">
                       <div class='col-sm-12 col-lg-8 row theme-edit-content-panel'>

                           <?php

                           if (Yii::$app->user->can('administrator') or Yii::$app->user->can('manager')) {
                               ?>

                               <div class="col-sm-12 slugaddon">
                                   <?= $form->field($model, 'slug',[
                                       'addon' => ['prepend' => ['content'=> str_ireplace('backend', '',$_SERVER['SERVER_NAME'])]]
                                   ])->textInput(['maxlength' => true]) ?>
                               </div>
                               <hr class='mt-5 mb-5 col-lg-12 row'>


                               <?
                           }?>

                            <div class="col-lg-6">
                                <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Name'])
                                    ->widget(MyMultiLanguageActiveField::className());  ?>
                            </div>
                            <div class="col-lg-6">
                                <?= $form->field($model, 'business_sector')->textInput(['maxlength' => true])->widget(MyMultiLanguageActiveField::className());  ?>

                            </div>
                            <div class="col-lg-6">
                                <?php echo $form->field($model, 'city_id')->dropDownList([''=>Yii::t('common',  'Select')]+ArrayHelper::map($city, 'id', 'title'),['id'=>'City-id',]) ?>
                            </div>

                            <div class="col-lg-6">
                                <?php echo $form->field($model, 'district_id')->widget(DepDrop::classname(), [
                                        'data'=> ArrayHelper::map($district,'id','title'),
                                        'options' => ['id'=>'subcat-id' ,'placeholder'=>Yii::t('common','Select City first')],
                                        'pluginOptions'=>[
                                            'depends'=>['City-id'],
                                            'placeholder' => Yii::t('common',  'Select') ,
                                            'url' => Url::to(['/helper/school-districts','schoolId'=>$model->id])
                                        ]
                                    ]);
                                ?>
                            </div>
                            <div class="col-lg-6">
                                <?= $form->field($model, 'address')->textInput(['maxlength' => true])->widget(MyMultiLanguageActiveField::className());  ?>
                            </div>
                            <div class="col-lg-6">
                                <?= $form->field($model, 'about')->textarea(['rows' => '6'])->widget(MyMultiLanguageActiveField::className());  ?>
                            </div>
                            <div class="col-lg-6">
                                <?= $form->field($model, 'postalcode')->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-lg-6">
                                <?= $form->field($model, 'postalbox')->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-lg-6">
                                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                            </div>

                            <div class="col-lg-6">
                                <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-lg-6">
                                <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>
                            </div>
                            
                            <!-- <div class="col-lg-6">
                                <?php // echo $form->field($model,'allow_registration')->checkBox(); 
                                ?>
                            </div> -->

                            <!-- <div class="col-lg-6 allowReg">
                                <b class='allowLabel'>السماح بالتسجيل للمشاركين</b>
                                <br>
                                <label class="switch">
                                    <input type="checkbox" name="Organization[allow_registration]"    <?php if($model->allow_registration){
                                            // echo "checked";
                                            }
                                        ?>
                                    >
                                    <span class="slider round"></span>
                                </label>
                            </div> -->


                            <hr class='mt-5 mb-5 col-lg-12 row'>

                            <div class="col-lg-6">
                                <?= $form->field($model, 'conatct_name')->textInput(['maxlength' => true])->widget(MyMultiLanguageActiveField::className());  ?>
                            </div>
                            <div class="col-lg-6">
                                <?= $form->field($model, 'contact_position')->textInput(['maxlength' => true])->widget(MyMultiLanguageActiveField::className());  ?>
                            </div>
                            <div class="col-lg-6">
                                <?= $form->field($model, 'contact_email')->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-lg-6">
                                <?= $form->field($model, 'contact_phone')->textInput(['maxlength' => true]) ?>
                            </div>
                            
                            <div class="col-lg-6">
                                <?= $form->field($model, 'limit_account')->textInput() ?>
                            </div>
                           

                            <div class="col-lg-6 ">
                                <?php echo  $form->field($theme, 'locale')->dropDownlist(Yii::$app->params['availableLocales']) ?>
                            </div>
                            
                       </div>

                       <div class='col-sm-0 col-lg-4 theme-edit-preview'>
                            <h2 class=''> <?php echo Yii::t('common', 'Preview') ?></h2>
                            <div class='preview-images mt-5'>
                                <div  class="tab-pane active">
                                    <p class='highlighted'><?php echo Yii::t('common', '* Please enter the required data in two languages arabic & english.') ?></p>
                                    <hr class='mt-5 mb-5'>
                                    <p><?php echo Yii::t('common', '* SLUG input is the subdomain of your website and contains your organization name in english with no spaces.') ?></p>
                                    <img src="/img/previews/preview4.png" alt="" class='mt-3 mb-3 img'>
                                    <hr class='mt-5 mb-5'>
                                    <p><?php echo Yii::t('common', '* Organization name shows in multiple places in your website like ( browser tab, website side menu and footer rights ).') ?></p>
                                    <p><?php echo Yii::t('common', '-- Examples --') ?></p>
                                    <img src="/img/previews/preview1.png" alt="" class='mt-3 mb-3 img'>
                                    <img src="/img/previews/preview2.png" alt="" class='mt-3 mb-3 img'>
                                    <img src="/img/previews/preview3.png" alt="" class='mt-3 mb-3 img'>

                                    <hr class='mt-5 mb-5'>
                                    <p><?php echo Yii::t('common', '* In default language part you enter the default language of your website.') ?></p>
                                    <hr class='mt-5 mb-5'>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>




                <div class="tab-pane " id="tab_2-2">
                    <div class='row'>
                        <div class='col-sm-12 col-lg-8 row theme-edit-content-panel'>
                            <div class="col-lg-6">
                                <?php echo $form->field($model, 'first_image')->widget(Upload::class, [
                                    'url'=>['first-upload'],
                                    'acceptFileTypes' => new JsExpression('/(\.|\/)(gif|jpeg|png)$/i'),
                                    'maxFileSize' => 10485760,
                                ]) ?>
                            </div>
                            <div class="col-lg-6">
                                <?php echo $form->field($model, 'second_image')->widget(Upload::class, [
                                    'url'=>['second-upload'],
                                    'acceptFileTypes' => new JsExpression('/(\.|\/)(gif|jpeg|png)$/i'),
                                    'maxFileSize' => 10485760,
                                ]) ?>
                            </div>
                        </div>
                        <div class='col-sm-0 col-lg-4 theme-edit-preview'>
                            <h2 class=''> <?php echo Yii::t('common', 'Preview') ?></h2>
                            <div class='preview-images mt-5'>
                                <div  class="tab-pane active" >
                                
                                    <p><?php echo Yii::t('common', '* Organization logo will be shown in your website header and the logo icon in your browser tab and website side menu.') ?></p>
                                    <p><?php echo Yii::t('common', '-- Examples --') ?></p>
                                    <img src="/img/previews/preview5.png" alt="" class='mt-3 mb-3 img'>
                                    <img src="/img/previews/preview6.png" alt="" class='mt-3 mb-3 img'>
                                    <p><?php echo Yii::t('common', 'Logos properties:') ?></p>
                                    <p><?php echo Yii::t('common', '- must be in PNG format.') ?></p>
                                    <p><?php echo Yii::t('common', '- size must be 1MB at max.') ?></p>
                                    <p><?php echo Yii::t('common', '- logo will be presented on white background so make sure that it suits it.') ?></p>
                                    <hr class='mt-5 mb-5'>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php if($model->isNewRecord) :?>

                <div class="tab-pane " id="tab_6-6">
                    <div class='row'>
                        <div class='col-sm-12 col-lg-8 row theme-edit-content-panel'>
                            <?=
                                $this->render('_formOrganizationAdmin', [
                                'form' => $form,
                                'user' => $user,
                                'profile' => $profile,
                                'modelsAdmins'=>$modelsAdmins
                            ]) ?>
                        </div>
                        <div class='col-sm-0 col-lg-4 theme-edit-preview'>
                            <h2 class=''> <?php echo Yii::t('common', 'Preview') ?></h2>
                            <div class='preview-images mt-5'>
                                <div  class="tab-pane active">
                                    <p><?php echo Yii::t('common', 'You can create as mush as you want of organizations admins.') ?></p>
                                    <p><?php echo Yii::t('common', 'Every Organization Admin has the ability to manage the organization details,create new assessments and invite new contributors.') ?></p>
                                    <!-- <p> <?php echo Yii::t('common', '-- Examples --') ?> </p>
                                    <img src="/img/previews/preview7.png" alt="" class='mt-3 mb-3 img'> -->
                                    <hr class='mt-5 mb-5'>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            <?php endif;?>


                <div class="tab-pane " id="tab_3-3">
                    <div class='row'>
                        <div class='col-sm-12 col-lg-8 row theme-edit-content-panel'>
                            <?=
                                $this->render('_formOrganizationThemeColor', [
                                'form' => $form,
                                'OrganizationTheme' => $theme,
                            ]) ?>
                        </div>
                        <div class='col-sm-0 col-lg-4 theme-edit-preview'>
                            <h2 class=''> <?php echo Yii::t('common', 'Preview') ?></h2>
                            <div class='preview-images mt-5'>
                                <div  class="tab-pane active">
                                    <p><?php echo Yii::t('common', 'Colors will present your organization identity in the website parts like buttons and backgrounds.') ?></p>
                                    <p><?php echo Yii::t('common', 'Please enter your main color and the second color with lower opacity.') ?></p>
                                    <p> <?php echo Yii::t('common', '-- Examples --') ?> </p>
                                    <img src="/img/previews/preview7.png" alt="" class='mt-3 mb-3 img'>
                                    <hr class='mt-5 mb-5'>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>



                <div class="tab-pane " id="tab_4-4">
                    <div class='row'>
                        <div class='col-sm-12 col-lg-8 row theme-edit-content-panel'>
                            <?=
                                $this->render('_formOrganizationThemeFooterLinks', [
                                'form' => $form,
                                'organizationFooterLinks' => $themeFooterLinks,
                            ]) ?>
                        </div>
                        <div class='col-sm-0 col-lg-4 theme-edit-preview'>
                            <h2 class=''> <?php echo Yii::t('common', 'Preview') ?></h2>
                            <div class='preview-images mt-5'>
                                <div  class="tab-pane active" >
                                    <p><?php echo Yii::t('common', 'Footer links will be shown in the footer and contains 5 links with short naming.') ?></p>
                                    <p><?php echo Yii::t('common', 'Please enter your links names in the required languages.') ?></p>
                                    <p> <?php echo Yii::t('common', '-- Examples --') ?> </p>
                                    <img src="/img/previews/preview7.png" alt="" class='mt-3 mb-3 img'>
                                    <hr class='mt-5 mb-5'>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>



                <div class="tab-pane " id="tab_5-5">
                    <div class='row'>
                        <div class='col-sm-12 col-lg-8 row theme-edit-content-panel'>
                            <?=
                                $this->render('_formOrganizationThemeLinks', [
                                'form' => $form,
                                'OrganizationTheme' => $theme,
                            ]) ?>
                        </div>
                        <div class='col-sm-0 col-lg-4 theme-edit-preview'>
                            <h2 class=''> <?php echo Yii::t('common', 'Preview') ?></h2>
                            <div class='preview-images mt-5'>
                                <div  class="tab-pane active" >
                                <p><?php echo Yii::t('common', 'Social media links will be shown in the footer.') ?></p>
                                    <p> <?php echo Yii::t('common', '-- Examples --') ?> </p>
                                    <img src="/img/previews/preview7.png" alt="" class='mt-3 mb-3 img'>
                                    <hr class='mt-5 mb-5'>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="tab-pane " id="tab_7-7">
                    <div class='row'>
                        <div class='col-sm-12 col-lg-8 row theme-edit-content-panel'>
                            <?=
                                $this->render('_formOrganizationLoginSetting', [
                                'form' => $form,
                                'model' => $model,
                            ]) ?>
                        </div>
                        <div class='col-sm-0 col-lg-4'>
                            <!-- <h2 class=''> <?php echo Yii::t('common', 'Preview') ?></h2>
                            <div class='preview-images mt-5'>
                                <div  class="tab-pane active" >
                                <p><?php echo Yii::t('common', 'Login using SSO Account manager.') ?></p>
                                     <p> <?php echo Yii::t('common', '-- Examples --') ?> </p> 
                                 <img src="/img/previews/preview7.png" alt="" class='mt-3 mb-3 img'>
                                    <hr class='mt-5 mb-5'>

                                </div>
                            </div> -->
                        </div>

                    </div>
                </div>

            </div>
            <!-- <div class="row">
                <div class="col-md-8">
                    <div class="form-group edit-theme-btn">
                        <?= Html::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Save Data'), ['class' => $model->isNewRecord ? 'btn btn-success mr-5 ml-5 ' : 'btn btn-success mr-5 ml-5']) ?>
                        <?= Html::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Save and Exit'), ['class' => $model->isNewRecord ? 'btn btn-success mr-5 ml-5' : 'btn btn-success mr-5 ml-5']) ?>
                    </div>
                </div>
            </div> -->
           
     

        </div>
        

    </div>

    

</div>

    <?php ActiveForm::end(); ?>



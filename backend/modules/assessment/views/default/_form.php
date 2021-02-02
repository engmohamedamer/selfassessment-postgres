<?php
/**
 * Created by PhpStorm.
 * User: kozhevnikov
 * Date: 05/10/2017
 * Time: 14:24
 */

use common\helpers\Filter;
use common\models\OrganizationStructure;
use kartik\dialog\Dialog;
use kartik\editable\Editable;
use kartik\helpers\Html;
use kartik\select2\Select2;
use kartik\tree\TreeViewInput;
use onmotion\yii2\widget\upload\crop\UploadCrop;
use organization\models\search\UserSearch;
use sjaakp\taggable\TagEditor;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $survey \backend\modules\assessment\models\Survey */
/* @var $withUserSearch boolean */

// $withUserSearch = true;
// widget with default options
echo Dialog::widget();

if (Yii::$app->user->identity->userProfile->organization) {
    $brandPrimColor =  Yii::$app->user->identity->userProfile->organization->organizationTheme->brandPrimColor; 
    $brandSecColor =  Yii::$app->user->identity->userProfile->organization->organizationTheme->brandSecColor; 
}


?>

<style>
.surveylevels .col-md-10,.surveylevels .col-md-4{
    padding:0 15px;
}
.tag-editor {
    background: #f9f9f9;
    border:0px;
    border-bottom: 1px solid #8e44ad !important;
}
.select2-container--krajee .select2-selection--multiple .select2-search--inline .select2-search__field{
    background: #f9f9f9;
    border-bottom: 1px solid #8e44ad !important;
}
.input-lg.select2-container--krajee .select2-selection--multiple, .input-group-lg .select2-container--krajee .select2-selection--multiple {
    min-height: 40px;
    border: 0;
}
</style>
    <div class='row' style='padding:0 0px 70px;'>
        <div class='col-sm-12 col-md-12'>
            <div class="survey-container  ">
                <div class="survey-block">
                    <?php

                    echo Html::beginTag('div', ['class' => 'survey-name-wrap']);

                    \yii\widgets\Pjax::begin([
                        'id' => 'form-photo-pjax',
                        'timeout' => 0,
                        'enablePushState' => false
                    ]);
                    $form = ActiveForm::begin([
                        'id' => 'survey-photo-form',
                        'action' => \yii\helpers\Url::toRoute(['default/update-image', 'id' => $survey->survey_id]),
                        'options' => ['class' => 'form-horizontal', 'data-pjax' => true],
                        //  'enableAjaxValidation' => true,
                    ]);

                    echo UploadCrop::widget([
                        'form' => $form,
                        'model' => $survey,
                        'attribute' => 'imageFile',
                        'enableClientValidation' => true,
                        'defaultPreviewImage' => $survey->getImage(),
                        'jcropOptions' => [
                            //  'dragMode' => 'none',
                            'viewMode' => 2,
                            'aspectRatio' => 1,
                            'autoCropArea' => 1,
                            'rotatable' => true,
                            'scalable' => true,
                            'zoomable' => true,
                            'toggleDragModeOnDblclick' => false
                        ]
                    ]);

                    ActiveForm::end();
                    \yii\widgets\Pjax::end();

                    echo Editable::widget([
                        'model' => $survey,
                        'attribute' => 'survey_name',
                        'asPopover' => true,
                        'header' => Yii::t('survey','Name'),
                        'size' => 'md',
                        'formOptions' => [
                            'action' => Url::toRoute(['default/update-editable', 'property' => 'survey_name'])
                        ],
                        'additionalData' => ['id' => $survey->survey_id],
                        'options' => [
                            'class' => 'form-control',
                            'placeholder' => Yii::t('survey','Enter assessment name...'),
                        ]
                    ]);
                    echo Html::endTag('div');
                    echo Html::tag('br', '');



                    echo Html::beginTag('div', ['class' => 'survey-content-wrap']);
                    
                    echo Html::beginTag('div', ['class' => 'row', 'style' => 'justify-content: center;']);
                    echo Html::beginTag('div', ['class' => 'col-md-3', 'style' => 'background: '.$brandSecColor.'; color:#000; border-radius: 10px; text-align: center; margin:5px;']);
                    echo Html::label(Yii::t('survey', 'Expired at') . ': ', 'survey-survey_expired_at');
                    echo Html::tag('br', '');

                    echo Editable::widget([
                        'model' => $survey,
                        'attribute' => 'survey_expired_at',
                        'header' => Yii::t('survey', 'Expired at'),
                        'placement'=>'bottom',
                        'asPopover' => true,
                        'size' => 'md',
                        'inputType' => Editable::INPUT_DATETIME,
                        'formOptions' => [
                            'action' => Url::toRoute(['default/update-editable', 'property' => 'survey_expired_at'])
                        ],
                        'additionalData' => ['id' => $survey->survey_id],
                        'options' => [
                            'class' => Editable::INPUT_DATETIME,
                            
                            'pluginOptions' => [
                                'autoclose' => true,
                                'startDate' => date('Y-m-d h:i:s',time()),
                                // 'format' => 'd.m.Y H:i'
                            ],
                            'options' => ['placeholder' => Yii::t('survey', 'Expired at')]
                        ],
                        'showButtonLabels' => true,
                        'submitButton' => [
                            'icon' => false,
                            'label' => Yii::t('survey','OK'),
                            'class' => 'btn btn-sm btn-primary'
                        ],
                        'resetButton'=>[
                            'label' => Yii::t('survey','Reset'),
                        ]
                    ]);
                    echo Html::endTag('div'); // col-md-3

                    echo Html::beginTag('div', ['class' => 'col-md-3', 'style' => 'background: '.$brandSecColor.'; color:#000; border-radius: 10px; text-align: center; margin:5px;']);
                    echo Html::label(Yii::t('survey', 'Time to pass') . ': ', 'survey-survey_time_to_pass');
                    echo Html::tag('br', '');
                    echo Editable::widget([
                        'model' => $survey,
                        'attribute' => 'survey_time_to_pass',
                        'asPopover' => true,
                        'header' => Yii::t('survey', 'Time to pass'),
                        'size' => 'md',
                        'formOptions' => [
                            'action' => Url::toRoute(['default/update-editable', 'property' => 'survey_time_to_pass'])
                        ],
                        'additionalData' => ['id' => $survey->survey_id],
                        'options' => [
                            'class' => 'form-control',
                            'placeholder' => Yii::t('survey', 'Enter time in minutes...'),
                            'type' => 'number',
                        ]
                    ]);
                    echo Html::label(Yii::t('survey', 'minutes'));
                    echo Html::endTag('div'); // col-md-3


                    echo Html::beginTag('div', ['class' => 'col-md-3', 'style' => 'background: '.$brandSecColor.'; color:#000; border-radius: 10px; text-align: center; margin:5px;']);
                    echo Html::label(Yii::t('survey', 'Assessment Point (optional)') . ': ', 'survey-survey_point');
                    echo Html::tag('br', '');
                    echo Editable::widget([
                        'model' => $survey,
                        'attribute' => 'survey_point',
                        'asPopover' => true,
                        'header' => Yii::t('survey', 'Assessment Point'),
                        'size' => 'md',
                        'formOptions' => [
                            'action' => Url::toRoute(['default/update-editable', 'property' => 'survey_point'])
                        ],
                        'additionalData' => ['id' => $survey->survey_id],
                        'options' => [
                            'class' => 'form-control',
                            'placeholder' => Yii::t('survey', 'Enter Assessment Point...'),
                            'type' => 'number',
                        ]
                    ]);
                    echo Html::label(Yii::t('survey', 'Point'));
                    echo Html::endTag('div'); // col-md-3
                    echo Html::endTag('div'); // row





                    Pjax::begin([
                        'id' => 'survey-pjax',
                        'enablePushState' => false,
                        'timeout' => 0,
                        'scrollTo' => false,
                        'clientOptions' => [
                            'type' => 'post',
                            'skipOuterContainers' => true,
                        ]
                    ]);

                    $form = ActiveForm::begin([
                        'id' => 'survey-form',
                        'action' => Url::toRoute(['default/update', 'id' => $survey->survey_id]),
                        'options' => ['class' => 'form-inline', 'data-pjax' => true],
                        'enableClientValidation' => false,
                        'enableAjaxValidation' => false,
                        'fieldConfig' => [
                            'template' => "<div class='survey-form-field'>{label}{input}\n{error}</div>",
                            'labelOptions' => ['class' => ''],
                        ],
                    ]);

                    if ($survey->survey_point) {
                        $hide = '';
                    }else{
                        $hide = 'hide';
                    }

                    echo Html::beginTag('div', ['class' => 'row surveylevels '.$hide]);

                    echo Html::beginTag('div', ['class' => 'col-md-10 col-md-offset-1']);
                    echo Html::beginTag('div', ['class' => 'col-md-4']);
                        echo $form->field($survey, "level_title[]")->input('text',['value' => $survey->levels[0]->title ]);
                        echo Html::endTag('div');
                        echo Html::beginTag('div', ['class' => 'col-md-4']);
                        echo $form->field($survey, "level_from[]")->input('number',['value' => $survey->levels[0]->from ]);
                        echo Html::endTag('div');
                        echo Html::beginTag('div', ['class' => 'col-md-4']);
                        echo $form->field($survey, "level_to[]")->input('number',['value' => $survey->levels[0]->to ]);
                        echo Html::endTag('div');
                        echo Html::endTag('div');
                    echo Html::beginTag('div', ['class' => 'col-md-10 col-md-offset-1']);
                    echo Html::beginTag('div', ['class' => 'col-md-4']);
                        echo $form->field($survey, "level_title[]")->input('text',['value' => $survey->levels[1]->title ]);
                        echo Html::endTag('div');
                        echo Html::beginTag('div', ['class' => 'col-md-4']);
                        echo $form->field($survey, "level_from[]")->input('number',['value' => $survey->levels[1]->from ]);
                        echo Html::endTag('div');
                        echo Html::beginTag('div', ['class' => 'col-md-4']);
                        echo $form->field($survey, "level_to[]")->input('number',['value' => $survey->levels[1]->to ]);
                    echo Html::endTag('div');
                    echo Html::endTag('div');
                    echo Html::beginTag('div', ['class' => 'col-md-10 col-md-offset-1']);
                    echo Html::beginTag('div', ['class' => 'col-md-4']);
                        echo $form->field($survey, "level_title[]")->input('text',['value' => $survey->levels[2]->title ]);
                        echo Html::endTag('div');
                        echo Html::beginTag('div', ['class' => 'col-md-4']);
                        echo $form->field($survey, "level_from[]")->input('number',['value' => $survey->levels[2]->from ]);
                        echo Html::endTag('div');
                        echo Html::beginTag('div', ['class' => 'col-md-4']);
                        echo $form->field($survey, "level_to[]")->input('number',['value' => $survey->levels[2]->to ]);
                        echo Html::endTag('div');
                        echo Html::endTag('div');
                    echo Html::beginTag('div', ['class' => 'col-md-10 col-md-offset-1']);
                    echo Html::beginTag('div', ['class' => 'col-md-4']);
                        echo $form->field($survey, "level_title[]")->input('text',['value' => $survey->levels[3]->title ]);
                        echo Html::endTag('div');
                        echo Html::beginTag('div', ['class' => 'col-md-4']);
                        echo $form->field($survey, "level_from[]")->input('number',['value' => $survey->levels[3]->from ]);
                        echo Html::endTag('div');
                        echo Html::beginTag('div', ['class' => 'col-md-4']);
                        echo $form->field($survey, "level_to[]")->input('number',['value' => $survey->levels[3]->to ]);

                    echo Html::endTag('div');
                            echo Html::endTag('div');
                            echo Html::endTag('div');
                            echo Html::beginTag('div', ['class' => 'row']);
                            echo Html::beginTag('div', ['class' => 'col-md-12']);

                    echo $form->field($survey, "survey_descr", ['template' => "<div class='survey-form-field'>{label}{input}</div>",]
                    )->textarea(['rows' => 3]);

                    echo $form->field($survey, "start_info", ['template' => "<div class='survey-form-field'>{label}{input}</div>",]
                    )->textarea(['rows' => 3, 'style' => 'height:auto', ]);


                        echo Html::tag('div', '', ['class' => 'clearfix']);
                        echo Html::endTag('div'); // col-md-12
                    echo Html::endTag('div');
                    // echo Html::endTag('div');

                    echo Html::beginTag('div', ['class' => 'row']);
                    echo Html::beginTag('div', ['class' => 'col-md-3']);
                    
                    echo $form->field($survey, "survey_is_closed", ['template' => "<div class='survey-form-field submit-on-click tooltipdiv' data-toggle='tooltip' data-placement='top' title='هل الإستبيان مغلق أم متاح للمشاركين؟'>  {input}{label}</div>",]
                    )->checkbox(['class' => 'checkbox danger'], false);
                    echo Html::tag('div', '', ['class' => 'clearfix']);
                    // echo $form->field($survey, "survey_is_pinned", ['template' => "<div class='survey-form-field submit-on-click'>{input}{label}</div>",]
                    // )->checkbox(['class' => 'checkbox'], false);
                    // echo Html::tag('div', '', ['class' => 'clearfix']);
                    echo $form->field($survey, "survey_is_visible", ['template' => "<div class='survey-form-field submit-on-click tooltipdiv' data-toggle='tooltip' data-placement='top' title='هل الإستبيان جاهز للظهور للمشاركين؟'> {input}{label}</div>",]
                    )->checkbox(['class' => 'checkbox'], false);
                    if ($withUserSearch) {
                        echo Html::tag('div', '', ['class' => 'clearfix']);
                        echo $form->field($survey,
                            "survey_is_private",
                            ['template' => "<div class='survey-form-field submit-on-click'>{input}{label}</div>",]
                        )->checkbox(['class' => 'checkbox danger'], false);
                    }
                    echo Html::endTag('div'); // col-md-3

                    echo Html::beginTag('div', ['class' => 'col-md-9']);
                        echo '<label class="" for="survey-userslist">'. \Yii::t('common', 'Sector') .'</label>';
                        echo \kartik\tree\TreeViewInput::widget([
                            'name' => 'Survey[sector_ids]',
                            'value' => is_array($survey->sector_ids) ? 
                                    implode(',', $survey->sector_ids) : 'true'
                            , // preselected values
                            'query' => Filter::organizationStructureQuery(),
                            'headingOptions' => ['label' => 'Store'],
                            'rootOptions' => ['label'=>'<i class="fas fa-tree text-success"></i>'],
                            'fontAwesome' => true,
                            'asDropdown' => true,
                            'multiple' => true,
                            'options' => ['disabled' => false]
                        ]);

                        // echo $form->field($survey, 'sector_ids')->widget(TreeViewInput::classname(),
                        // [
                        //     'name' => 'kvTreeInput',
                        //     'value' => '8,9', // preselected values
                        //     'query' => Filter::organizationStructureQuery(),
                        //     'headingOptions' => ['label' => Yii::t('common','Sector')],
                        //     'rootOptions' => ['label'=>'<i class="fas fa-tree text-success"></i>'],
                        //     'fontAwesome' => true,
                        //     'asDropdown' => true,
                        //     'multiple' => true,
                        //     'options' => ['disabled' => false]
                        // ]);
                    ?>
                    
                    <?= $form->field($survey, 'tags')->widget(TagEditor::class, [
                        'clientOptions' => [
                            'autocomplete' => [
                                'source' => Url::toRoute(['/tag/suggest'])
                            ],
                        ]
                    ]) ?>
                    <?php

                    $users = UserSearch::usersBySector(Yii::$app->user->identity->userProfile->organization_id);

                    echo $form->field($survey, 'usersList')->widget(Select2::classname(), [
                        'data' => $users,
                        'size' => Select2::LARGE,
                        'options' => ['placeholder' => Yii::t('common','Select'),'multiple' => true],
                        'pluginOptions' => [
                            'allowClear' => true,
                            'dir'=>'rtl'
                        ],
                    ]);
                    

                    if ($withUserSearch) {
                        echo Html::tag('div', '', ['class' => 'clearfix']);
                        echo $form->field($survey, 'restrictedUserIds')->widget(Select2::classname(),
                            [
                                'initValueText' => $survey->restrictedUsernames, // set the initial display text
                                'options' => ['placeholder' => \Yii::t('survey', 'Restrict assessment to selected user...')],
                                'pluginOptions' => [
                                    'allowClear' => true,
                                    'minimumInputLength' => 3,
                                    'language' => [
                                        'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
                                    ],
                                    'ajax' => [
                                        'url' => Url::toRoute(['default/search-respondents-by-token']),
                                        'dataType' => 'json',
                                        'data' => new JsExpression('function(params) { return {token:params.term}; }')
                                    ],
                                    'multiple' => true,
                                    'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                                    'templateResult' => new JsExpression('function(city) { return city.text; }'),
                                    'templateSelection' => new JsExpression('function (city) { return city.text; }'),
                                ],
                                'pluginEvents' => [
                                    'change' => new JsExpression('function() {         
                                        var container = $(this).closest(\'[data-pjax-container]\');
                                        container.find(\'button[type=submit]\').click(); 
                                    }')
                                ]
                            ]);
                    }
                    echo Html::endTag('div'); // row
                    echo Html::endTag('div'); // col-md-9 
                    echo Html::submitButton('', ['class' => 'hidden']);
                    echo Html::tag('div', '', ['class' => 'clearfix']);


                    ActiveForm::end();

                    Pjax::end();
                    echo Html::endTag('div');

                    ?>


                    

                </div>
                <div class="clearfix"></div>
                <hr>
                <div id="survey-questions">
                    <!-- <h2 class='mt-2 mb-3 qNumHeader' style='color:#fff; margin: 20px auto; text-align: center;'><?= Yii::t('common','Questions')  ?> (<span><?= count($survey->questions)  ?></span>)</h2> -->
                    <?php
                    foreach ($survey->questions as $i => $question) {
                        echo $this->render('/question/_form', ['question' => $question]);
                    }
                    ?>
                </div>
                <?php
                echo Html::tag('div', '', ['id' => 'survey-questions-append']);

                Pjax::begin([
                    'id' => 'survey-questions-pjax',
                    'enablePushState' => false,
                    'timeout' => 0,
                    'scrollTo' => false,
                    'clientOptions' => [
                        'type' => 'post',
                        'container' => '#survey-questions-append',
                        'skipOuterContainers' => true,
                    ]
                ]);

                echo Html::beginTag('div', ['class' => 'text-center survey-btn addQFixed']);
                    // echo Html::beginTag('div', ['class' => 'row col-sm-12']);
                    // echo Html::a('jjjjjjjjjjj' , Url::toRoute(['question/create', 'id' => $survey->survey_id]), ['class' => '', 'alt' => 'سؤال نصي', 'title' => 'سؤال نصي']);

                    // echo Html::endTag('div');
                    
                    // echo Html::a('<span class="fa fa-plus"></span> ' . Yii::t('survey', 'Add question'), Url::toRoute(['question/create', 'id' => $survey->survey_id]), ['class' => 'btn btn-secondary']);
                    echo Html::a('<i class="icofont-ui-text-chat"></i> <span>'.Yii::t('survey','Single textbox').'</span>' , Url::toRoute(['question/create', 'id' => $survey->survey_id,'type'=>6]), ['class' => '', 'alt' => Yii::t('survey','Single textbox'), 'title' => Yii::t('survey','Single textbox')]);
                    echo Html::a('<i class="icofont-page"></i> <span>'.Yii::t('survey','Text Area').'</span>' , Url::toRoute(['question/create', 'id' => $survey->survey_id,'type'=>8]), ['class' => '', 'alt' => Yii::t('survey','Comment box'), 'title' => Yii::t('survey','Comment box')]);
                    echo Html::a('<i class="icofont-sub-listing"></i> <span>'.Yii::t('survey','Dropdown').'</span>' , Url::toRoute(['question/create', 'id' => $survey->survey_id,'type'=>3]), ['class' => '', 'alt' => Yii::t('survey','Dropdown'), 'title' => Yii::t('survey','Dropdown')]);
                    echo Html::a('<i class="icofont-listing-box"></i> <span>'.Yii::t('survey','Multiple choice').'</span>' , Url::toRoute(['question/create', 'id' => $survey->survey_id,'type'=>1]), ['class' => '', 'alt' => Yii::t('survey','Multiple choice'), 'title' => Yii::t('survey','Multiple choice')]);
                    echo Html::a('<i class="icofont-listing-number"></i> <span>'.Yii::t('survey','One choise of list').'</span>' , Url::toRoute(['question/create', 'id' => $survey->survey_id,'type'=>2]), ['class' => '', 'alt' => Yii::t('survey','One choise of list'), 'title' => Yii::t('survey','One choise of list')]);
                    echo Html::a('<i class="icofont-ui-calendar"></i> <span>'.Yii::t('survey','Date/Time').'</span>' , Url::toRoute(['question/create', 'id' => $survey->survey_id,'type'=>9]), ['class' => '', 'alt' => Yii::t('survey','Date/Time'), 'title' => Yii::t('survey','Date/Time')]);
                    echo Html::a('<i class="icofont-ui-rate-blank"></i> <span>'.Yii::t('survey','Rating').'</span>' , Url::toRoute(['question/create', 'id' => $survey->survey_id,'type'=>5]), ['class' => '', 'alt' => Yii::t('survey','Rating'), 'title' => Yii::t('survey','Rating')]);
                    echo Html::a('<i class="icofont-attachment"></i> <span>'.Yii::t('survey','File').'</span>' , Url::toRoute(['question/create', 'id' => $survey->survey_id,'type'=>11]), ['class' => '', 'alt' => Yii::t('survey','File'), 'title' => Yii::t('survey','File')]);
                    echo Html::a('<i class="icofont-numbered"></i> <span>'.Yii::t('survey','Ranking').'</span>' , Url::toRoute(['question/create', 'id' => $survey->survey_id,'type'=>4]), ['class' => '', 'alt' => Yii::t('survey','Ranking'), 'title' => Yii::t('survey','Ranking')]);

                    echo Html::submitButton('<i class="icofont-save mr-2 ml-2"></i> ' . Yii::t('survey', 'Save'),
                    ['class' => 'btn btn-primary saveSurveyBtn', 'data-default-text' => '<i class="fa fa-floppy-o" aria-hidden="true"></i> ' . Yii::t('survey', 'Save'),'id' => 'save', 'data-action' => Url::toRoute(['default/view', 'id' => $survey->survey_id])]);
                echo Html::endTag('div');

                // echo Html::tag('div', , ['class' => '' ]);

                Pjax::end(); ?>


            </div>
        </div>
        

        <!-- <div class='col-sm-12 col-md-2'>
            <div class='survey-details'>
                hhhhhhhhhh
            </div>
        </div> -->
        
    
    </div>

    <div class='survey-details' style="display:none">
        <div class='inner-details'>
            <h5> <i class="icofont-paper mr-2 ml-2"></i>  تفاصيل الإستبيان 
                <!-- <i title='closed' style='color:red' class="icofont-1x icofont-lock mr-2 ml-2"></i>  -->
                <!-- <i title='invisible' style='color:red' class="icofont-1x mr-2 ml-2 icofont-eye-blocked"></i>  -->
                <i title='visible' style='color:green' class="icofont-1x mr-2 ml-2 icofont-eye"></i>
                <!-- <i title='open' style='color:green' class="icofont-1x mr-2 ml-2 icofont-unlocked"></i>  -->
            </h5>
            <hr>
            <p><p><span>حالة الإستبيان :</span> مغلق - غير مرئي للمشاركين</p> </p>
            <p><span>ينتهي بعد :</span> 20 يوم</p>
            <hr>
            
            <p><span>عدد الأسئلة :</span> 50</p>
            <p><span>عدد النقاط :</span> 100</p>
            <p><span>النقاط المتبقية :</span> 10</p>
            <p><span>متوسط النتائج :</span> جيد جداً</p>
            <p><span>المشاركين :</span> 8/120</p>
        </div>
    </div>
    

<?php
$this->registerJs(<<<JS
$(document).ready(function(e) {
  $(document).on('cropdone', function() {
    $('#survey-photo-form').submit();
  });
});
JS
);

$this->registerCss(<<<CSS
.modal-backdrop.in{
display: none;
}
CSS
);

$this->registerJs(<<<JS
$(document).ready(function (e) {
    $.fn.survey();

    $('.addQFixed a').on('click', function () {
        $("html, body").animate({ scrollTop: $(document).height() }, 1000);
        // $('.qNumHeader span').html(parseInt($('.qNumHeader span').html())+ 1)
    })

    $('.popover-dismiss').popover({
        container: 'body',
        trigger: 'focus'
    })
});


$("#survey-survey_point-popover .kv-editable-submit").click(function(){
    if($("#survey-survey_point").val()>0){
        $(".surveylevels").removeClass("hide")
    }else{
        $(".surveylevels").addClass("hide")
    }
    
   
})

JS
);

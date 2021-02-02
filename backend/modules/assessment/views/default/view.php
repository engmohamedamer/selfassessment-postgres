<?php
/**
 * Created by PhpStorm.
 * User: kozhevnikov
 * Date: 05/10/2017
 * Time: 14:24
 */

use backend\modules\assessment\models\Survey;
use backend\modules\assessment\models\SurveyStat;
use backend\modules\assessment\models\search\SurveyStatSearch;
use cenotia\components\modal\RemoteModal;
use common\helpers\Filter;
use common\models\OrganizationStructure;
use common\models\User;
use kartik\editable\Editable;
use kartik\helpers\Html;
use kartik\select2\Select2;
use kartik\tree\TreeViewInput;
use organization\models\search\UserSearch;
use sjaakp\taggable\TagEditor;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\bootstrap\BootstrapPluginAsset;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $survey \backend\modules\assessment\models\Survey */
/* @var $respondentsCount integer */
/* @var $withUserSearch boolean */

$this->title = Yii::t('survey', 'Survey') . ' - ' . $survey->survey_name;

BootstrapPluginAsset::register($this);

error_reporting(0);
?>
<style>
.surveylevels .col-md-10,.surveylevels .col-md-4{
    padding:0 15px;
}
</style>
    <div  id="survey-view" data-SurveyId='<?= $survey->survey_id; ?>'>
        <div id="survey-title">
            <div class="subcontainer flex">
                <h4><?= $survey->survey_name; ?></h4>
                <div>
                    <div class="survey-labels">
                        <a href="<?= Url::toRoute(['default/update/', 'id' => $survey->survey_id]) ?>"
                           class="btn btn-info btn-xs survey-label" data-pjax="0"
                           title="edit"><span class="glyphicon glyphicon-pencil"></span>
                       </a>
                        <a class="survey-label btn btn-info btn-xs" data-options="" href="/respondents?surveyId=<?=$survey->survey_id?>">
                            <?= \Yii::t('survey', 'Respondents count') ?>: <?= $survey->getRespondentsCount() ?>
                        </a>   
                        
                        <span class="survey-label btn btn-info btn-xs" data-toggle="tooltip"
                              title="<?= \Yii::t('survey', 'Questions') ?>">
                               <?= \Yii::t('survey', 'Questions') ?>: <?= $survey->getQuestions()->count() ?>
                        </span>
                    </div>

                </div>

            </div>
            <div class="subcontainer">
                <?php
                echo Html::beginTag('div', ['class' => 'row']);
                echo Html::beginTag('div', ['class' => 'col-md-6']);
                echo Html::label(Yii::t('survey', 'Expired at') . ' : ', 'survey-survey_expired_at');
                echo Editable::widget([
                    'model' => $survey,
                    'attribute' => 'survey_expired_at',
                    'header' => 'Expired at',
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
                            // 'format' => 'd.m.Y H:i'
                        ],
                        'options' => ['placeholder' => 'Expired at']
                    ]
                ]);
                echo Html::endTag('div');

                echo Html::beginTag('div', ['class' => 'col-md-6']);
                echo Html::endTag('div');
                echo Html::endTag('div');

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

                echo Html::beginTag('div', ['class' => 'row']);
                if ($survey->survey_point) {
                    echo Html::beginTag('div', ['class' => 'col-md-3']);
                        echo $form->field($survey, "survey_point", ['template' => "<div class='survey-form-field'>{label}{input}</div>",]
                        )->input('number',['min'=>0,'disabled'=>true]);
                    echo Html::endTag('div'); // row
                }

                echo Html::beginTag('div', ['class' => 'col-md-12']);
                echo $form->field($survey, "survey_descr", ['template' => "<div class='survey-form-field'>{label}{input}</div>",]
                )->textarea(['rows' => 3,'disabled'=>true]);

                if (!empty($survey->start_info)) {
                     echo $form->field($survey, "start_info", ['template' => "<div class='survey-form-field'>{label}{input}</div>",]
                    )->textarea(['rows' => 3,'calss'=>'form-control','disabled'=>true]);
                }

                echo Html::tag('div', '', ['class' => 'clearfix']);
                echo Html::endTag('div');
                echo Html::endTag('div');

                echo Html::beginTag('div', ['class' => 'row']);
                echo Html::beginTag('div', ['class' => 'col-md-3']);
                echo $form->field($survey, "survey_is_closed", ['template' => "<div class='survey-form-field submit-on-click'>{input}{label}</div>",]
                )->checkbox(['class' => 'checkbox danger'], false);
                echo Html::tag('div', '', ['class' => 'clearfix']);
                // echo $form->field($survey, "survey_is_pinned", ['template' => "<div class='survey-form-field submit-on-click'>{input}{label}</div>",]
                // )->checkbox(['class' => 'checkbox'], false);
                // echo Html::tag('div', '', ['class' => 'clearfix']);
                echo $form->field($survey, "survey_is_visible", ['template' => "<div class='survey-form-field submit-on-click'>{input}{label}</div>",]
                )->checkbox(['class' => 'checkbox'], false);
				if ($withUserSearch) {
					echo Html::tag('div', '', ['class' => 'clearfix']);
					echo $form->field($survey,
						"survey_is_private",
						['template' => "<div class='survey-form-field submit-on-click'>{input}{label}</div>",]
					)->checkbox(['class' => 'checkbox danger'], false);
				}
                echo Html::endTag('div');
                if (is_array($survey->sector_ids)) {
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
                            'options' => ['disabled' => true]
                        ]);
                    echo Html::endTag('div');
                }

                if ($survey->tags) {
                    echo Html::beginTag('div', ['class' => 'col-md-12']);
                    echo $form->field($survey, "tags")->widget(TagEditor::class, [
                        'clientOptions' => [
                            'autocomplete' => [
                                'source' => Url::toRoute(['/tag/suggest'])
                            ],
                            'disabled'=>true
                        ]
                    ]);
                    echo Html::endTag('div');
                }
                echo Html::endTag('div');

                echo Html::submitButton('', ['class' => 'hidden']);
                echo Html::tag('div', '', ['class' => 'clearfix']);

                ActiveForm::end();

                Pjax::end();
                ?>

            </div>

        </div>
        <?php if($survey->survey_point):?>
        <div class='row'>
            <!-- <div class="text-center surveyView-preloader preloader col-sm-12" style="display:none">
                <img src="./img/preloader.gif" alt="">
            </div> -->
            <?php if(count($survey->stats)) :?>
                <?php if(count($survey->levels)) :?>
                    <div class='col-md-6'>
                        <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?= Yii::t('common','Assessment ratios in the assessments') ?></h3>
                            <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <canvas id="surveyViewChart" style="height: 237px; width: 475px;" height="237" width="475"></canvas>
                        </div>
                        <!-- /.box-body -->
                        </div>
                    </div>
                <?php endif;?>
            <div class="col-md-6">
                <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= Yii::t('common','Participation in the assessment') ?></h3>

                    <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <canvas id="participantsStatusChart" style="height: 237px; width: 475px;" height="237" width="475"></canvas>
                </div>
                <!-- /.box-body -->
                </div>
            </div>
            <?php endif;?>
        </div>
        <?php endif;?>
        <div>
            <div class="survey-container">

                <div id="survey-questions">
                    <?php
                    foreach ($survey->questions as $i => $question) {
                        echo $this->render('/question/_viewForm', ['question' => $question, 'number' => $i]);
                    }
                    ?>
                </div>
            </div>
            <div class='survey-details' style="display:none">
                <div class='inner-details'>
                    <h5> <i class="icofont-paper mr-2 ml-2"></i>  تفاصيل الإستبيان 
                        <i title='closed' style='color:red' class="icofont-1x icofont-lock mr-2 ml-2"></i> 
                        <i title='invisible' style='color:red' class="icofont-1x mr-2 ml-2 icofont-eye-blocked"></i> 
                        <!-- <i title='visible' style='color:green' class="icofont-1x mr-2 ml-2 icofont-eye"></i> -->
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
        </div>
    </div>

<div class="hidden-modal-right " id="respondents-modal">
    <div class="close-btn">&times;</div>
    <?php

    $surveyId = $survey->survey_id;

    echo $this->render('respondents',
        compact('searchModel', 'dataProvider', 'surveyId', 'withUserSearch','survey'));
    ?>
</div>


<?php
$this->registerJs(<<<JS
$(document).ready(function(e) {
    setTimeout(function() {
       $('.progress-bar').each(function(i, el) {
            if ($(el).hasClass('init')){
                $(el).removeClass('init');
            }
        })
    }, 1000);
});
JS
);
$id  = $survey->survey_id;

$organization = Yii::$app->user->identity->userProfile->organization;
$survey = Survey::find()->where(['org_id'=>$organization->id,'survey_id'=>$id])->one();
if(isset($survey->stats)){
    foreach ($survey->stats as $stat) {
        $gained_points =  \Yii::$app->db->createCommand('SELECT sum(survey_user_answer_point::integer) as gained_points from survey_user_answer where survey_user_answer_user_id = '.$stat->survey_stat_user_id.' and survey_user_answer_survey_id ='.$survey->survey_id )->queryScalar();
        $gained_score_title = [];
        if ($survey->survey_point) {
            $gained_score =  ($gained_points / $survey->survey_point) * 100;
            foreach ($survey->levels as $key => $value) {
                if ($value->from <= $gained_score and $gained_score <= $value->to) {
                    $gained_score_title[] = $value->title;
                    break;
                }
            }

        }
    }
}
$titles = [];
$counts = [];
if(isset($survey->levels)){
foreach ($survey->levels as $level) {
    $titles[] = $level->title;
    $counts[] = $gained_score_title ? array_count_values($gained_score_title)[$level->title] ?: 0 : 0;
}
}
$labelsData = json_encode($titles);
$countData = json_encode($counts);

// return var_dump($labelsData);
// return ['labels'=> $titles ,'data'=>$counts];




$searchModel = new UserSearch();
$searchModel->user_role = User::ROLE_USER;
$searchModel->organization_id = $organization->id;
$dataProvider = $searchModel->search([]);
$orgUserCount =  count($dataProvider->getModels());
$countComplete = SurveyStat::find()->where(['survey_stat_survey_id'=> $id,'survey_stat_is_done'=>1])->count();
$countUncomplete = SurveyStat::find()->where(['survey_stat_survey_id'=> $id,'survey_stat_is_done'=>0])->count();
$notstart = $orgUserCount - ( $countComplete + $countUncomplete );

$js = <<<JS
$(document).ready(function (e) {
    $.fn.survey();

    var ctx = document.getElementById('surveyViewChart').getContext('2d');
    var chart = new Chart(ctx, {
    type: 'pie',
    data: {
        datasets: [{
            data: $countData,
            backgroundColor: [
                '#c0392b',
                '#e67e22',
                '#2980b9',
                '#16a085'
            ],
        }],
        labels: $labelsData
    },
    options: {
        responsive: true
    }
    });


    var ctx = document.getElementById('participantsStatusChart').getContext('2d');
    var chart = new Chart(ctx, {
    type: 'pie',
    data: {
        datasets: [{
            data: [$countComplete,$countUncomplete,$notstart],
            backgroundColor: [
                "#ecf0f1",
                "#f39c12",
                "#2ecc71"
            ],
        }],
        labels: ['اكتمل','قيد الاستكمال','لم يبدأ']
    },
    options: {
        responsive: true
    }
    });




});
JS;
$this->registerJs($js);

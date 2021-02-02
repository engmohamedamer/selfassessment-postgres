<?php

/* @var $this yii\web\View */

use cenotia\components\modal\RemoteModal;
use common\helpers\Filter;
use common\models\OrganizationStructure;
use common\models\base\Tag;
use kartik\select2\Select2;
use kartik\tree\TreeViewInput;
use yii\bootstrap\BootstrapPluginAsset;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $searchModel backend\modules\assessment\models\search\SurveySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Survey');

BootstrapPluginAsset::register($this);
?>
    <div id="survey-index">
        <div class="content-header">
            <div class="">
                <div class="">
                    <h1>
                <?= \Yii::t('survey', 'Assessments List') ?>
                    </h1>
                </div>
                <div class=" actionBtns">
                    <a href="assessment/default/create" class="btn btn btn-success"><i class="icofont-plus mr-2 ml-2"></i> <?= Yii::t('survey', 'Create new assessment') ?></a>
                    <a data-toggle="collapse" href="#filterCollapse" role="button" aria-expanded="false" aria-controls="filterCollapse" class="btn btn-info"><span><i class="fa fa-filter mr-2 ml-2"></i> <?= \Yii::t('common', 'Advanced Search')?> </span></a>

                
                </div>
            </div>
        </div>
        <div class="collapse <?php if(isset($_GET['date']) || isset($_GET['SurveySearch']['sector_id']) || isset($_GET['SurveySearch']['tags'])) echo 'in' ;?>" id="filterCollapse">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-filter fa-xs"></i> <?= \Yii::t('common', "Advanced Search")?></h3>
            </div>
            <div class="box-body">
                
                <form method="GET">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><?= \Yii::t('common', 'Filter by time')?></label>
                                <select class="form-control" name="date">
                                    <option value=""><?= Yii::t('backend','All');  ?></option>
                                    <option value="dateCurrentDay" <?php if($_GET['date'] == 'dateCurrentDay') echo "selected"; ;?> >اليوم</option>
                                    <option value="dateLastDay" <?php if($_GET['date'] == 'dateLastDay') echo "selected"; ;?>>اليوم السابق</option>
                                    <option value="dateCurrentWeek" <?php if($_GET['date'] == 'dateCurrentWeek') echo "selected"; ;?>>الاسبوع الحالي</option>
                                    <option value="dateLastWeek" <?php if($_GET['date'] == 'dateLastWeek') echo "selected"; ;?>>الاسبوع السابق</option>
                                    <option value="dateCurrentMonth" <?php if($_GET['date'] == 'dateCurrentMonth') echo "selected"; ;?>>الشهر الحالي</option>
                                    <option value="dateLastMonth" <?php if($_GET['date'] == 'dateLastMonth') echo "selected"; ;?>>الشهر السابق</option>
                                    <option value="dateCurrentYear" <?php if($_GET['date'] == 'dateCurrentYear') echo "selected"; ;?>>السنة الحالية</option>
                                    <option value="dateLastYear" <?php if($_GET['date'] == 'dateLastYear') echo "selected"; ;?>>السنة السابقة</option>
                                </select>
                                <small class="form-text text-muted">بحث الإستبيانات بالمدة الزمنية المحددة</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><?= \Yii::t('common', 'Search by section')?></label>
                                <?php 
                                    echo TreeViewInput::widget([
                                        // single query fetch to render the tree
                                        // use the Product model you have in the previous step
                                        'query' => Filter::organizationStructureQuery(), 
                                        'headingOptions'=>['label'=>\Yii::t('common', 'Search by section')],
                                        'value' => $_GET['SurveySearch']['sector_id'],     // values selected (comma separated for multiple select)
                                        'name' => 'SurveySearch[sector_id]', // input name
                                        'asDropdown' => true,   // will render the tree input widget as a dropdown.
                                        'multiple' => false,     // set to false if you do not need multiple selection
                                        'fontAwesome' => true,  // render font awesome icons
                                        'rootOptions' => [
                                            'label'=>'<i class="fa fa-tree"></i>',  // custom root label
                                            'class'=>'text-success'
                                        ],
                                    ]);
                                ?>
                                <small class="form-text text-muted">بحث الإستبيانات حسب قطاع العمل</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><?= \Yii::t('common', 'Search by Tags')?></label>
                                <?php
                                    $tags = \yii\helpers\ArrayHelper::map(Tag::find()->all(), 'id', 'name');
                                    echo Select2::widget([
                                        'name' => 'SurveySearch[tags]',
                                        'value' => $_GET['SurveySearch']['tags'], // initial value
                                        'data' => $tags,
                                        'options' => [
                                            'placeholder' => Yii::t('common', 'Search by Tags'),
                                            'multiple' => true
                                        ],
                                    ]);
                                ?>
                                <small class="form-text text-muted">بحث الإستبيانات حسب الوسوم</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                
                                <button class="btn btn-success" style="margin-top: 32px;"><?= \Yii::t('common', 'Search')?></button>
                            </div>
                        </div>
                    
                    </div>
                </form>
            </div>
            
        </div>
    </div>
        <div class="row">

        <div class="col-md-12">
           
        <?php


        Pjax::begin([
            'id' => 'survey-index-pjax',
            'enablePushState' => true,
            'timeout' => 0]);

        echo ListView::widget(['id' => 'survey-list',
            'layout' => "{summary}\n{items}\n<div class='clearfix'></div><div class='col-md-12'>{pager}</div>",
            'dataProvider' => $dataProvider,
            'itemOptions' => ['class' => 'item'],
            'emptyText' => '<p> '.Yii::t('survey','No Assessments at this point.').'</p><div class="emptyassessment"><div class="img"></div><div class="name"></div></div><div class="emptyassessment"><div class="img"></div><div class="name"></div></div>',

        'itemView' => function ($model, $key, $index, $widget) {
                /** @var $model \backend\modules\assessment\models\Survey */
                $survey = $model;
                $image = $survey->getImage();
                ob_start();
                ?>
                <div class="item-column">
                    <div class="survey-card">
                        <div class="status <?= $survey->getStatus() ?>"></div>
                        <div class="first-line">
                            <div class="image" <?php
                            if (!empty($image)) {
                                echo "style='background-image: url($image)'";
                            }else{
                                echo "style='background-image: url(/img/assessment.jpeg)'";
                            }
                            ?>></div>
                            <div class="description">
                                <div class="name-wrap">
                                    <a href="<?= Url::toRoute(['default/view/', 'id' => $survey->survey_id]) ?>"
                                       class="name" data-pjax="0"
                                       title="<?= Html::encode($survey->survey_name) ?>"><?= Html::encode($survey->survey_name) ?></a>
                                    <span class="date"><?= \Yii::t('survey', 'Created At') ?> : <?= \Yii::$app->formatter->asDate($survey->survey_created_at) ?></span>

                                </div>
                                <div>
                                    <div class="survey-labels">
                                        <!-- <span class="survey-label danger" data-toggle="tooltip"
                                              title="<?= \Yii::t('survey', 'Status') ?>">
                                            <?php 
                                                if ($survey->survey_is_visible) 
                                                echo Yii::t('survey','Visible');
                                                else echo Yii::t('common','Closed');
                                            ?>
                                            
                                        </span>       -->
                                        <span class="survey-label respondents" data-toggle="tooltip"title="<?= \Yii::t('survey', 'Respondents count') ?>"><?= $survey->getRespondentsCount() ?></span>
                                        <span class="survey-label completed-respondents" data-toggle="tooltip"
                                              title="<?= \Yii::t('survey', 'Were interviewed') ?>"><?= $survey->getCompletedRespondentsCount() ?></span>
                                        <span class="survey-label" data-toggle="tooltip"
                                              title="<?= \Yii::t('survey', 'Questions count') ?>"><?= $survey->getQuestions()->count() ?></span>
                                    </div>
                                    <div class="survey-actions">
                                        <?php
                                            if (count($survey->stats) > 0): ?>
                                                <a class="btn btn btn-success" href="/respondents?surveyId=<?=$survey->survey_id?>">
                                                    <?= \Yii::t('survey', 'Respondents') ?>
                                                </a>
                                        <?php 
                                            endif;
                                        ?>
                                        <a href="<?= Url::toRoute(['default/update/', 'id' => $survey->survey_id]) ?>"
                                           class="btn btn-info btn-xs" data-pjax="0"
                                           title="<?= \Yii::t('survey','Edit') ?>"><span class="glyphicon glyphicon-pencil mr-2 ml-2"></span><?= \Yii::t('survey','Edit') ?></a>
                                        <?php
                                            if (count($survey->questions) == 0 and count($survey->stats) == 0) {
                                                echo Html::a(\Yii::t('survey', '<span class="glyphicon glyphicon-trash"></span>'), Url::toRoute(['default/delete', 'id' => $survey->survey_id]), [
                                                    'class' => 'btn btn-danger btn-xs pull-right btn-delete',
                                                    'data-pjax' => 0,
                                                    'role' => 'remote-modal',
                                                    'data-confirm-message' => \Yii::t('survey','Are you sure?'),
                                                    'data-method' => false,// for overide yii data api
                                                    'data-request-method' => 'post',
                                                ]);
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="second-line">
                            <!-- <span><?= \Yii::t('survey', 'Author') ?> : <?= $survey->getAuthorName() ?> </span>  -->
                        </div>
                    </div>
                </div>
                <?php
                return ob_get_clean();
            },]);

        Pjax::end();

        ?>
 </div>
        </div>
    </div>

<?php RemoteModal::begin([
    "id" => "remote-modal",
    "options" => ["class" => "fade "],
    "footer" => "", // always need it for jquery plugin
]) ?>
<?php RemoteModal::end(); ?>

<?php
$this->registerJs(<<<JS
$(document).ready(function (e) {
    $.fn.survey();
});
JS
);

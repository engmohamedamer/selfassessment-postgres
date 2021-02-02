<?php
/**
 * Created by PhpStorm.
 * User: kozhevnikov
 * Date: 10/10/2017
 * Time: 09:51
 */


use backend\modules\assessment\models\SurveyType;
use kartik\editable\Editable;
use kartik\helpers\Html;
use kartik\select2\Select2;

use vova07\imperavi\Widget;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $question \backend\modules\assessment\models\SurveyQuestion */

Pjax::begin([
    'id' => 'survey-questions-pjax-' . $question->survey_question_id,
    'enablePushState' => false,
    'timeout' => 0,
    'scrollTo' => false,
    'options' => ['class' => 'survey-question-pjax-container'],
   // 'reloadCss' => false,
    'clientOptions' => [
        'type' => 'post',
        'skipOuterContainers' => true,
    ]
]);

$form = ActiveForm::begin([
    'id' => 'survey-questions-form-' . $question->survey_question_id,
    'action' => Url::toRoute(['question/update-and-close', 'id' => $question->survey_question_id]),
    'validationUrl' => Url::toRoute(['question/validate', 'id' => $question->survey_question_id]),
    'options' => ['class' => 'form-inline', 'data-pjax' => true],
    'enableClientValidation' => false,
    'enableAjaxValidation' => true,
    'fieldConfig' => [
        'template' => "<div class='survey-questions-form-field'>{label}{input}\n{error}</div>",
        'labelOptions' => ['class' => ''],
    ],
]);

echo Html::beginTag('div', ['class' => 'survey-block', 'id' => 'survey-question-' . $question->survey_question_id]);

echo Html::beginTag('div', ['class' => 'survey-question-name-wrap']);

echo $form->field($question, "[{$question->survey_question_id}]survey_question_name")->input('text', [])->label(\Yii::t('survey', 'Enter question name'));

echo Html::a(\Yii::t('survey', '<span class="glyphicon glyphicon-trash"></span>'), Url::toRoute(['question/delete', 'id' => $question->survey_question_id]), [
    'class' => 'btn btn-danger pull-right btn-delete',
]);
echo Html::submitButton('<span class="glyphicon glyphicon-ok"></span>', ['class' => 'btn btn-success pull-right btn-save-question']);
echo Html::submitButton('', ['class' => 'hidden update-question-btn survey-question-submit', 'data-action' => Url::toRoute(['question/update', 'id' => $question->survey_question_id])]);
echo Html::endTag('div');

$confirmMessage = \Yii::t('survey', 'Current types are not compatible, all entered data will be deleted. Are you sure?');
echo $form->field($question, "[{$question->survey_question_id}]survey_question_type")->widget(Select2::classname(), [
    'data' => \backend\modules\assessment\models\SurveyType::getDropdownList(),
    'pluginOptions' => [
        'allowClear' => false
    ],
    'pluginEvents' => [
        "change" => new \yii\web\JsExpression(<<<JS
                function _(e) {
                     let current = e.target.value;
                     let updateBtn = $(this).closest('[data-pjax-container]').find('.update-question-btn');
                     updateBtn.click();
                }
JS
    ),]
]);

if (in_array($question->survey_question_type, [
    SurveyType::TYPE_MULTIPLE,
    SurveyType::TYPE_ONE_OF_LIST,
    SurveyType::TYPE_DROPDOWN
]) and $question->survey->survey_point > 0) {
    echo $form->field($question, "[{$question->survey_question_id}]survey_question_point")->input('number');
}

echo Html::tag('br', '');
echo Html::tag('br', '');

echo $form->field($question, "[{$question->survey_question_id}]survey_question_show_descr")->checkbox(['class' => 'checkbox-updatable']);
echo Html::tag('br', '');

if ($question->survey_question_type == SurveyType::TYPE_SLIDER){
    echo $form->field($question, "[{$question->survey_question_id}]steps")->input('number');
}


echo Html::beginTag('div', ['class' => 'desc-100']);
if ($question->survey_question_show_descr) {
    echo $form->field($question, "[{$question->survey_question_id}]survey_question_descr")->textarea(['rows'=>'5','cols'=>'10'])->label(false);
}
echo Html::endTag('div');

echo Html::beginTag('div', ['class' => 'answers-container', 'id' => 'survey-answers-' . $question->survey_question_id]);
if (isset($question->survey_question_type)) {
    echo $this->render('/answers/_form', ['question' => $question, 'form' => $form]);
}

echo Html::endTag('div');

echo Html::tag('hr', '');
echo $form->field($question, "[{$question->survey_question_id}]survey_question_can_ignore")->checkbox([
        'onclick' =>'
        var id = "surveyquestion-'.$question->survey_question_id.'-survey_question_can_skip";
        var ignoreid = "surveyquestion-'.$question->survey_question_id.'-survey_question_can_ignore";
        if(document.getElementById(ignoreid).checked){
            document.getElementById(id).checked = false;
        }else{
            document.getElementById(id).checked = true;
        }
    ']);
echo $form->field($question, "[{$question->survey_question_id}]survey_question_can_skip")->checkbox();
if ($question->survey_question_type != SurveyType::TYPE_FILE){
    echo $form->field($question, "[{$question->survey_question_id}]survey_question_attachment_file")->checkbox(['class' => 'checkbox-updatable']);
    echo Html::tag('br', '');
}
if (in_array($question->survey_question_type, [
    SurveyType::TYPE_MULTIPLE,
    SurveyType::TYPE_ONE_OF_LIST,
    SurveyType::TYPE_DROPDOWN
]) and $question->survey->survey_point == 0) {
    echo Html::tag('br', '');
    // echo $form->field($question, "[{$question->survey_question_id}]survey_question_is_scorable")->checkbox(['class' => 'checkbox-updatable']);
}
?>
    <div class="preloader">
        <div class="cssload-spin-box"></div>
    </div>
<?php

echo Html::endTag('div');


ActiveForm::end();

Pjax::end();

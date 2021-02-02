<?php
/**
 * Created by PhpStorm.
 * User: kozhevnikov
 * Date: 10/10/2017
 * Time: 13:59
 */

use vova07\imperavi\Widget;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\date\DatePicker;

/** @var $question \backend\modules\assessment\models\SurveyQuestion */
/** @var $form \yii\widgets\ActiveForm */

foreach ($question->answers as $i => $answer) {
	if ($i == 0) {
		$lable =  \Yii::t('common','Date From');
	}else{
		$lable =  \Yii::t('common','Date To');
	}
    echo $form->field($answer, "[$question->survey_question_id][$i]survey_answer_name", [
    'template' => "<div class='survey-questions-form-field'><div class='inline-input'>{label}{input}</div>\n{error}</div>",
    ])->widget(DatePicker::classname(), [
    'options' => ['placeholder' => $lable],
    'pluginOptions' => [
        'autoclose'=>true,
	    'format' => 'yyyy-mm-dd',
    ]
	])->label(\Yii::t('survey', $lable));
    echo Html::tag('br', '');
}

echo Yii::t('survey','Will be presented one date/time field where respondent can enter the answer in free form');


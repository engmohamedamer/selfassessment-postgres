<?php
/**
 * Created by PhpStorm.
 * User: kozhevnikov
 * Date: 10/10/2017
 * Time: 13:59
 */

use yii\helpers\Html;
use yii\helpers\Url;

/** @var $question \backend\modules\assessment\models\SurveyQuestion */
/** @var $form \yii\widgets\ActiveForm */

foreach ($question->answers as $i => $answer) {
switch ($i){
    case 0:
        $label = Yii::t('survey','Min');
        break;
    case 1:
        $label = Yii::t('survey','Max');
        break;
    default:
        $label = false;
        break;
}
    echo $form->field($answer, "[$question->survey_question_id][$i]survey_answer_name", [
        'template' => "<div class='survey-questions-form-field-inline'>{label}{input}\n{error}</div>"
    ])->input('number',
        ['placeholder' => \Yii::t('survey', 'Enter an answer choice')])->label($label);

    echo $form->field($answer, "[{$question->survey_question_id}][$i]survey_answer_show_descr",
        ['options' => [
            'class' => 'form-group checkbox-inline'
        ]])->checkbox(['class' => 'checkbox-updatable']);
    echo Html::tag('br', '');

    if ($answer->survey_answer_show_descr) {
        echo Html::beginTag('div', ['class' => 'desc-100']);
        echo $form->field($answer, "[{$question->survey_question_id}][$i]survey_answer_descr")->textarea(['rows'=>'5','cols'=>'10'])->label(false);
        echo Html::endTag('div');
    }
    echo Html::tag('br', '');
}

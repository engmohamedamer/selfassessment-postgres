<?php
/**
 * Created by PhpStorm.
 * User: kozhevnikov
 * Date: 10/10/2017
 * Time: 13:59
 */

use backend\modules\assessment\models\SurveyUserAnswer;
use kartik\slider\Slider;
use vova07\imperavi\Widget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Progress;

/** @var $question \backend\modules\assessment\models\SurveyQuestion */
/** @var $form \yii\widgets\ActiveForm */
\backend\assets\AssessmentAsset::register($this);

$totalVotesCount = $question->getTotalUserAnswersCount();

echo Html::beginTag('div', ['class' => 'answers-stat']);
    $percent = 0;
 	$count = count($question->survey->stats);
    try {
        if ($count != 0 ) {
            $percent = round(( $totalVotesCount / $count ) * 100,2);
        }
    }catch (\Exception $e){
        $percent = 0;
    }
    echo "<div class='text-center'>
            <p class='text-center'>
                <strong>Answer Rate</strong>
                (<strong>$totalVotesCount</strong>/$count)
            </p>
            <div class='chart' data-percentage='$percent'>
              <div class='percentage'></div>
              <div class='completed active'></div>
            </div>
        </div>";
echo Html::endTag('div');
?>

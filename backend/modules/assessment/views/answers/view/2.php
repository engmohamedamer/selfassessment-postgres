<?php
/**
 * Created by PhpStorm.
 * User: kozhevnikov
 * Date: 10/10/2017
 * Time: 13:59
 */

use backend\modules\assessment\models\SurveyUserAnswer;
use yii\bootstrap\Progress;
use yii\helpers\Html;

/** @var $question \backend\modules\assessment\models\SurveyQuestion */
/** @var $form \yii\widgets\ActiveForm */

$totalVotesCount = $question->getTotalUserAnswersCount();

echo Html::beginTag('div', ['class' => 'answers-stat']);

echo '
    <p class="text-center">
        <strong>Answers</strong>
    </p>
';
?>
<?php
$class = ['red','aqua','green','yellow'];
foreach ($question->answers as $i => $answer) {
    $countUser = count($question->survey->stats);
    $count = $answer->getTotalUserAnswersCount();
    $percentage = 0;
    if ($countUser) {
        $percentage = ($count / $countUser) * 100 ;
    }
    echo '
        <div class="progress-group">
            <span class="progress-text">'.$answer->survey_answer_name.'</span>
            <span class="progress-number"><b>'.$count.'</b>/'.$countUser.'</span>
            <div class="progress sm">
                <div class="progress-bar progress-bar-'.$class[rand(0,3)].'" style="width: '. $percentage .'%"></div>
            </div>
        </div>
    ';
}

?>
</div>

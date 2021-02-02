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
$class = ['red','aqua','green','yellow','red','aqua','green','yellow'];
foreach ($question->answers as $i => $answer) {
    $countUser = count($question->survey->stats);
    $count = $answer->getTotalUserAnswersCount();
    $correct = '';
    $percentage = 0;
    if ($countUser) {
        $percentage = ( $countUser / $count ) * 100 ;
    }
    if ($answer->survey_answer_show_corrective_action) {
        $correct = ' <i class="fas fa-info-circle"  data-toggle="popover" title="'. Yii::t('survey','Corrective action') .'" data-content="'.$answer->survey_answer_corrective_action.'"></i></span>';
    }
    echo '
        <div class="progress-group">
            <span class="progress-text">'.$answer->survey_answer_name. $correct .'  
            <span class="progress-number"><b>'.$count.'</b>/'.$countUser.'</span>
            <div class="progress sm">
                <div class="progress-bar progress-bar-'.$class[$i].'" style="width: '. $percentage .'%"></div>
            </div>
        </div>
    ';
}

?>
</div>

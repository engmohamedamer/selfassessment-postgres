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
\backend\assets\AssessmentAsset::register($this);
$totalVotesCount = $question->getTotalUserAnswersCount();


// function random_color_part() {
//     return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
// }

// function random_color() {
//     return random_color_part() . random_color_part() . random_color_part();
// }

echo '
<div class="answers-stat" >
    <p class="text-center">
        <strong>'. Yii::t('common','Answers') .'</strong>
    </p>
';
?>
<?php
$colors = [];
$labels = [];
$answerCount = [];
$correct = [];
foreach ($question->answers as $i => $answer) {
    $labels[] = $answer->survey_answer_name;
    $answerCount [] = $answer->getTotalUserAnswersCount();
    $countUser = count($question->survey->stats);
    if ($answer->survey_answer_show_corrective_action) {
        $correct[] = ' <i class="fas fa-info-circle"  data-toggle="popover" title="'. Yii::t('survey','Corrective action') .'" data-content="'.$answer->survey_answer_corrective_action.'"></i></span>';
    }else{
      $correct[]= '';
    }
}

?>
<div class="row">
    <div class="col-md-8">

        <div class="chart-responsive">
            <canvas id="pieChart" height="150"></canvas>
        </div>

    </div>
    <div class="col-md-4">
        <ul class="chart-legend clearfix" style="margin-top:70px">
          <?php foreach($labels as  $i => $lable):
            $colors[] = '#fff';
          ?>
            <li><i class="far fa-circle" style="color:<?= $colors[$i]?>"></i> <?= $lable ?> <?=  $correct[$i]?> </li>
          <?php endforeach;?>
        </ul>
    </div>

</div>

</div>

<?php
$labelsData = json_encode($labels);
$answerCountData = json_encode($answerCount);
$colorsData = json_encode($colors);
$js = <<<JS
  // Get context with jQuery - using jQuery's .get() method.
  var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData        = {
      labels: $labelsData,
      datasets: [
        {
          data: $answerCountData,
          backgroundColor : $colorsData,
        }
      ]
    }
    var pieOptions     = {
      legend: {
        display: false
      }
    }
    var pieChart = new Chart(pieChartCanvas, {
      type: 'doughnut',
      data: pieData,
      options: pieOptions      
    })

JS;
$this->registerJs($js);
?>


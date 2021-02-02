<?php

namespace common\fixtures;

use backend\modules\assessment\models\SurveyAnswer;
use yii\test\ActiveFixture;
class AssessmentQuestionAnswersFixture extends ActiveFixture
{
    public $modelClass = SurveyAnswer::class;
    public $dataFile = '@tests/_data/asessment_questions_answers.php';
}

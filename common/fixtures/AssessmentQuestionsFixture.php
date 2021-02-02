<?php

namespace common\fixtures;

use backend\modules\assessment\models\SurveyQuestion;
use yii\test\ActiveFixture;
class AssessmentQuestionsFixture extends ActiveFixture
{
    public $modelClass = SurveyQuestion::class;
    public $dataFile = '@tests/_data/asessment_questions.php';
}

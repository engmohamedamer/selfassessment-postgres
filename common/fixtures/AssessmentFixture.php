<?php

namespace common\fixtures;

use yii\test\ActiveFixture;
use backend\modules\assessment\models\Survey;
class AssessmentFixture extends ActiveFixture
{
    public $modelClass = Survey::class;
    public $dataFile = '@tests/_data/assessment.php';
}

<?php

namespace common\fixtures;

use backend\modules\assessment\models\SurveyStat;
use yii\test\ActiveFixture;

class AssessmentsStatsFixture extends ActiveFixture
{
    public $modelClass = SurveyStat::class;
    public $dataFile = '@tests/_data/assessments_stats.php';
}

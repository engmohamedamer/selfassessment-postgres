<?php

namespace backend\models;

use Yii;
use \backend\models\base\CorrectiveActionReport as BaseCorrectiveActionReport;

/**
 * This is the model class for table "corrective_action_report".
 */
class CorrectiveActionReport extends BaseCorrectiveActionReport
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['org_id', 'user_id', 'survey_id', 'question_id', 'answer_id'], 'integer'],
            [['corrective_action_date'], 'safe'],
            [['comment'], 'string'],
            [['corrective_action'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 1]
        ]);
    }
	
}

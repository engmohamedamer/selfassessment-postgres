<?php

namespace common\models;

use Yii;
use \common\models\base\SurveySelectedUsers as BaseSurveySelectedUsers;

/**
 * This is the model class for table "survey_selected_users".
 */
class SurveySelectedUsers extends BaseSurveySelectedUsers
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['survey_id', 'user_id'], 'integer']
        ]);
    }
	
}

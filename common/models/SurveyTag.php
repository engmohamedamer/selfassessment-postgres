<?php

namespace common\models;

use Yii;
use \common\models\base\SurveyTag as BaseSurveyTag;

/**
 * This is the model class for table "survey_tag".
 */
class SurveyTag extends BaseSurveyTag
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['survey_id', 'tag_id', 'ord'], 'integer']
        ]);
    }
	
}

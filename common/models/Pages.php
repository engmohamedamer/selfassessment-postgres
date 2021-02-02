<?php

namespace common\models;

use Yii;
use \common\models\base\Pages as BasePages;

/**
 * This is the model class for table "pages".
 */
class Pages extends BasePages
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['organization_id', 'name', 'link'], 'required'],
            [['organization_id', 'created_at', 'updated_at'], 'integer'],
            [['name', 'link'], 'string', 'max' => 150]
        ]);
    }
	
}

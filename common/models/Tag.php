<?php

namespace common\models;

use Yii;
use \common\models\base\Tag as BaseTag;

/**
 * This is the model class for table "tag".
 */
class Tag extends BaseTag
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255]
        ]);
    }
	
}

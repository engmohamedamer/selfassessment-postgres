<?php

namespace common\models;

use Yii;
use \common\models\base\UserTag as BaseUserTag;

/**
 * This is the model class for table "user_tag".
 */
class UserTag extends BaseUserTag
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['user_id', 'tag_id', 'ord'], 'integer']
        ]);
    }
	
}

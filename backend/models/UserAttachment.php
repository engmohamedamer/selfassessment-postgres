<?php

namespace backend\models;

use Yii;
use \backend\models\base\UserAttachment as BaseUserAttachment;

/**
 * This is the model class for table "user_attachment".
 */
class UserAttachment extends BaseUserAttachment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['user_id', 'path'], 'required'],
            [['user_id', 'size', 'created_at', 'order'], 'integer'],
            [['path', 'base_url', 'type', 'name'], 'string', 'max' => 255]
        ]);
    }
	
}

<?php

namespace backend\models;

use Yii;
use \backend\models\base\Message as BaseMessage;

/**
 * This is the model class for table "message".
 */
class Message extends BaseMessage
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            ['description', 'required'],
            [['school_id', 'type', 'created_by'], 'integer'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'string', 'max' => 255]
        ]);
    }
	
}

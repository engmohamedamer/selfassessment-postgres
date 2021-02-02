<?php

namespace common\models;

use Yii;
use \common\models\base\Notification as BaseNotification;

/**
 * This is the model class for table "notification".
 */
class Notification extends BaseNotification
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['from', 'user_id', 'message'], 'required'],
            [['from', 'user_id', 'module_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['module', 'title'], 'string', 'max' => 255],
            [['message'], 'string', 'max' => 500],
            [['status'], 'string', 'max' => 4]
        ]);
    }
	
}

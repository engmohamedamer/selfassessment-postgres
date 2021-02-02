<?php

namespace common\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "notification".
 *
 * @property integer $id
 * @property integer $from
 * @property integer $user_id
 * @property string $module
 * @property integer $module_id
 * @property string $message
 * @property string $title
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class Notification extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            ''
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['from', 'user_id', 'message'], 'required'],
            [['from', 'user_id', 'module_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['module', 'title'], 'string', 'max' => 255],
            [['message'], 'string', 'max' => 500],
            [['status'], 'string', 'max' => 4]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notification';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'from' => Yii::t('common', 'From'),
            'user_id' => Yii::t('common', 'User ID'),
            'module' => Yii::t('common', 'Module'),
            'module_id' => Yii::t('common', 'Module ID'),
            'message' => Yii::t('common', 'Message'),
            'title' => Yii::t('common', 'Title'),
            'status' => Yii::t('common', 'Status'),
        ];
    }

    /**
     * @inheritdoc
     * @return array mixed
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new \yii\db\Expression('NOW()'),
            ],
        ];
    }


    /**
     * @inheritdoc
     * @return \common\models\query\NotificationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\NotificationQuery(get_called_class());
    }
}

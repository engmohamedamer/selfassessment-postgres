<?php

namespace common\models\base;

use Yii;

/**
 * This is the base model class for table "user_tag".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $tag_id
 * @property integer $ord
 *
 * @property \common\models\Tag $tag
 * @property \common\models\User $user
 */
class UserTag extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'tag',
            'user'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'tag_id', 'ord'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_tag';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'user_id' => Yii::t('common', 'User ID'),
            'tag_id' => Yii::t('common', 'Tag ID'),
            'ord' => Yii::t('common', 'Order'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(\common\models\Tag::className(), ['id' => 'tag_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\common\models\User::className(), ['id' => 'user_id']);
    }
    

    /**
     * @inheritdoc
     * @return \common\models\query\UserTagQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\UserTagQuery(get_called_class());
    }
}

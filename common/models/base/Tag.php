<?php

namespace common\models\base;

use Yii;
use backend\modules\assessment\models\Survey;
use common\models\User;
use sjaakp\taggable\TagBehavior;

/**
 * This is the base model class for table "tag".
 *
 * @property integer $id
 * @property string $name
 *
 * @property \common\models\UserTag[] $userTags
 */
class Tag extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    public function behaviors()
    {
        return [
            'tag' => [
                'class' => TagBehavior::class,
                'junctionTable' => 'user_tag',
                'modelClass' => User::class,
                'modelKeyColumn'=>'user_id',
            ],
            'survey_tag' => [
                'class' => TagBehavior::class,
                'junctionTable' => 'survey_tag',
                'modelClass' => Survey::class,
                'modelKeyColumn'=>'survey_id',
            ]
        ];
    }
    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'userTags',
            'surveyTags',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'name' => Yii::t('common', 'Name'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserTags()
    {
        return $this->hasMany(\common\models\UserTag::className(), ['tag_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyTags()
    {
        return $this->hasMany(\common\models\SurveyTag::className(), ['survey_id' => 'id']);
    }
    

    /**
     * @inheritdoc
     * @return \common\models\query\TagQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TagQuery(get_called_class());
    }
}

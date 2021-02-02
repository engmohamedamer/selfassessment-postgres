<?php

namespace common\models\base;

use Yii;

/**
 * This is the base model class for table "survey_tag".
 *
 * @property integer $id
 * @property integer $survey_id
 * @property integer $tag_id
 * @property integer $ord
 *
 * @property \common\models\Survey $survey
 * @property \common\models\Tag $tag
 */
class SurveyTag extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'survey',
            'tag'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['survey_id', 'tag_id', 'ord'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'survey_tag';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'survey_id' => Yii::t('common', 'Survey ID'),
            'tag_id' => Yii::t('common', 'Tag ID'),
            'ord' => Yii::t('common', 'Ord'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurvey()
    {
        return $this->hasOne(\common\models\Survey::className(), ['survey_id' => 'survey_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(\common\models\Tag::className(), ['id' => 'tag_id']);
    }
    

    /**
     * @inheritdoc
     * @return \common\models\query\SurveyTagQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\SurveyTagQuery(get_called_class());
    }
}

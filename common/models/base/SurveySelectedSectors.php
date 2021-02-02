<?php

namespace common\models\base;

use Yii;

/**
 * This is the base model class for table "survey_selected_sectors".
 *
 * @property integer $id
 * @property integer $survey_id
 * @property integer $sector_id
 *
 * @property \common\models\User $user
 * @property \common\models\Survey $survey
 */
class SurveySelectedSectors extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'user',
            'survey'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['survey_id', 'sector_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'survey_selected_sectors';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'survey_id' => Yii::t('common', 'Survey ID'),
            'sector_id' => Yii::t('common', 'Sectors'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\common\models\OrganizationStructure::className(), ['id' => 'sector_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurvey()
    {
        return $this->hasOne(\common\models\Survey::className(), ['survey_id' => 'survey_id']);
    }
    

    /**
     * @inheritdoc
     * @return \common\models\query\SurveySelectedSectorsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\SurveySelectedSectorsQuery(get_called_class());
    }
}

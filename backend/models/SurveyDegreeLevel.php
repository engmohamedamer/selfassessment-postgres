<?php

namespace backend\models;

use Yii;
use backend\modules\assessment\models\Survey;

/**
 * This is the model class for table "survey_degree_level".
 *
 * @property int $survey_degree_level_id
 * @property int $survey_degree_level_survey_id
 * @property string $title
 * @property int $from
 * @property int $to
 *
 * @property Survey $surveyDegreeLevelSurvey
 */
class SurveyDegreeLevel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'survey_degree_level';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['survey_degree_level_survey_id', 'from', 'to'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['survey_degree_level_survey_id'], 'exist', 'skipOnError' => true, 'targetClass' => Survey::className(), 'targetAttribute' => ['survey_degree_level_survey_id' => 'survey_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'survey_degree_level_id' => Yii::t('common', 'Survey Degree Level ID'),
            'survey_degree_level_survey_id' => Yii::t('common', 'Survey Degree Level Survey ID'),
            'title' => Yii::t('common', 'Title'),
            'from' => Yii::t('common', 'From'),
            'to' => Yii::t('common', 'To'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyDegreeLevelSurvey()
    {
        return $this->hasOne(Survey::className(), ['survey_id' => 'survey_degree_level_survey_id']);
    }
}

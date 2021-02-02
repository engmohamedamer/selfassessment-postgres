<?php

namespace common\models;

use Yii;
use backend\modules\assessment\models\Survey;
use backend\modules\assessment\models\SurveyQuestion;
use common\models\User;

/**
 * This is the model class for table "survey_user_answer_attachments".
 *
 * @property int $survey_user_answer_attachments_id
 * @property int $survey_user_answer_attachments_user_id
 * @property int $survey_user_answer_attachments_survey_id
 * @property int $survey_user_answer_attachments_question_id
 * @property string $name
 * @property string $path
 * @property string $base_url
 * @property string $type
 * @property int $size
 *
 * @property SurveyQuestion $surveyUserAnswerAttachmentsQuestion
 * @property Survey $surveyUserAnswerAttachmentsSurvey
 * @property User $surveyUserAnswerAttachmentsUser
 */
class SurveyUserAnswerAttachments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'survey_user_answer_attachments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['survey_user_answer_attachments_user_id', 'survey_user_answer_attachments_survey_id', 'survey_user_answer_attachments_question_id', 'size'], 'integer'],
            [['path'], 'required'],
            [['name', 'path', 'base_url', 'type'], 'string', 'max' => 255],
            [['survey_user_answer_attachments_question_id'], 'exist', 'skipOnError' => true, 'targetClass' => SurveyQuestion::className(), 'targetAttribute' => ['survey_user_answer_attachments_question_id' => 'survey_question_id']],
            [['survey_user_answer_attachments_survey_id'], 'exist', 'skipOnError' => true, 'targetClass' => Survey::className(), 'targetAttribute' => ['survey_user_answer_attachments_survey_id' => 'survey_id']],
            [['survey_user_answer_attachments_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['survey_user_answer_attachments_user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'survey_user_answer_attachments_id' => Yii::t('common', 'Survey User Answer Attachments ID'),
            'survey_user_answer_attachments_user_id' => Yii::t('common', 'Survey User Answer Attachments User ID'),
            'survey_user_answer_attachments_survey_id' => Yii::t('common', 'Survey User Answer Attachments Survey ID'),
            'survey_user_answer_attachments_question_id' => Yii::t('common', 'Survey User Answer Attachments Question ID'),
            'name' => Yii::t('common', 'Name'),
            'path' => Yii::t('common', 'Path'),
            'base_url' => Yii::t('common', 'Base Url'),
            'type' => Yii::t('common', 'Type'),
            'size' => Yii::t('common', 'Size'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyUserAnswerAttachmentsQuestion()
    {
        return $this->hasOne(SurveyQuestion::className(), ['survey_question_id' => 'survey_user_answer_attachments_question_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyUserAnswerAttachmentsSurvey()
    {
        return $this->hasOne(Survey::className(), ['survey_id' => 'survey_user_answer_attachments_survey_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyUserAnswerAttachmentsUser()
    {
        return $this->hasOne(User::className(), ['id' => 'survey_user_answer_attachments_user_id']);
    }
}

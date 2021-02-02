<?php

namespace backend\models\base;

use Yii;
use backend\modules\assessment\models\Survey;
use backend\modules\assessment\models\SurveyAnswer;
use backend\modules\assessment\models\SurveyQuestion;
use common\models\Organization;
use common\models\User;

/**
 * This is the base model class for table "corrective_action_report".
 *
 * @property integer $id
 * @property integer $org_id
 * @property integer $user_id
 * @property integer $survey_id
 * @property integer $question_id
 * @property string $answer_id
 * @property string $corrective_action
 * @property string $corrective_action_date
 * @property integer $status
 * @property string $comment
 *
 * @property \backend\models\SurveyAnswer $answer
 * @property \backend\models\Organization $org
 * @property \backend\models\SurveyQuestion $question
 * @property \backend\models\Survey $survey
 * @property \backend\models\User $user
 */
class CorrectiveActionReport extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    const STATUS_NOT_ACTIVE = 0;
    const STATUS_ACTIVE = 1;
    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'answer',
            'org',
            'question',
            'survey',
            'user'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['org_id', 'user_id', 'survey_id', 'question_id', 'answer_id'], 'integer'],
            [['corrective_action_date'], 'safe'],
            [['comment'], 'string'],
            [['corrective_action'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'corrective_action_report';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'org_id' => Yii::t('backend', 'Org ID'),
            'user_id' => Yii::t('backend', 'User ID'),
            'survey_id' => Yii::t('backend', 'Survey ID'),
            'question_id' => Yii::t('backend', 'Question ID'),
            'answer_id' => Yii::t('backend', 'Answer ID'),
            'corrective_action' => Yii::t('backend', 'Corrective Action'),
            'corrective_action_date' => Yii::t('backend', 'Corrective Action Date'),
            'status' => Yii::t('backend', 'Status'),
            'comment' => Yii::t('backend', 'Comment'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnswer()
    {
        return $this->hasOne(SurveyAnswer::className(), ['survey_answer_id' => 'answer_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrg()
    {
        return $this->hasOne(Organization::className(), ['id' => 'org_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestion()
    {
        return $this->hasOne(SurveyQuestion::className(), ['survey_question_id' => 'question_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurvey()
    {
        return $this->hasOne(Survey::className(), ['survey_id' => 'survey_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    

    /**
     * @inheritdoc
     * @return \backend\models\activequery\CorrectiveActionReportQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\models\activequery\CorrectiveActionReportQuery(get_called_class());
    }

    public static function status()
    {
        return [
            self::STATUS_ACTIVE => Yii::t('common', 'Active'),
            self::STATUS_NOT_ACTIVE => Yii::t('common', 'Not Active'),
        ];
    }
}

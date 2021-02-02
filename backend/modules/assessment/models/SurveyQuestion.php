<?php

namespace backend\modules\assessment\models;


use Yii;
use yii\base\Exception;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "survey_question".
 *
 * @property integer $survey_question_id
 * @property string $survey_question_name
 * @property string $survey_question_descr
 * @property integer $survey_question_type
 * @property integer $survey_question_survey_id
 * @property boolean $survey_question_can_skip
 * @property boolean $survey_question_show_descr
 * @property boolean $survey_question_is_scorable
 * @property integer $steps
 * @property boolean $survey_question_attachment_file
 * @property integer $survey_question_point
 * @property SurveyAnswer[] $answers
 * @property Survey $survey
 * @property SurveyType $questionType
 * @property SurveyUserAnswer[] $userAnswers
 */
class SurveyQuestion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'survey_question';
    }

    public function validateMultipleAnswer()
    {
        $question = $this;
        $userAnswers = $question->userAnswers;
        if (!$question->survey_question_can_skip){
            if ($question->survey_question_type === SurveyType::TYPE_MULTIPLE){
                $answerValues = ArrayHelper::getColumn($userAnswers, 'survey_user_answer_value');
                if (!in_array("1", $answerValues)){
                    $answer = (array)$question->userAnswers;
                    if(!empty($answer)) {
                        end($answer)->addError('survey_user_answer_value', \Yii::t('survey', 'You must enter an answer'));
                    }
                }
            }
        }
        return true;
    }

    public function changeDefaultValuesOnTypeChange(){
        /** @var SurveyQuestion $question */
        $question = $this;
        $oldType = $question->getOldAttribute('survey_question_type');
        $newType = $question->getAttribute('survey_question_type');
        if ($oldType === $newType){
            return true;
        }

        if ($newType === SurveyType::TYPE_SLIDER){
            $question->unlinkAll('answers', true);
            for ($i = 1; $i <= 2; ++$i) {
                $answer = new SurveyAnswer();
                $answer->survey_answer_sort = $i;
                $answer->survey_answer_name = ($i === 1) ? 0 : 100;
                $question->link('answers', $answer);
            }
        }else if($oldType === SurveyType::TYPE_SLIDER){
            $question->unlinkAll('answers', true);
            for ($i = 1; $i <= 2; ++$i) {
                $answer = new SurveyAnswer();
                $answer->survey_answer_sort = $i;
                $question->link('answers', $answer);
            }
        }

        return true;
    }
    
    public function maxPoint(){
        $survey_point = $this->survey->survey_point;
        $point = 0;
        if (count($this->survey->questions) > 1) {
            foreach ($this->survey->questions as $questions) {
                $point += $questions->survey_question_point;
            }
        }

        if (($survey_point - $point) == 0) {
            $point = 0;
            foreach ($this->survey->questions as $questions) {
                if ($questions->survey_question_id != $this->survey_question_id) {
                    $point += $questions->survey_question_point;
                }
            }
            return ($survey_point - $point);
        }else{
            return ($survey_point - $point);
        }
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['survey_question_descr'], 'string'],
            [['survey_question_type', 'survey_question_survey_id','steps','survey_question_point'], 'integer'],
            [['survey_question_point'], 'default', 'value'=> 0],
            [['survey_question_point'],'number','min'=>0],
            ['survey_question_point', 'compare', 'compareValue' => $this->maxPoint(), 'operator' => '<=', 'type' => 'number', 'when' => function($model){
                $point = 0;
                foreach ($model->survey->questions as $questions) {
                    if ($questions->survey_question_id != $model->survey_question_id) {
                        $point += $questions->survey_question_point;
                    }
                }
                if ($model->survey_question_point + $point <=  $model->survey->survey_point  ) {
                    return false;
                }
                return true;
            }],
            [['survey_question_point'], 'required', 'when' => function($model){
                return ($model->survey->survey_point > 0);
            }, 'message' => \Yii::t('survey', 'You must enter a question point')],
            [['survey_question_type'], 'filter', 'filter' => 'intval'],
            [['survey_question_can_skip', 'survey_question_show_descr', 'survey_question_is_scorable','survey_question_attachment_file','survey_question_can_ignore'], 'boolean'],
            [['survey_question_can_skip', 'survey_question_show_descr', 'survey_question_is_scorable'], 'filter', 'filter' => 'boolval'],
            [['survey_question_name'], 'string', 'max' => 130],
            [['survey_question_name'], 'required'],
            [['survey_question_survey_id'], 'exist', 'skipOnError' => true, 'targetClass' => Survey::class, 'targetAttribute' => ['survey_question_survey_id' => 'survey_id']],
            [['survey_question_type'], 'exist', 'skipOnError' => true, 'targetClass' => SurveyType::class, 'targetAttribute' => ['survey_question_type' => 'survey_type_id']],
        ];
    }

    public function beforeSave($insert)
    {
        //scorable questions
        if (!$insert && !in_array($this->survey_question_type, [
            SurveyType::TYPE_MULTIPLE,
            SurveyType::TYPE_ONE_OF_LIST,
            SurveyType::TYPE_DROPDOWN
        ])) {
            if ($this->survey_question_is_scorable){
                $this->survey_question_is_scorable = false;
            }
        }
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    public function loadDefaultValues($skipIfSet = true,$type = SurveyType::TYPE_SINGLE_TEXTBOX)
    {
        parent::loadDefaultValues($skipIfSet);
       // $this->survey_question_type = SurveyType::TYPE_MULTIPLE; //multiple choice
        if ($type == SurveyType::TYPE_MULTIPLE ) {
            $this->survey_question_type = SurveyType::TYPE_MULTIPLE; //multiple choice
        }elseif($type == SurveyType::TYPE_ONE_OF_LIST){
            $this->survey_question_type = SurveyType::TYPE_ONE_OF_LIST; //multiple choice
        }elseif($type == SurveyType::TYPE_DROPDOWN){
            $this->survey_question_type = SurveyType::TYPE_DROPDOWN; //multiple choice
        }elseif($type == SurveyType::TYPE_RANKING){
            $this->survey_question_type = SurveyType::TYPE_RANKING; //multiple choice
        }elseif($type == SurveyType::TYPE_SLIDER){
            $this->survey_question_type = SurveyType::TYPE_SLIDER; //multiple choice
        }elseif($type == SurveyType::TYPE_MULTIPLE_TEXTBOX){
            $this->survey_question_type = SurveyType::TYPE_MULTIPLE_TEXTBOX; //multiple choice
        }elseif($type == SurveyType::TYPE_COMMENT_BOX){
            $this->survey_question_type = SurveyType::TYPE_COMMENT_BOX; //multiple choice
        }elseif($type == SurveyType::TYPE_DATE_TIME){
            $this->survey_question_type = SurveyType::TYPE_DATE_TIME; //multiple choice
        }elseif($type == SurveyType::TYPE_CALENDAR){
            $this->survey_question_type = SurveyType::TYPE_CALENDAR; //multiple choice
        }elseif($type == SurveyType::TYPE_FILE){
            $this->survey_question_type = SurveyType::TYPE_FILE; //multiple choice
        }else{
            $this->survey_question_type = SurveyType::TYPE_SINGLE_TEXTBOX; //multiple choice
        }
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'survey_question_id' => Yii::t('survey', 'Question ID'),
            'survey_question_name' => Yii::t('survey', 'Assessment Question Name'),
            'survey_question_descr' => Yii::t('survey', 'Detailed description'),
            'survey_question_type' => Yii::t('survey', 'Question Type'),
            'survey_question_survey_id' => Yii::t('survey', 'Survey ID'),
            'survey_question_can_skip' => Yii::t('survey', 'Required'),
            'survey_question_show_descr' => Yii::t('survey', 'Show detailed description'),
            'survey_question_is_scorable' => Yii::t('survey', 'Score this question'),
            'steps'=> Yii::t('survey', 'Steps Number'),
            'survey_question_attachment_file'=> Yii::t('survey', 'Can Attach File'),
            'survey_question_point'=> Yii::t('survey', 'Assessment Question Point'),
            'survey_question_can_ignore'=>Yii::t('survey', 'Can Ignore'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnswers()
    {
        return $this->hasMany(SurveyAnswer::class, ['survey_answer_question_id' => 'survey_question_id'])
            ->orderBy(['survey_answer_sort' => SORT_ASC, 'survey_answer_id' => SORT_ASC]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurvey()
    {
        return $this->hasOne(Survey::class, ['survey_id' => 'survey_question_survey_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestionType()
    {
        return $this->hasOne(SurveyType::class, ['survey_type_id' => 'survey_question_type']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserAnswers()
    {
        return $this->hasMany(SurveyUserAnswer::class, ['survey_user_answer_question_id' => 'survey_question_id'])
            ->andOnCondition(['survey_user_answer_user_id' => \Yii::$app->user->getId()])
            ->indexBy('survey_user_answer_answer_id');
    }

    /**
     * Returns the total number of users voted for this answer
     *
     * @return int
     */
    public function getTotalUserAnswersCount()
    {
        switch ($this->survey_question_type){
            case SurveyType::TYPE_MULTIPLE:
                $result = SurveyUserAnswer::find()->where(['survey_user_answer_question_id' => $this->survey_question_id])
                    ->andWhere("survey_user_answer_value::integer = 1")
                    ->count();
                break;
            case SurveyType::TYPE_SINGLE_TEXTBOX:
                $result = SurveyUserAnswer::find()->where(['survey_user_answer_question_id' => $this->survey_question_id])
                    ->count();
                break;    
            case SurveyType::TYPE_ONE_OF_LIST:
            case SurveyType::TYPE_DROPDOWN:
                $result = SurveyUserAnswer::find()->where(['survey_user_answer_question_id' => $this->survey_question_id])
                    ->andWhere("survey_user_answer_value::integer > 0 ")
                    ->count();
                break;
            default:
                $result = 0;
                break;
        }

        return $result;
    }
}

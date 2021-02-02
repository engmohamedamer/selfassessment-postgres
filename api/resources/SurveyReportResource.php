<?php

namespace api\resources;

use backend\models\CorrectiveActionReport;
use backend\modules\assessment\models\Survey;
use backend\modules\assessment\models\SurveyAnswer;
use backend\modules\assessment\models\SurveyStat;
use backend\modules\assessment\models\SurveyType;
use backend\modules\assessment\models\SurveyUserAnswer;
use common\models\SurveyUserAnswerAttachments;
use common\models\UserProfile;

class SurveyReportResource extends Survey
{

   public  function getUserId(){
     if(isset($_SESSION['userID'])){
           return $_SESSION['userID'];

       }
       return \Yii::$app->user->identity->id;
   }

    public function fields()
    {
        return [
            'id'=>function($model){
                return $model->survey_id;
            },
            'locale'=>function($model){
                return 'ar';
            },
            'title'=>function($model){
                return $model->survey_name;
            },
            'description'=>function($model){
                return $model->survey_descr;
            },


            'status'=>function($model){
                $userId = $this->userId;
                $userSurveyStat =  SurveyStat::find()->where(['survey_stat_user_id'=>$userId,'survey_stat_survey_id'=>$model->survey_id])->one();
                if (!$userSurveyStat) {
                    return 0;
                }
                return $userSurveyStat->survey_stat_is_done;
            },

            'generalInfo'=>function($model){
                $userId= $this->userId;
                $time = SurveyStat::actualTime($model->survey_id,$userId);
                $survey_end_at = date("Y-m-d",strtotime((SurveyStat::find(['survey_stat_user_id'=>$userId,'survey_stat_user_id'=>$model->survey_id])->one())->survey_stat_updated_at));

                $gained_points =  \Yii::$app->db->createCommand('SELECT sum(survey_user_answer_point::integer) as gained_points from survey_user_answer where survey_user_answer_user_id = '. $this->userId .' and survey_user_answer_survey_id ='.$model->survey_id )->queryScalar();

                if ($model->survey_point) {
                    $gained_score =  (round($gained_points,0) / $model->survey_point) * 100;
                    foreach ($model->levels as $key => $value) {
                        if ($value->from <= $gained_score and $gained_score <= $value->to) {
                            $gained_score = $value->title;
                            break;
                        }
                    }

                }

                $correctiveActions= [];

                $reportCorrective = CorrectiveActionReport::find()->where(['user_id'=>$userId,'survey_id'=> $model->survey_id])->all();

                foreach ($reportCorrective as $key => $corrective) {
                    $correctiveActions[] = [
                        'question'=>$corrective->question->survey_question_name,
                        'answer'=>$corrective->answer->survey_answer_name,
                        'corrective_action'=>$corrective->corrective_action,
                        'corrective_action_date'=>$corrective->corrective_action_date,
                    ];
                }


                return [
                    'survey_created_at'=>date("Y-m-d",strtotime($model->survey_created_at)),
                    'survey_expired_at'=> $model->survey_expired_at ? date("Y-m-d",strtotime($model->survey_expired_at)) : null,
                    'survey_end_at'=>$survey_end_at,
                    'survey_number'=>$model->survey_id .'/'. date("Y",strtotime($model->survey_created_at)) ,
                    'survey_time_to_pass'=> $model->survey_time_to_pass,
                    'survey_question_number'=> count($model->questions),
                    'survey_corrective_number'=> $correctiveActions ? count($correctiveActions) : 0,
                    'survey_corrective_actions'=>$correctiveActions,
                    'total_points'=> $model->survey_point ?: null,
                    'gained_points'=>$gained_points ? round($gained_points,2): null,
                    'gained_score'=>$gained_score ?: null,
                    'progress'=>$this->surveyProgress($model,$userId),
                    'actual_time'=> $time,
                ];

            },
            'answers'=>function($model){
                $userId =$this->userId;
                $data =$result= [];
                $userProfile = UserProfile::find()->where(['user_id'=>$userId])->one();
                if ($userProfile->locale == 'en-US') {
                    $ShouldChoose = 'Should Choose ';
                }else{
                    $ShouldChoose = 'يجب اختيار ';
                }
                //get survey questions then check user answers
                $i=1;
                foreach ($model->questions as  $question) {
                    //echo $question->survey_question_id.'<br>';
                    // has one value
                    $type = null;

                    if ( $question->survey_question_type === SurveyType::TYPE_SLIDER
                        || $question->survey_question_type === SurveyType::TYPE_SINGLE_TEXTBOX
                        || $question->survey_question_type === SurveyType::TYPE_COMMENT_BOX
                    ){
                        $temp=[];
                        $correctiveActions= [];
                        //fetch user answers
                        $userAnswerObj = SurveyUserAnswer::findOne([
                            'survey_user_answer_user_id'=>$userId,
                            'survey_user_answer_survey_id'=>$model->survey_id,
                            'survey_user_answer_question_id'=>$question->survey_question_id

                        ]);
                        if($userAnswerObj){
                            $answer = $userAnswerObj->survey_user_answer_value;

                        }

                    }elseif ( $question->survey_question_type === SurveyType::TYPE_DATE_TIME
                    ){
                        $temp=[];
                        $correctiveActions= [];
                        //fetch user answers
                        $userAnswerObj = SurveyUserAnswer::findOne([
                            'survey_user_answer_user_id'=>$userId,
                            'survey_user_answer_survey_id'=>$model->survey_id,
                            'survey_user_answer_question_id'=>$question->survey_question_id

                        ]);
                        if($userAnswerObj){
                            $answer = $userAnswerObj->survey_user_answer_value;
                            $answerValue = strtotime($answer);
                            $from = strtotime($question->answers[0]->survey_answer_name);
                            $to = strtotime($question->answers[1]->survey_answer_name);
                            if ($answerValue < $from || $answerValue > $to) {
                                $correctiveActions[]= $ShouldChoose.'( '. $question->answers[0]->survey_answer_name .' : ' . $question->answers[1]->survey_answer_name .' )';;
                            }
                        }

                    }else if($question->survey_question_type === SurveyType::TYPE_ONE_OF_LIST
                        || $question->survey_question_type === SurveyType::TYPE_DROPDOWN
                    ){
                        $temp=[];
                        $correctiveActions= [];
                        //fetch user answers
                        $userAnswerObj = SurveyUserAnswer::findOne([
                            'survey_user_answer_user_id'=>$userId,
                            'survey_user_answer_survey_id'=>$model->survey_id,
                            'survey_user_answer_question_id'=>$question->survey_question_id

                        ]);
                        if($userAnswerObj){

                            $answer = ['value'=>$userAnswerObj->surveyUserAnswerValueAnswer->survey_answer_name,'correct'=> $userAnswerObj->surveyUserAnswerValueAnswer->correct ? true : false];
                            if ($userAnswerObj->surveyUserAnswerValueAnswer->survey_answer_show_corrective_action) {
                                $correctiveActions[] = $userAnswerObj->surveyUserAnswerValueAnswer->survey_answer_corrective_action;
                            }

                            if (!$userAnswerObj->surveyUserAnswerValueAnswer->correct) {
                                $correct = SurveyAnswer::find()->where([
                                    'survey_answer_question_id'=>$question->survey_question_id,
                                    'correct'=> 1
                                ])->one();
                                $correctiveActions[] = $ShouldChoose.'( '.$correct->survey_answer_name .' )';

                            }
                        }

                    }else if(
                        $question->survey_question_type === SurveyType::TYPE_MULTIPLE
                        || $question->survey_question_type === SurveyType::TYPE_MULTIPLE_TEXTBOX
                        || $question->survey_question_type === SurveyType::TYPE_CALENDAR
                    ){
                        $temp=[];
                        $correctiveActions= [];

                        //fetch user answers
                        $userAnswersObj = SurveyUserAnswer::find()->where([
                            'survey_user_answer_user_id'=>$userId,
                            'survey_user_answer_survey_id'=>$model->survey_id,
                            'survey_user_answer_question_id'=>$question->survey_question_id

                        ])->all();

                        $answersIdsCorrect = array_column(SurveyAnswer::find()->select('survey_answer_id')->where([
                            'survey_answer_question_id'=>$question->survey_question_id,
                            'correct'=> 1
                        ])->asArray()->all(),'survey_answer_id');
                        // return $answersIdsCorrect;
                        if($userAnswersObj){
                            $temp=[];
                            $correctiveAction= [];
                            foreach ($userAnswersObj as $item) {
                                $ids[] =  $item->survey_user_answer_answer_id;
                                if($item->survey_user_answer_answer_id && $item->survey_user_answer_value==1) {
                                    if ($question->survey->survey_point) {
                                        $correct = (bool)$item->surveyUserAnswerAnswer->correct;
                                    }else{
                                        $correct = true;
                                    }
                                    $temp[] = ['value'=>$item->surveyUserAnswerAnswer->survey_answer_name,'correct'=> $correct];
                                    if ($item->surveyUserAnswerAnswer->survey_answer_show_corrective_action) {
                                        $correctiveAction[] = $item->surveyUserAnswerAnswer->survey_answer_corrective_action;
                                    }
                                }

                            }

                            foreach ($answersIdsCorrect as $value) {
                                if (!in_array($value, $ids)) {
                                    $correctiveAction[] = $ShouldChoose.'( '.(SurveyAnswer::findOne(['survey_answer_id'=>$value]))->survey_answer_name .' )';
                                }
                            }

                            $answer = $temp;
                            $correctiveActions = $correctiveAction;

                        }


                    }else if(
                        $question->survey_question_type === SurveyType::TYPE_RANKING
                    ){
                        $temp=[];
                        $correctiveActions= [];

                        //fetch user answers
                        $userAnswersObj = SurveyUserAnswer::find()->where([
                            'survey_user_answer_user_id'=>$userId,
                            'survey_user_answer_survey_id'=>$model->survey_id,
                            'survey_user_answer_question_id'=>$question->survey_question_id

                        ])->all();
                        if($userAnswersObj){
                            $temp=[];
                            $correctiveAction= [];
                            foreach ($userAnswersObj as $item) {
                                if($item->survey_user_answer_answer_id) {
                                    $temp[] = $item->surveyUserAnswerAnswer->survey_answer_name
                                    . ": " . $item->survey_user_answer_value;
                                }

                            }

                            $answer = $temp;
                        }


                    }else if(
                        $question->survey_question_type === SurveyType::TYPE_FILE
                    ){
                        $temp=[];
                        $correctiveActions= [];
                        //fetch user answers
                        $userAnswersObj = SurveyUserAnswer::find()->where([
                            'survey_user_answer_user_id'=>$userId,
                            'survey_user_answer_survey_id'=>$model->survey_id,
                            'survey_user_answer_question_id'=>$question->survey_question_id

                        ])->all();
                        // return var_dump($userAnswersObj);
                        if($userAnswersObj){
                            foreach ($userAnswersObj as $item) {
                                $temp[] = [
                                    'id'=>$item->survey_user_answer_id,
                                    'name'=>$item->survey_user_answer_text,
                                    'content'=>$item->survey_user_answer_value
                                ];
                            }
                            $answer = $temp;
                        }
                    }

                    $type  = $question->questionType->survey_type_name;
                    $qAttatchments = [];
                    $files = SurveyUserAnswerAttachments::findAll(['survey_user_answer_attachments_survey_id'=>$question->survey_question_survey_id ,
                       'survey_user_answer_attachments_question_id'=>$question->survey_question_id,
                       'survey_user_answer_attachments_user_id' => $this->userId
                       ]);
                    foreach ($files as $key => $file) {
                        $qAttatchments[] = [
                            'type'=>$file->type,
                            'content'=>$file->path,
                            'name'=>$file->name
                        ];
                    }

                    $userAnswersObjCheckNotApplicable = SurveyUserAnswer::find()->where([
                            'survey_user_answer_user_id'=>$userId,
                            'survey_user_answer_survey_id'=>$model->survey_id,
                            'survey_user_answer_question_id'=>$question->survey_question_id

                        ])->one();
                    $notApplicable = '';
                    if ($userAnswersObjCheckNotApplicable->not_applicable) {
                        $notApplicable = $userAnswersObjCheckNotApplicable->survey_user_answer_text;
                        $correctiveActions = [];
                    }

                    $qGainedPoints =  \Yii::$app->db->createCommand('SELECT sum(survey_user_answer_point::integer) as gained_points from survey_user_answer where survey_user_answer_user_id = '. $this->userId .' and survey_user_answer_question_id ='.$question->survey_question_id )->queryScalar();
                    $data = [
                        'qNum'=>$i++,
                        'qText'=>$question->survey_question_name,
                        'qAnswer'=>$answer ?: ' ',
                        'qNotApplicable'=>$notApplicable ?: '',
                        'qGainedPoints'=> round($qGainedPoints,2),
                        'qTotalPoints'=>$question->survey_question_point,
                        'qCorrectiveActions'=> $correctiveActions,
                        'qType'=>$type,
                        'qAttatchments'=> $qAttatchments
                    ];
                    $correctiveActions = [];
                    $qAttatchments = [];
                    $answer = null;
                    $result [] = $data;
                }


                return $result;
            }
        ];
    }

    public function correctiveNumber($model)
    {
        $userId =$this->userId;
        $data =$result= [];
        //get survey questions then check user answers
        $i=1;
        $correctiveActions = 0;
        foreach ($model->questions as  $question) {
            $type = null;
            if($question->survey_question_type === SurveyType::TYPE_ONE_OF_LIST
                || $question->survey_question_type === SurveyType::TYPE_DROPDOWN
            ){
                $userAnswerObj = SurveyUserAnswer::findOne([
                    'survey_user_answer_user_id'=>$userId,
                    'survey_user_answer_survey_id'=>$model->survey_id,
                    'survey_user_answer_question_id'=>$question->survey_question_id
                ]);
                if ($userAnswerObj->surveyUserAnswerAnswer->survey_answer_show_corrective_action) {
                    $correctiveActions++;
                }

            }else if(
                $question->survey_question_type === SurveyType::TYPE_MULTIPLE
                || $question->survey_question_type === SurveyType::TYPE_MULTIPLE_TEXTBOX
                || $question->survey_question_type === SurveyType::TYPE_CALENDAR
            ){
                $userAnswersObj = SurveyUserAnswer::find()->where([
                    'survey_user_answer_user_id'=>$userId,
                    'survey_user_answer_survey_id'=>$model->survey_id,
                    'survey_user_answer_question_id'=>$question->survey_question_id
                ])->all();
                if($userAnswersObj){
                     foreach ($userAnswersObj as $item) {
                        if($item->survey_user_answer_answer_id && $item->survey_user_answer_value==1) {
                            if ($item->surveyUserAnswerAnswer->survey_answer_show_corrective_action) {
                                $correctiveActions++;
                            }
                        }
                    }
                }
            }
        }


        return $correctiveActions;
    }



}

<?php

namespace api\controllers;


use api\helpers\ImageHelper;
use api\helpers\ResponseHelper;
use api\resources\SurveyMiniResource;
use api\resources\SurveyReportResource;
use api\resources\SurveyResource;
use api\resources\User;
use backend\models\CorrectiveActionReport;
use backend\modules\assessment\models\SurveyAnswer;
use backend\modules\assessment\models\SurveyQuestion;
use backend\modules\assessment\models\SurveyStat;
use backend\modules\assessment\models\SurveyType;
use backend\modules\assessment\models\SurveyUserAnswer;
use common\models\OrganizationStructure;
use common\models\SurveyUserAnswerAttachments;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\web\Response;


class AssessmentsController extends  MyActiveController
{
    public $modelClass = SurveyResource::class;

    public function actions(){
        $actions = parent::actions();
        unset($actions['index']);
        unset($actions['view']);
        unset($actions['update']);
        unset($actions['delete']);
        return $actions;
    }



    private function allowedSurvey()
    {
      
      $orgId = \Yii::$app->user->identity->userProfile->organization_id;
      $user_id = \Yii::$app->user->identity->userProfile->user_id;
      $connection = \Yii::$app->getDb();
      $commandTags = $connection->createCommand("
          SELECT survey.survey_id from user_profile
          join survey on org_id = organization_id 
          join survey_tag on survey_tag.survey_id = survey.survey_id
          join user_tag on user_tag.user_id = user_profile.user_id
          where user_tag.tag_id = survey_tag.tag_id and  org_id = :org_id and survey_is_visible = 1 and user_profile.user_id = :user_id group by survey.survey_id;
      ", [':org_id' => $orgId,':user_id'=> $user_id]);
      $resultTags = $commandTags->queryAll();

      $commandSelectedUsers = $connection->createCommand("
          SELECT survey.survey_id from user_profile
          join survey on org_id = organization_id 
          join survey_selected_users on survey_selected_users.user_id = user_profile.user_id
          where survey_selected_users.survey_id = survey.survey_id and  org_id = $orgId   and survey_is_visible = 1 and user_profile.user_id =  $user_id group by survey.survey_id;
      ", [':org_id' => $orgId,':user_id'=> $user_id]);
      $resultSelectedUsers = $commandSelectedUsers->queryAll();

      $commandSector = $connection->createCommand("
          SELECT survey.survey_id from user_profile
          join survey on org_id = organization_id 
          join survey_selected_sectors on survey_selected_sectors.survey_id = survey.survey_id
          where user_profile.sector_id = survey_selected_sectors.sector_id
          and org_id = :org_id and survey_is_visible = 1 and user_profile.user_id = :user_id group by survey.survey_id;
      ", [':org_id' => $orgId,':user_id'=> $user_id]);
      $resultSector = $commandSector->queryAll();

      $commandOpenForAll = $connection->createCommand("
          SELECT survey.survey_id from survey 
          where org_id = :org_id and survey_is_visible = 1
          and survey_id 
            not in ( select survey_id from survey_selected_sectors where survey_selected_sectors.survey_id = survey.survey_id)
          and survey_id 
            not in ( select survey_id from survey_tag where survey_tag.survey_id = survey.survey_id) 
          and survey_id 
            not in ( select survey_id from survey_selected_users where survey_selected_users.survey_id = survey.survey_id);
      ", [':org_id' => $orgId]);
      $resultOpenForAll = $commandOpenForAll->queryAll();

        $ids = ArrayHelper::getColumn(array_merge_recursive($resultTags,$resultSelectedUsers,$resultSector,$resultOpenForAll), 'survey_id');

      return array_values(array_unique($ids));

    }

    public function actionIndex(){

        $params= \Yii::$app->request->get();
        $orgId = \Yii::$app->user->identity->userProfile->organization_id;
        if(! $orgId) return ResponseHelper::sendFailedResponse(['message'=>"Missing Data"],'404');

        $userId = \Yii::$app->user->identity->id;
        $userSurveyStat =  SurveyStat::find()->select('survey_stat_survey_id')->where(['survey_stat_user_id'=>$userId])->asArray()->all();
        $ids = ArrayHelper::getColumn($userSurveyStat, 'survey_stat_survey_id');
        $queryNoStart = SurveyMiniResource::find()
          ->groupBy('survey_id')
          ->orderBy('survey_id DESC');
        $queryNoStart->andWhere(['NOT IN','survey_id',$ids])
          ->andWhere(['admin_enabled'=> 1])
          ->andWhere(['IN','survey_id',$this->allowedSurvey()])
          ->andwhere(['org_id'=>$orgId,'survey_is_visible' => 1]);

        $activeData = new ActiveDataProvider([
            'query' => $queryNoStart,
            'pagination' => [
                'defaultPageSize' => $this->defaultPageSize , // to set default count items on one page
                'pageSize' => $this->pageSize, //to set count items on one page, if not set will be set from defaultPageSize
                'pageSizeLimit' => $this->pageSizeLimit, //to set range for pageSize

            ],
        ]);
        return $activeData;
    }

    public function actionCompleted(){
        $params= \Yii::$app->request->get();

        $orgId = \Yii::$app->user->identity->userProfile->organization_id;
        if(! $orgId) return ResponseHelper::sendFailedResponse(['message'=>"Missing Data"],'404');
        $queryCompleted = SurveyMiniResource::find()->orderBy('survey_id DESC');
        $queryCompleted->joinWith(['stats'])->where(['survey_stat_is_done'=>1]);
        $queryCompleted->andwhere(['org_id'=>$orgId,'survey_is_visible' => 1])
            ->andwhere(['survey_stat_user_id'=>\Yii::$app->user->identity->id])
            ->andWhere(['IN','survey_id',$this->allowedSurvey()]);


        $activeData = new ActiveDataProvider([
            'query' => $queryCompleted,
            'pagination' => [
                'defaultPageSize' => $this->defaultPageSize , // to set default count items on one page
                'pageSize' => $this->pageSize, //to set count items on one page, if not set will be set from defaultPageSize
                'pageSizeLimit' => $this->pageSizeLimit, //to set range for pageSize

            ],
        ]);
        return $activeData;
    }

    public function actionNotComplete(){
        $params= \Yii::$app->request->get();

        $orgId = \Yii::$app->user->identity->userProfile->organization_id;
        if(! $orgId) return ResponseHelper::sendFailedResponse(['message'=>"Missing Data"],'404');
        $queryNotComplete = SurveyMiniResource::find()->orderBy('survey_id DESC');
        $queryNotComplete->joinWith(['stats'])->where(['survey_stat_is_done'=>0]);
        $queryNotComplete->andwhere(['org_id'=>$orgId,'survey_is_visible' => 1])
            ->andwhere(['survey_stat_user_id'=>\Yii::$app->user->identity->id])
            ->andWhere(['IN','survey_id',$this->allowedSurvey()]);

        $activeData = new ActiveDataProvider([
            'query' => $queryNotComplete,
            'pagination' => [
                'defaultPageSize' => $this->defaultPageSize , // to set default count items on one page
                'pageSize' => $this->pageSize, //to set count items on one page, if not set will be set from defaultPageSize
                'pageSizeLimit' => $this->pageSizeLimit, //to set range for pageSize

            ],
        ]);
        return $activeData;
    }


    public function actionView($id)
    {
        $user_id = \Yii::$app->user->identity->getId();
        $user= User::findOne(['id'=> $user_id]) ;
        if(! $id) return ResponseHelper::sendFailedResponse(['message'=>"Missing Data"],404);
        $profile=$user->userProfile;

        $surveyObj = SurveyResource::find()->where(['survey_id'=>$id,'survey_is_visible' => 1])->one();
        if(!$surveyObj)  return ResponseHelper::sendFailedResponse(['message'=>'Survey not found'],404);

        $expired_at = false;
        if (!empty($surveyObj->survey_expired_at)) {
          $expired_at = time() >= strtotime($surveyObj->survey_expired_at);
        }
        $stats = SurveyStat::findOne(['survey_stat_survey_id'=>$id,'survey_stat_user_id'=> $user_id]);
        
        if($surveyObj->survey_is_closed || $expired_at || (isset($stats) and $stats->survey_stat_is_done))  return ResponseHelper::sendFailedResponse(['message'=>'Forbidden'],403);
        
        return ResponseHelper::sendSuccessResponse($surveyObj);

    }

    public function actionReportQuestions($id)
    {
        $user_id = \Yii::$app->user->identity->getId();
        $user= User::findOne(['id'=> $user_id]) ;
        if(! $id) return ResponseHelper::sendFailedResponse(['message'=>"Missing Data"],404);
        $profile=$user->userProfile;

        $surveyObj = SurveyResource::find()->where(['survey_id'=>$id,'survey_is_visible' => 1])->one();
        if(!$surveyObj)  return ResponseHelper::sendFailedResponse(['message'=>'Survey not found'],404);
        return ResponseHelper::sendSuccessResponse($surveyObj);
    }

    public function actionReport($id)
    {
        $user= User::findOne(['id'=> \Yii::$app->user->identity->getId()]) ;
        if(! $id) return ResponseHelper::sendFailedResponse(['message'=>"Missing Data"],'404');
        $profile=$user->userProfile;

        $surveyObj = SurveyReportResource::find()->where(['survey_id'=>$id])->andWhere('survey_is_visible::integer = 1')->one();
        if(!$surveyObj)  return ResponseHelper::sendFailedResponse(['message'=>'Survey not found'],404);
        $stat = SurveyStat::findOne(['survey_stat_survey_id'=>$id,'survey_stat_user_id'=>$user->id]);
        if (!$stat) return ResponseHelper::sendFailedResponse(['message'=>'Forbidden'],403);
        return ResponseHelper::sendSuccessResponse($surveyObj);

    }

    public function actionReportToken($id)
    {
        $user= User::findOne(['id'=> \Yii::$app->user->identity->getId()]) ;
        $stat = SurveyStat::findOne(['survey_stat_survey_id'=>$id,'survey_stat_user_id'=>$user->id]);
        if (!$stat || !$stat->survey_stat_is_done) return ResponseHelper::sendFailedResponse(['message'=>'Forbidden'],403);
        return ResponseHelper::sendSuccessResponse(['token'=>$stat->survey_stat_hash]);

    }

    public function actionCustomReport($id,$user_id)
    {
        $user= User::findOne(['id'=> $user_id]) ;
        if(! $id) return ResponseHelper::sendFailedResponse(['message'=>"Missing Data"],'404');
        $profile=$user->userProfile;
        $_SESSION['userID'] =$user_id;

        $surveyObj = SurveyReportResource::findOne(['survey_id'=>$id]); //,'survey_is_visible' => 1

        if(!$surveyObj)  return ResponseHelper::sendFailedResponse(['message'=>'Survey not found'],404);
        return ResponseHelper::sendSuccessResponse($surveyObj);

    }

    public function actionUpdate($id)
    {
        $user= User::findOne(['id'=> \Yii::$app->user->identity->getId()]) ;
        if(! $id) return ResponseHelper::sendFailedResponse(['message'=>"Missing Data"],404);
        $profile=$user->userProfile;

        $surveyObj = SurveyResource::findOne(['survey_id'=>$id,'survey_is_visible' => 1]);
        if(!$surveyObj)  return ResponseHelper::sendFailedResponse(['message'=>'Assessment not found'],404);

        $params = \Yii::$app->request->post();
        if (!isset($params['status'])) $params['status'] = null;
        if (!isset($params['pageNo'])) $params['pageNo'] = null;
        //add survey state
        $survey_done =  $this->CheckState($surveyObj->survey_id,$params['status'],$params['pageNo']);

        if(!$survey_done)  return ResponseHelper::sendFailedResponse(['message'=>'Survey is Completed'],404);

        if (!array_key_exists('answers',$params) || !is_array($params['answers'])){
            return ResponseHelper::sendFailedResponse(['message'=>'Invalid Params'],400);
        };
        $questionIds = [];
        foreach ($params['answers'] as $key=>$value) {

          if (strstr($key, 'Q-')) {
              $key         = (int)preg_replace('/\D/ui','',$key);
              $question    = $this->findModel($key);
              if ($question->survey_question_can_ignore and ($value == 'Yes' || $value == 'نعم')) {
                  $userAnswers = $question->userAnswers;
                  $userAnswer  = !empty(current($userAnswers)) ? current($userAnswers) : (new SurveyUserAnswer([
                             'survey_user_answer_user_id' => \Yii::$app->user->getId(),
                             'survey_user_answer_survey_id' => $question->survey_question_survey_id,
                             'survey_user_answer_question_id' => $question->survey_question_id,
                         ]));
                  $userAnswer->not_applicable = 1;
                  $userAnswer->survey_user_answer_text ='تم تخطيه لأنه لا ينطبق';
                  $userAnswer->survey_user_answer_point = $question->survey_question_point;
                  $userAnswer->save(false);
              }
          }elseif (strstr($key, 'f-')){
            $key=  (int)preg_replace('/\D/ui','',$key);
            $question = $this->findModel($key);
            if ($question->survey_question_attachment_file and ($value == 'No' || $value == 'لا') ) {
              SurveyUserAnswerAttachments::deleteAll(['survey_user_answer_attachments_survey_id'=>$question->survey_question_survey_id ,
                   'survey_user_answer_attachments_question_id'=>$question->survey_question_id,
                   'survey_user_answer_attachments_user_id' => \Yii::$app->user->getId()
                   ]);
            }
          }elseif (strstr($key, 'a-')){
            $key=  (int)preg_replace('/\D/ui','',$key);
            $question = $this->findModel($key);
            if ($question->survey_question_attachment_file) {
              SurveyUserAnswerAttachments::deleteAll(['survey_user_answer_attachments_survey_id'=>$question->survey_question_survey_id ,
                   'survey_user_answer_attachments_question_id'=>$question->survey_question_id,
                   'survey_user_answer_attachments_user_id' => \Yii::$app->user->getId()
                   ]);
              foreach ($value as $index => $file) {
                $fileObj= new SurveyUserAnswerAttachments();
                $fileObj->survey_user_answer_attachments_user_id = \Yii::$app->user->identity->getId();
                $fileObj->survey_user_answer_attachments_survey_id = $question->survey_question_survey_id ;
                $fileObj->survey_user_answer_attachments_question_id = $question->survey_question_id ;
                $fileObj->path = $file['content'];
                $fileObj->base_url= ' ';
                $fileObj->name = $file['name'];
                $fileObj->type = $file['type'];
                $fileObj->save();
              }
            }else{
                return ResponseHelper::sendFailedResponse(['message'=>'Forbidden'],403);
            }
          }elseif (strstr($key, 'q-')){
              $key=  (int)preg_replace('/\D/ui','',$key);
              $question = $this->findModel($key);
              $questionIds[] = $question->survey_question_id;
             //check question type
             if (($question->survey_question_type === SurveyType::TYPE_SINGLE_TEXTBOX
                  || $question->survey_question_type === SurveyType::TYPE_COMMENT_BOX) and !is_array($value)
              ){
                 //handel one answer
                 $userAnswers = $question->userAnswers;
                 $userAnswer = !empty(current($userAnswers)) ? current($userAnswers) : (new SurveyUserAnswer([
                     'survey_user_answer_user_id' => \Yii::$app->user->getId(),
                     'survey_user_answer_survey_id' => $question->survey_question_survey_id,
                     'survey_user_answer_question_id' => $question->survey_question_id,
                 ]));

                $userAnswer->survey_user_answer_point = $question->survey_question_point;
                $userAnswer->survey_user_answer_value = $value;
                $userAnswer->save(false);
              }elseif ($question->survey_question_type === SurveyType::TYPE_SLIDER and !is_array($value)
              ){
                if ($question->answers[0]->survey_answer_name <= $value and $question->answers[1]->survey_answer_name >= $value) {
                     $userAnswers = $question->userAnswers;
                     $userAnswer = !empty(current($userAnswers)) ? current($userAnswers) : (new SurveyUserAnswer([
                         'survey_user_answer_user_id' => \Yii::$app->user->getId(),
                         'survey_user_answer_survey_id' => $question->survey_question_survey_id,
                         'survey_user_answer_question_id' => $question->survey_question_id,
                     ]));

                    $userAnswer->survey_user_answer_point = $question->survey_question_point;
                    $userAnswer->survey_user_answer_value = $value;
                    $userAnswer->save(false);
                }else{
                    return ResponseHelper::sendFailedResponse(['message'=>'Bad Request'],400);
                }
              }elseif ($question->survey_question_type === SurveyType::TYPE_DATE_TIME and !is_array($value)
              ){
                    $date =  str_ireplace('/', '-', $value);
                    if ($question->survey_question_can_skip == 0 and (date('d-m-Y',strtotime($date)) != $date)) {
                        return ResponseHelper::sendFailedResponse(['message'=>'Bad Request Date'],400);
                    }
                    $answerPoint = SurveyAnswer::findOne(['survey_answer_question_id'=>$question->survey_question_id]);
                    //handel one answer
                    $userAnswers = $question->userAnswers;
                    $userAnswer = !empty(current($userAnswers)) ? current($userAnswers) : (new SurveyUserAnswer([
                         'survey_user_answer_user_id' => \Yii::$app->user->getId(),
                         'survey_user_answer_survey_id' => $question->survey_question_survey_id,
                         'survey_user_answer_question_id' => $question->survey_question_id,
                    ]));
                    $point = 0;

                    $answerValue = strtotime($value);
                    $from = strtotime($question->answers[0]->survey_answer_name);
                    $to = strtotime($question->answers[1]->survey_answer_name);

                    if ($answerValue >= $from and $answerValue <= $to) {
                        $point = $question->survey_question_point;
                    }else{
                        if ($params['status'] == 2) {
                            $this->correctiveActionReport($question,$answerPoint);
                        }
                    }
                    $userAnswer->survey_user_answer_point = $point;
                    $userAnswer->survey_user_answer_value = $value;
                    $userAnswer->save(false);
              }elseif ($question->survey_question_type === SurveyType::TYPE_DROPDOWN and !is_array($value) and is_integer( (int) $value )){
                 $answerPoint = SurveyAnswer::findOne(['survey_answer_id'=>$value,'survey_answer_question_id'=>$question->survey_question_id]);
                if ($answerPoint) {
                     $userAnswers = $question->userAnswers;
                     $userAnswer = !empty(current($userAnswers)) ? current($userAnswers) : (new SurveyUserAnswer([
                         'survey_user_answer_user_id' => \Yii::$app->user->getId(),
                         'survey_user_answer_survey_id' => $question->survey_question_survey_id,
                         'survey_user_answer_question_id' => $question->survey_question_id,
                     ]));
                    if ($answerPoint->correct ) {
                        $userAnswer->survey_user_answer_point = $question->survey_question_point;
                     }else{
                        if ($params['status'] == 2) {
                            $this->correctiveActionReport($question,$answerPoint);
                        }
                     }
                    $userAnswer->survey_user_answer_answer_id = $value;
                    $userAnswer->survey_user_answer_value = $value;
                    $userAnswer->save(false);
                }else{
                    return ResponseHelper::sendFailedResponse(['message'=>'Bad Request'],400);
                }

              }elseif ($question->survey_question_type === SurveyType::TYPE_ONE_OF_LIST
               and !is_array($value) and is_integer( (int) $value )){
                 //handel one answer
                $answerPoint = SurveyAnswer::findOne(['survey_answer_id'=>$value,'survey_answer_question_id'=>$question->survey_question_id]);
                 if ($answerPoint) {
                     $userAnswers = $question->userAnswers;
                     $userAnswer = !empty(current($userAnswers)) ? current($userAnswers) : (new SurveyUserAnswer([
                         'survey_user_answer_user_id' => \Yii::$app->user->getId(),
                         'survey_user_answer_survey_id' => $question->survey_question_survey_id,
                         'survey_user_answer_question_id' => $question->survey_question_id,
                     ]));
                     if ($answerPoint->correct ) {
                        $userAnswer->survey_user_answer_point = $answerPoint->question->survey_question_point;
                     }else{
                        if ($params['status'] == 2) {
                            $this->correctiveActionReport($question,$answerPoint);
                        }
                     }
                     $userAnswer->survey_user_answer_answer_id = $value;
                     $userAnswer->survey_user_answer_value = $value;
                     $userAnswer->save(false);
                }else{
                    return ResponseHelper::sendFailedResponse(['message'=>'Bad Request'],400);
                }
              }else if($question->survey_question_type === SurveyType::TYPE_MULTIPLE
                 || $question->survey_question_type === SurveyType::TYPE_MULTIPLE_TEXTBOX
             ) {
                 //delete old answers and add new
                 SurveyUserAnswer::deleteAll(['survey_user_answer_survey_id'=>$question->survey_question_survey_id ,
                     'survey_user_answer_question_id'=>$question->survey_question_id,
                     'survey_user_answer_user_id' => \Yii::$app->user->getId()
                     ]);
                 //save multiple

                 $correctCount = count(SurveyAnswer::find()->where(['survey_answer_question_id'=>$question->survey_question_id,'correct'=>1])->all());
                if ($correctCount) {
                    $point =  $question->survey_question_point / $correctCount;
                }else{
                    $point = 0;
                }
                 $valid_count = 0;
                 foreach ($question->answers as $i => $answer) {
                   $found = in_array($answer->survey_answer_id ,$value);
                    if($found){
                        $valid_count++;
                        $userAnswer =  new SurveyUserAnswer();

                            $userAnswer->survey_user_answer_user_id = \Yii::$app->user->getId();
                            $userAnswer->survey_user_answer_survey_id = $question->survey_question_survey_id;
                            $userAnswer->survey_user_answer_question_id = $question->survey_question_id;
                            $userAnswer->survey_user_answer_answer_id = $answer->survey_answer_id;
                            $userAnswer->survey_user_answer_value =1 ;
                            if ($answer->correct ) {
                                $userAnswer->survey_user_answer_point = $point;
                            }else{
                                if ($params['status'] == 2) {
                                    $this->correctiveActionReport($question,$answer);
                                }
                            }
                        $userAnswer->save(false);
                    }
                }

                if (count($value) > 0 and $valid_count == 0) {
                    return ResponseHelper::sendFailedResponse(['message'=>'Bad Request'],400);
                }

             }else if($question->survey_question_type === SurveyType::TYPE_RANKING and is_array($value)) {
                 //delete old answers and add new
                 SurveyUserAnswer::deleteAll(['survey_user_answer_survey_id'=>$question->survey_question_survey_id ,
                     'survey_user_answer_question_id'=>$question->survey_question_id,
                     'survey_user_answer_user_id' => \Yii::$app->user->getId()
                     ]);
                 //save multiple
                $valid_count = 0;
                foreach ($question->answers as $i => $answer) {
                   $ids = array_keys($value);
                   $found = in_array($answer->survey_answer_id ,$ids);
                    if($found){
                        if (isset($value[$answer->survey_answer_id]['rate'])) {
                            $valid_count++;
                            $userAnswer =  new SurveyUserAnswer();
                            $userAnswer->survey_user_answer_user_id = \Yii::$app->user->getId();
                            $userAnswer->survey_user_answer_survey_id = $question->survey_question_survey_id;
                            $userAnswer->survey_user_answer_question_id = $question->survey_question_id;
                            $userAnswer->survey_user_answer_answer_id = $answer->survey_answer_id;
                            $userAnswer->survey_user_answer_value = $value[$answer->survey_answer_id]['rate'];
                            if ($i == 0) {
                                $userAnswer->survey_user_answer_point = $answer->question->survey_question_point;
                            }
                            $userAnswer->save(false);
                        }else{
                            return ResponseHelper::sendFailedResponse(['message'=>'Bad Request'],400);
                        }
                    }
                }
                if (count($ids) > 0 and $valid_count == 0) {
                    return ResponseHelper::sendFailedResponse(['message'=>'Bad Request'],400);
                }
             }else if($question->survey_question_type === SurveyType::TYPE_FILE and is_array($value)) {
                 //save multiple
                if (count($value) > 0 ) {
                    SurveyUserAnswer::deleteAll(['survey_user_answer_survey_id'=>$question->survey_question_survey_id ,
                     'survey_user_answer_question_id'=>$question->survey_question_id,
                     'survey_user_answer_user_id' => \Yii::$app->user->getId()
                   ]);
                   foreach ($value as $k => $file) {
                      $host = \Yii::getAlias('@storageUrl');
                      if (strpos($file['content'],$host.'/source/answers') !== false) {
                          $userAnswer =  new SurveyUserAnswer();
                          $userAnswer->survey_user_answer_user_id = \Yii::$app->user->getId();
                          $userAnswer->survey_user_answer_survey_id = $question->survey_question_survey_id;
                          $userAnswer->survey_user_answer_question_id = $question->survey_question_id;
                          $userAnswer->survey_user_answer_value = $file['content'];
                          $userAnswer->survey_user_answer_text = $file['name'];
                          $userAnswer->survey_user_answer_file_type = $file['type'];
                          if ($k == 0) {
                            $userAnswer->survey_user_answer_point = $question->survey_question_point;
                          }
                          $userAnswer->save(false);
                      }else{
                          return ResponseHelper::sendFailedResponse(['message'=>'Bad Request File'],400);
                      }
                    }
                }
             }else{
                return ResponseHelper::sendFailedResponse(['message'=>'Bad Request'],400);
             }//end if
          } // end if strstr

        }//end loap answers
        if ($params['status'] == 2) {
            $this->sendReportEmail($surveyObj,$user);
        }

        $this->checkQuestionAnswer($surveyObj->survey_id,$questionIds);
        return ResponseHelper::sendSuccessResponse();

    }

    public function sendReportEmail($surveyObj,$user)
    {

        $assignedModel = SurveyStat::getAssignedUserStat($user->id,$surveyObj->survey_id);
        \Yii::$app->language  = 'ar';
        $variables = [
            'user' => $user,
            'survey' => $surveyObj,
            'token'=> $assignedModel->survey_stat_hash
        ];

        \Yii::$app->mailer->compose('reportAsnwer',$variables)
          ->setTo($user->email)
          ->setSubject('تقرير اجابات المشارك')
          ->send();

        if ($user->userProfile->sector_id) {
          $structure = OrganizationStructure::find()->select('id')
              ->where(['root'=>$user->userProfile->sector->root,'lvl'=>0])
              ->one();
            
            $users = User::find();
            $users->joinWith(['userProfile'])
                ->where(['organization_id'=>$surveyObj->org_id]);
            $users->join('LEFT JOIN','{{%rbac_auth_assignment}}','{{%rbac_auth_assignment}}.user_id = {{%user}}.id')
                ->andFilterWhere(['{{%rbac_auth_assignment}}.item_name' => 'governmentAdmin'])
                ->andFilterWhere(['sector_id'=>$structure->id]);
          foreach ($users->all() as $admin) {
              \Yii::$app->mailer->compose('reportOrganizationAdminAsnwer',$variables)
                ->setTo($admin->email)
                ->setSubject('تقرير اجابات المشارك')
                ->send();  
          }
        }  
    }

    private function checkQuestionAnswer($survey_id,$questionIds)
    {
        $userAnswerQuestionIds = SurveyUserAnswer::findAll([
          'survey_user_answer_survey_id'=>$survey_id ,
          'survey_user_answer_user_id' => \Yii::$app->user->getId()
        ]);

        $survey_user_answer_question_id = ArrayHelper::getColumn($userAnswerQuestionIds,'survey_user_answer_question_id');

        $result = array_diff($survey_user_answer_question_id,$questionIds);

        foreach ($result as $value) {
          $userAnswerQuestionIds = SurveyUserAnswer::deleteAll([
           'survey_user_answer_question_id'=>$value,
            'survey_user_answer_survey_id'=>$survey_id ,
            'survey_user_answer_user_id' => \Yii::$app->user->getId()
          ]);
        }
    }

    public function correctiveActionReport($questionObj,$answerObj)
    {
        $user = \Yii::$app->user->identity->userProfile;
        $report = CorrectiveActionReport::findOne(['user_id'=>$user->user_id,'answer_id'=> $answerObj->survey_answer_id]);
        if ($answerObj->survey_answer_show_corrective_action) {
            if (!$report) {
                $report = new CorrectiveActionReport();
                $report->org_id = $user->organization_id;
                $report->user_id = $user->user_id;
                $report->survey_id = $questionObj->survey->survey_id;
                $report->question_id = $questionObj->survey_question_id;
                $report->answer_id = $answerObj->survey_answer_id;
                $report->corrective_action = $answerObj->survey_answer_corrective_action;
                $report->corrective_action_date = $answerObj->corrective_action_date;
                $report->save(false);
            }
        }
    }


    public function actionSurveyStart($surveyId)
    {
        $assignedModel = SurveyStat::getAssignedUserStat(\Yii::$app->user->getId(), $surveyId);
        if (empty($assignedModel)) {
            SurveyStat::assignUser(\Yii::$app->user->getId(), $surveyId);
            $assignedModel = SurveyStat::getAssignedUserStat(\Yii::$app->user->getId(),$surveyId);
            $assignedModel->survey_stat_session_start = date('Y-m-d H:i:s');
            $assignedModel->save(false);
        }

        $assignedModel->survey_stat_session_start = date('Y-m-d H:i:s');
        $assignedModel->save(false);
    }

    public function CheckState($surveyId,$status = null,$pageNo = 0){
        $assignedModel = SurveyStat::getAssignedUserStat(\Yii::$app->user->getId(), $surveyId);


        if (empty($assignedModel)) {
            SurveyStat::assignUser(\Yii::$app->user->getId(), $surveyId);
            $assignedModel = SurveyStat::getAssignedUserStat(\Yii::$app->user->getId(),$surveyId);
        } else {
//            if ($assignedModel->survey_stat_is_done){
//                return $this->renderClosed();
//            }
        }

        if ($assignedModel->survey_stat_started_at === null) {
            $assignedModel->survey_stat_started_at = new Expression('NOW()');
            $assignedModel->save(false);
        }
        $stat = SurveyStat::getAssignedUserStat(\Yii::$app->user->getId(), $surveyId);
        //не работаем с завершенными опросами
        if ($status == 2 && $stat->survey_stat_is_done != 1) {
            $assignedModel->survey_stat_is_done = 1;
            $assignedModel->pageNo = $pageNo;
            $assignedModel->save(false);
        }elseif($status == 1){
            $assignedModel->pageNo = $pageNo;
            $assignedModel->save(false);
        }

        $start_date = new \DateTime($assignedModel->survey_stat_session_start);
        $since_start = $start_date->diff(new \DateTime(date('Y-m-d H:i:s')));
        $assignedModel->survey_stat_actual_time += ((($since_start->format("%a") * 24) + $since_start->format("%H")) * 60 + $since_start->format("%i")) * 60 + $since_start->format("%s");
        $assignedModel->save(false);

        if ($stat->survey_stat_is_done) {
            return false;
        }


        return true;
    }

    protected function findModel($id)
    {
        if (($model = SurveyQuestion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionDeleteFile()
    {
        $params = \Yii::$app->request->post();
        return $params;
    }

}

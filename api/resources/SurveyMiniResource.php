<?php

namespace api\resources;

use backend\modules\assessment\models\Survey;
use backend\modules\assessment\models\SurveyStat;
use common\models\OrganizationStructure;

class SurveyMiniResource extends Survey
{
    public function fields()
    {
        return [
            'id'=>function($model){
                return $model->survey_id;
            },
            'status'=>function($model){
                $userId = \Yii::$app->user->identity->id;
                $userSurveyStat =  SurveyStat::find()->where(['survey_stat_user_id'=>$userId,'survey_stat_survey_id'=>$model->survey_id])->one();
                if (!$userSurveyStat) {
                    return 0;
                }
                return $userSurveyStat->survey_stat_is_done ? 2 : 1;
            },
            'progress'=>function($model){
                $progress = Survey::surveyProgress($model,\Yii::$app->user->identity->id);
                return  round($progress);
            },

            'title'=>function($model){
                return $model->survey_name;
            },
            'isClosed'=>function($model){
                if ($model->survey_is_closed) {
                   return true;
                }elseif(strtotime($model->survey_expired_at)){
                    return time() >= strtotime($model->survey_expired_at);
                }
                return false;
            },

            'description'=>function($model){
                return $model->survey_descr;
            },
            'department'=>function($model){
                $sectors = OrganizationStructure::find()->where(['root'=>$model->sector->root])->andWhere(['<=','id',$model->sector->id])->all();
                $txt = '';
                foreach ($sectors as $value) {
                    $txt .=  $value->name .' / ';
                }
                return trim($txt,' / ');
            },
            'tags'=>function($model){
                return $model->tags;
            },
            'survey_time_to_pass'=>function($model){
                return $model->survey_time_to_pass;
            },
            'remaining_time'=>function($model){
                return SurveyStat::remainingTime($model,\Yii::$app->user->identity->id);
            },

            'actual_time'=> function($model){
                return SurveyStat::actualTime($model->survey_id,\Yii::$app->user->identity->id);
            },
            'expiryDate'=>function($model){
                if (is_null($model->survey_expired_at)) {
                    return null;
                }
                return date('Y-m-d',strtotime($model->survey_expired_at));
            },
            'qNum'=>function($model){
                return count($model->questions);
            },
            'AssessmentTimer'=>function($model){
                if (is_null($model->survey_expired_at)) {
                    return false;
                }
                return true;
            }
        ];
    }


}

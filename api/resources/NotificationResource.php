<?php

namespace api\resources;
use backend\models\CorrectiveActionReport;

class NotificationResource extends CorrectiveActionReport
{
    public function fields()
    {
        return [
            'title'=>function($model){
                return $model->survey->survey_name;
            },
            'message'=>function($model){
                $userId = \Yii::$app->user->identity->userProfile;
                if ($userId->locale == 'en-US') {
                    $message = 'You have corrective action to be completed';
                }else{
                    $message = 'لديك إجراء تصحيحي يجب الانتهاء منه';
                }
                return $message;
            },
            'survey_id'=>function($model){
                return $model->survey_id;
            },
            'type'=>function($model){
            	return 'CorrectiveAction';
            },
        ];
    }


}

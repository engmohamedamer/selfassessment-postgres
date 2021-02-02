<?php

namespace api\resources;

use backend\modules\assessment\models\Survey;
use backend\modules\assessment\models\SurveyStat;

class User extends \common\models\User
{
    public function fields()
    {
        return [
            'id'=>function($model){
                 return $model->id;
              },
            'email',
            'firstname'=>function($model){
                return $model->userProfile->firstname ;
            },
            'lastname'=>function($model){
                return $model->userProfile->lastname ;
            },
            'mobile'=>function($model){
                return $model->userProfile->mobile ;
            },
            'profile_picture'=>function($model){
                return $model->userProfile->avatar_base_url.$model->userProfile->avatar_path ;
            },
            'bio'=>function($model){
                return $model->userProfile->bio;
            },
            'position'=>function($model){
                return $model->userProfile->position;
            },
            'address'=>function($model){
                return $model->userProfile->address;
            },
            'city_id'=>function($model){
                return $model->userProfile->city_id;
            },
            'district_id'=>function($model){
                return $model->userProfile->district_id;
            },
            'organization'=>function($model){
                return ['id'=>$model->userProfile->organization->id,'name'=>$model->userProfile->organization->name,'slug'=> $model->userProfile->organization->slug];
            },
            'locale'=>function($model){
                if ($model->userProfile->locale == 'en-US') {
                    return 'en';
                }else{
                    return 'ar';
                }
            },
            'allAssessments'=>function($model){
                return Survey::countOrgSurvey($model->userProfile->organization_id);
            },
            'completedAssessments'=>function($model){
                return SurveyStat::countCompletedAssessments($model->id);
            },
            'uncompletedAssessments'=>function($model){
                return SurveyStat::countUncompletedAssessments($model->id);
            },
        ];
    }


}

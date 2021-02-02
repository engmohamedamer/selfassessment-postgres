<?php

namespace api\controllers;

use Yii;
use api\controllers\RestController;
use api\helpers\ResponseHelper;
use api\resources\SurveyReportResource;
use api\resources\SurveyResource;
use api\resources\User;
use backend\modules\assessment\models\SurveyStat;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;

class ReportController extends RestController
{

    public function actionView($token){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $stat = SurveyStat::findOne(['survey_stat_hash'=>$token]);

        if (!$stat->survey_stat_is_done) {
            return ResponseHelper::sendFailedResponse(['message'=>'Not Allowed'],403);
        }
        $_GET['org'] = $stat->survey->organization->slug;

        $theme = new ThemeController([],[]);
        $themeData  = $theme->actionIndex();

        $surveyObj = SurveyResource::find()->where(['survey_id'=>$stat->survey_stat_survey_id,'survey_is_visible' => 1])->one();

        $_SESSION['userID'] = $stat->survey_stat_user_id;
        $surveyObj2 = SurveyReportResource::findOne(['survey_id'=>$stat->survey_stat_survey_id,'survey_is_visible' => 1]);

        $data['theme'] = $themeData;
        $data['question'] = $surveyObj;
        $data['report'] = $surveyObj2;
        return ResponseHelper::sendSuccessResponse($data);
    }

}
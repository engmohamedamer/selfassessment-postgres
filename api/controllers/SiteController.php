<?php

namespace api\controllers;

use Yii;
use api\helpers\ResponseHelper;
use api\resources\SurveyResource;
use api\resources\User;
use backend\modules\assessment\models\SurveyStat;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class SiteController extends Controller
{
    public function actionIndex(){

        return 'API...';
       // return $this->redirect(\Yii::getAlias('@frontendUrl'));
    }

    public function actionReport($token){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $stat = SurveyStat::findOne(['survey_stat_hash'=>$token]);

        if (!$stat->survey_stat_is_done) {
            return ResponseHelper::sendFailedResponse(['message'=>'Not Allowed'],403);
        }
        $_GET['org'] = $stat->survey->organization->slug;

        $theme = new ThemeController([],[]);
        $themeData  = $theme->actionIndex();

        $surveyObj = SurveyResource::find()->where(['survey_id'=>$stat->survey_stat_survey_id,'survey_is_visible' => 1])->one();

        $data['theme'] = $themeData;
        $data['question'] = $surveyObj;
        return ResponseHelper::sendSuccessResponse($data);
    }


    public function actionError()
    {
        if (($exception = Yii::$app->getErrorHandler()->exception) === null) {
            $exception = new NotFoundHttpException(Yii::t('yii', 'Page not found.'));
        }

        if ($exception instanceof \HttpException) {
            Yii::$app->response->setStatusCode($exception->getCode());
        } else {
            Yii::$app->response->setStatusCode(500);
        }

        return $this->asJson(['error' => $exception->getMessage(), 'code' => $exception->getCode()]);
    }
}
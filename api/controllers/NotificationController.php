<?php

namespace api\controllers;

use api\helpers\ResponseHelper;
use api\resources\NotificationResource;
use yii\web\NotFoundHttpException;

class NotificationController extends  MyActiveController
{
    public $modelClass = NotificationResource::class;

    public function actions(){
        $actions = parent::actions();
        unset($actions['index']);
        // unset($actions['view']);
        // unset($actions['update']);
        // unset($actions['delete']);
        return $actions;
    }

    public function actionIndex(){
    	$notifications = NotificationResource::find()->select('survey_id,user_id ,count(id) , max(corrective_action_date)')->where(['user_id'=>\Yii::$app->user->identity->getId()])
            ->groupBy('survey_id')
            ->limit(5)->all();
        return ResponseHelper::sendSuccessResponse($notifications);
    }

}
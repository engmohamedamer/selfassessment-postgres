<?php

namespace api\controllers;

use api\controllers\RestController;
use api\helpers\ResponseHelper;
use api\resources\CityResource;
use api\resources\DistrictResource;
use backend\models\City;

class LookupsController extends RestController
{

    public function actionListCities(){
    	$cities = CityResource::find()->all();
        return ResponseHelper::sendSuccessResponse($cities);
    }


    public function actionListDistricts(){
        $params = \Yii::$app->request->get();
        if (empty($params['city_id'])) {
            return ResponseHelper::sendFailedResponse(['INTER_VALID_CITY'=>\Yii::t('common','Invalid City')],404);
        }
    	$districts = DistrictResource::find()->where(['city_id'=>$params['city_id']])->all();
        return ResponseHelper::sendSuccessResponse($districts);
    }


}
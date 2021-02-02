<?php

namespace backend\controllers;

use Yii;
use backend\models\District;
use common\models\lookup\Country;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * BlogController implements the CRUD actions for Blog model.
 */
class CountryController extends   BackendController
{

    public function actionIndex()
    {

        return $this->render('//lookup/country');
    }


    public function actionCities() {
        $out = [];

        $root = ($_POST['depdrop_all_params']['City-id']) ;
        if (isset($_POST['depdrop_parents']) and $_POST['depdrop_parents'][0]!= '') {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $country_id = $parents[0];

                $countries = Country::find()->where('lvl > 0 and root='.$root)->all() ;
                foreach ($countries as $country) {
                    $data[]= ['id'=>$country->id, 'name'=>$country->name ];
                }

                $out = $data;
            }
        }
        return  Json::encode(['output'=>$out, 'selected'=>'']);
    }

    public function actionDistrict() {
        $out = [];

        $root = ($_POST['depdrop_all_params']['City-id']) ;
        if (isset($_POST['depdrop_parents']) and $_POST['depdrop_parents'][0]!= '') {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $districts = District::find()->where('city_id='.$root)->all() ;
                foreach ($districts as $district) {
                    $data[]= ['id'=>$district->id, 'name'=>$district->title ];
                }

                $out = $data;
            }
        }
        return  Json::encode(['output'=>$out, 'selected'=>'']);
    }




}

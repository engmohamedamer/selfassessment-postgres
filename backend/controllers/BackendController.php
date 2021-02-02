<?php

namespace backend\controllers;

use webvimark\behaviors\multilanguage\MultiLanguageHelper;

/**
 * Site controller
 */
class BackendController extends \yii\web\Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }


    public function init()
    {

        MultiLanguageHelper::catchLanguage();
        if(\Yii::$app->user->identity->userProfile->locale == 'ar-AR'){
            \Yii::$app->language = 'ar';
        }else{
            \Yii::$app->language = 'en';
        }
       // \Yii::$app->language = 'ar'; //\Yii::$app->user->identity->userProfile->locale;

        parent::init();
    }



//    public function init()
//    {
//        parent::init();
//        \Yii::$app->keyStorage->set('accounting.theme-skin', 'skin-blue');
//
//    }


}

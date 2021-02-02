<?php
/*
 *
 * child entity between parent and trainer (assign - accept adding )
 *
 * */
namespace api\controllers;
use webvimark\behaviors\multilanguage\MultiLanguageHelper;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\Controller;

class RestController  extends  Controller
{


    public static function allowedDomains()
    {
        return [
            '*',                        // star allows all domains
        ];
    }
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        // add CORS filter
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
                'Origin' => self::allowedDomains(),
                'Access-Control-Request-Method' => ['*'],
                'Access-Control-Request-Headers' => ['*'],
            ],
        ];

        return $behaviors;
    }


}

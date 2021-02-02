<?php
$config = [
    'homeUrl' => Yii::getAlias('@apiUrl'),
    'controllerNamespace' => 'api\controllers',
    'defaultRoute' => 'site/index',
    //'bootstrap' => ['maintenance'],
    'modules' => [
        //'v1' => \api\modules\v1\Module::class              //------------ hide for now -----------------------//
    ],
    'components' => [
        'errorHandler' => [
            'errorAction' => 'site/error'
        ],
//        'maintenance' => [
//            'class' => common\components\maintenance\Maintenance::class,
//            'enabled' => function ($app) {
//                if (env('APP_MAINTENANCE') === '1') {
//                    return true;
//                }
//                return $app->keyStorage->get('frontend.maintenance') === 'enabled';
//            }
//        ],


        'request' => [
            'enableCookieValidation' => false,
            'enableCsrfValidation' => false,
            'enableCsrfCookie' => false,
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            // 'cookieValidationKey' => 'wjwo8NPhgzATIEVRLhibGp2pvcKlU_kl',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],


//        'response' => [
//            'class' => 'yii\web\Response',
//            'on beforeSend' => function ($event) {
//                $response = $event->sender;
//                if ($response->data !== null && Yii::$app->request->get('suppress_response_code')) {
//                    $response->data = [
//                        'success' => $response->isSuccessful,
//                        'data' => $response->data,
//                    ];
//                    $response->statusCode = 200;
//                }
//            },
//        ],

        'user' => [
            'class' => yii\web\User::class,
            'identityClass' => common\models\User::class,
            'enableSession' => false,
            'loginUrl' =>null, // ['/user/sign-in/login'],
            'enableAutoLogin' =>false, // true,
            //'as afterLogin' => common\behaviors\LoginTimestampBehavior::class
        ]
    ]
];

return $config;

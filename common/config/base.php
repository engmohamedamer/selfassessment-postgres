<?php

use yii\db\mssql\PDO;
$config = [
    'name' => 'Self Assessment',
    'vendorPath' => __DIR__ . '/../../vendor',
    'extensions' => require __DIR__ . '/../../vendor/yiisoft/extensions.php',
    'sourceLanguage' => 'en-US',
    'language' => 'ar-AR',
    'bootstrap' => ['log', 'headers'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'timeZone' => 'Asia/Riyadh',
    'components' => [
        'headers' => [
            // /*   commented for local machine use
            'class' => '\common\helpers\MyHeader',
            'upgradeInsecureRequests' => true,
            'blockAllMixedContent' => false,
            'requireSriForScript' => false,
            'requireSriForStyle' => false,
            'xssProtection' => true,
            'contentTypeOptions' => false,
            'stsMaxAge' => 10,
            'xFrameOptions' => 'SAMEORIGIN',
            'xPoweredBy' => 'Sahl',
            'publicKeyPins' => '',
            'cspDirectives' => [
                'script-src' => "'self' 'unsafe-inline' 'unsafe-eval'",
                'style-src' => "'self' 'unsafe-inline' 'unsafe-eval'",
                'img-src' => "'self' 'unsafe-eval'  data:",
                'connect-src' => "'self' 'unsafe-eval' ",
                'font-src' => "'self' 'unsafe-eval' ",
                'object-src' => "'self' 'unsafe-eval'",
                'media-src' => "'self' 'unsafe-eval' ",
                'form-action' => "'self' 'unsafe-eval'",
                'frame-src' => "'self' 'unsafe-eval' ",
                'child-src' => "'self' 'unsafe-eval'",
                'worker-src' => "'self'",
            ],
            //*/

            //      'referrerPolicy' => 'no-referrer',
            //     'reportUri' => 'https://sahl.tech',
            //    'featurePolicyDirectives' => [
            //        'accelerometer' => "'self'",
            //        'ambient-light-sensor' => "'self'",
            //        'autoplay' => "'self'",
            //        'camera' => "'self'",
            //        'encrypted-media' => "'self'",
            //        'fullscreen' => "'self'",
            //        'geolocation' => "'self'",
            //        'gyroscope' => "'self'",
            //        'magnetometer' => "'self'",
            //        'microphone' => "'self'",
            //        'midi' => "'self'",
            //        'payment' => "'self'",
            //        'picture-in-picture' => "*",
            //        'speaker' => "'self'",
            //        'usb' => "'self'",
            //        'vr' => "'self'"
            //    ]
        ],

        'authManager' => [
            'class' => yii\rbac\DbManager::class,
            'itemTable' => '{{%rbac_auth_item}}',
            'itemChildTable' => '{{%rbac_auth_item_child}}',
            'assignmentTable' => '{{%rbac_auth_assignment}}',
            'ruleTable' => '{{%rbac_auth_rule}}',
        ],

//        'fcm' => [
        //            'class' => 'aksafan\fcm\source\components\Fcm',
        //            'apiVersion' => \aksafan\fcm\source\requests\StaticRequestFactory::LEGACY_API,
        //            'apiParams' => [
        //                'serverKey' => env('FCM_SERVER_KEY'),
        //                'senderId' => env('FCM_SENDER_ID'),
        //            ],
        //        ],

        'cache' => [
            'class' => yii\caching\FileCache::class,
            'cachePath' => '@common/runtime/cache',
        ],

        'commandBus' => [
            'class' => trntv\bus\CommandBus::class,
            'middlewares' => [
                [
                    'class' => trntv\bus\middlewares\BackgroundCommandMiddleware::class,
                    'backgroundHandlerPath' => '@console/yii',
                    'backgroundHandlerRoute' => 'command-bus/handle',
                ],
            ],
        ],

        'formatter' => [
            'class' => yii\i18n\Formatter::class,
        ],

        'glide' => [
            'class' => trntv\glide\components\Glide::class,
            'sourcePath' => '@storage/web/source',
            'cachePath' => '@storage/cache',
            'urlManager' => 'urlManagerStorage',
            'maxImageSize' => env('GLIDE_MAX_IMAGE_SIZE'),
            'signKey' => env('GLIDE_SIGN_KEY'),
        ],

        'mailer' => [
            'class' => yii\swiftmailer\Mailer::class,
            'messageConfig' => [
                'charset' => 'UTF-8',
                'from' => env('ADMIN_EMAIL'),
            ],
        ],

        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => env('DB_DSN'),
            'username' => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD'),
            'charset' => 'utf8',
            'attributes'=>[
                PDO::ATTR_EMULATE_PREPARES => true
            ],
            'schemaMap' => [
                'pgsql' => [
                    'class' => 'yii\db\pgsql\Schema',
                    'defaultSchema' => 'public', //specify your schema here, public is the default schema
                ],
            ], // PostgreSQL
        ],

        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                'db' => [
                    'class' => 'yii\log\DbTarget',
                    'levels' => ['error', 'warning'],
                    'except' => ['yii\web\HttpException:*', 'yii\i18n\I18N\*'],
                    'prefix' => function () {
                        $url = !Yii::$app->request->isConsoleRequest ? Yii::$app->request->getUrl() : null;
                        return sprintf('[%s][%s]', Yii::$app->id, $url);
                    },
                    'logVars' => [],
                    'logTable' => '{{%system_log}}',
                ],
            ],
        ],

        'i18n' => [
            'translations' => [
                'app' => [
                    'class' => yii\i18n\PhpMessageSource::class,
                    'basePath' => '@common/messages',
                ],
                '*' => [
                    'class' => yii\i18n\PhpMessageSource::class,
                    'basePath' => '@common/messages',
                    'fileMap' => [
                        'common' => 'common.php',
                        'backend' => 'backend.php',
                        'frontend' => 'frontend.php',
                    ],
                    'on missingTranslation' => [backend\modules\translation\Module::class, 'missingTranslation'],
                ],
                //  Uncomment this code to use DbMessageSource
                //                 '*'=> [
                //                    'class' => 'yii\i18n\DbMessageSource',
                //                    'sourceMessageTable'=>'{{%i18n_source_message}}',
                //                    'messageTable'=>'{{%i18n_message}}',
                //                    'enableCaching' => YII_ENV_DEV,
                //                    'cachingDuration' => 3600,
                //                    'on missingTranslation' => ['\backend\modules\translation\Module', 'missingTranslation']
                //                ],

            ],
        ],

        'fileStorage' => [
            'class' => trntv\filekit\Storage::class,
            'baseUrl' => '@storageUrl/source',
            'filesystem' => [
                'class' => common\components\filesystem\LocalFlysystemBuilder::class,
                'path' => '@storage/web/source',
            ],
            'as log' => [
                'class' => common\behaviors\FileStorageLogBehavior::class,
                'component' => 'fileStorage',
            ],
        ],

        'keyStorage' => [
            'class' => common\components\keyStorage\KeyStorage::class,
        ],

        'urlManagerBackend' => \yii\helpers\ArrayHelper::merge(
            [
                'hostInfo' => env('BACKEND_HOST_INFO'),
                'baseUrl' => env('BACKEND_BASE_URL'),
            ],
            require (Yii::getAlias('@backend/config/_urlManager.php'))
        ),
//        'urlManagerFrontend' => \yii\helpers\ArrayHelper::merge(
        //            [
        //                'hostInfo' => env('FRONTEND_HOST_INFO'),
        //                'baseUrl' => env('FRONTEND_BASE_URL'),
        //            ],
        //            require(Yii::getAlias('@frontend/config/_urlManager.php'))
        //        ),
        'urlManagerStorage' => \yii\helpers\ArrayHelper::merge(
            [
                'hostInfo' => env('STORAGE_HOST_INFO'),
                'baseUrl' => env('STORAGE_BASE_URL'),
            ],
            require (Yii::getAlias('@storage/config/_urlManager.php'))
        ),

        'queue' => [
            'class' => \yii\queue\file\Queue::class,
            'path' => '@common/runtime/queue',
        ],
    ],
    'params' => [
        'adminEmail' => env('ADMIN_EMAIL'),
        'robotEmail' => env('ROBOT_EMAIL'),
        'availableLocales' => [
            'en-US' => 'English',
            'ar-AR' => 'Arabic',

        ],
        'mlConfig' => [
            'default_language' => 'en',
            'languages' => [
                'en' => 'English',
                'ar' => 'عربى',
            ],
        ],
    ],
];

// always send emails

$config['components']['mailer']['transport'] = [
    'class' => 'Swift_SmtpTransport',
    'host' => env('SMTP_HOST'),
    'port' => env('SMTP_PORT'),
    'username' => env('SMTP_USER'),
    'password' => env('SMTP_PASS'),
    'encryption' => env('SMTP_ENC'),
];

//alwys log email warning
//$config['components']['log']['targets']['email'] = [
//    'class' => yii\log\EmailTarget::class,
//    'except' => ['yii\web\HttpException:*'],
//    'levels' => ['error', 'warning'],
//    'message' => ['from' => env('ROBOT_EMAIL'), 'to' => env('ADMIN_EMAIL')]
//];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => yii\gii\Module::class,
    ];

    $config['components']['cache'] = [
        'class' => yii\caching\DummyCache::class,
    ];

}

return $config;

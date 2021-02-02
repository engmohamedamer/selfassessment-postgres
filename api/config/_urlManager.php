<?php
return [
    //'class' => 'yii\web\UrlManager',
    'enablePrettyUrl' => true,
    'enableStrictParsing' => true,
    'showScriptName' => false,
    'rules' => [

        ['class' =>'yii\rest\UrlRule',
            'controller'=>'posts',
            'only'=>['index','view','create','update','delete','options'],//'update',
            'extraPatterns'=>[
                'GET ' => 'index' ,
                'GET <id>' => 'view' ,
                'PUT ' => 'update',
            ],
        ],


        ['pattern' => '/', 'route' => 'site/index'],
        ['pattern' => '/site', 'route' => 'site/index'],
        ['pattern' => '/site/index', 'route' => 'site/index'],
        ['pattern' => '/report/<token>', 'route' => 'report/view'],
        ['pattern' => '/login', 'route' => 'user/login'],
        ['pattern' => '/signup', 'route' => 'user/signup'],
        ['pattern' => '/sectors', 'route' => 'user/sectors'],
        ['pattern' => '/change-token/<code>', 'route' => 'auth/change-token'],
        ['pattern' => '/reset-password', 'route' => 'user/reset-password'],
        ['pattern' => '/request-reset-password', 'route' => 'user/request-reset-password'],
        ['pattern' => '/theme', 'route' => 'theme/index'],
        ['pattern' => '/theme/<slug>/<lang>', 'route' => 'theme/index'],
        ['pattern' => '/assessments/report/<id>', 'route' => 'assessments/report'],
        ['pattern' => '/assessments/report-token/<id>', 'route' => 'assessments/report-token'],
        ['pattern' => '/assessments/report-questions/<id>', 'route' => 'assessments/report-questions'],
        ['pattern' => '/assessments/completed', 'route' => 'assessments/completed'],
        ['pattern' => '/assessments/not-complete', 'route' => 'assessments/not-complete'],
        ['pattern' => '/assessments/custom-report/<id>/<user_id>', 'route' => 'assessments/custom-report'],
        ['pattern' => '/assessments/survey-start/<surveyId>', 'route' => 'assessments/survey-start'],
        ['pattern' => '/media/upload', 'route' => 'media/upload'],
        ['pattern' => '/media/delete', 'route' => 'media/delete'],

        // ['pattern' => '/notification', 'route' => 'notification/index'],

        ['class' =>'yii\rest\UrlRule','controller'=>'auth'
            ,'only'=>['index','change-token','options']
            ,'extraPatterns'=>[
            'GET  index' => 'index',
            'GET change-token/<code>'=>'change-token',

        ]
            , 'pluralize'=>false
        ],

        ['class' =>'yii\rest\UrlRule','controller'=>'user'
            ,'only'=>['login','signup','reset-password','request-reset-password','sectors','options']
            ,'extraPatterns'=>[
                'POST  signup' => 'signup',
                'GET  sectors' => 'sectors',
                'POST login' => 'login',
                'POST reset-password'=>'reset-password',
                'POST request-reset-password'=>'request-reset-password',

            ]
            , 'pluralize'=>false
        ],
//

        ['class' =>'yii\rest\UrlRule',
            'controller'=>'assessments',
            'only'=>['index','view','update','delete-file','report','survey-start','custom-report','completed','not-complete','report-questions','report-token','options'],//'update',
            'extraPatterns'=>[
                'GET ' => 'index' ,
                'GET completed' => 'completed' ,
                'GET not-complete' => 'not-complete' ,
                'GET <id>' => 'view' ,
                'GET report-questions/<id>' => 'report-questions' ,
                'GET report/<id>' => 'report' ,
                'GET report-token/<id>' => 'report-token' ,
                'GET custom-report/<id>/<user_id>' => 'custom-report' ,
                'GET survey-start/<surveyId>' => 'survey-start',
                'PUT ' => 'update',
                'DELETE delete-file' => 'delete-file',
            ],
            'pluralize'=>false
        ],

        ['class' =>'yii\rest\UrlRule',
            'controller'=>'media',
            'only'=>['create','delete','upload','options'],//'update',
            'extraPatterns'=>[
                'POST ' => 'create' ,
                'POST upload' => 'upload' ,
                'DELETE delete-file' => 'delete-file',
                'DELETE' => 'delete',
            ],
            'pluralize'=>false
        ],

        ['class' =>'yii\rest\UrlRule',
            'controller'=>'notification',
            'only'=>['index','options'],
            'extraPatterns'=>[
                'GET ' => 'index' ,
            ],
            'pluralize'=>false
        ],


        ['class' =>'yii\rest\UrlRule',
            'controller'=>'profile',
            'only'=>['index','update','options'],
            'extraPatterns'=>[
                'GET ' => 'index' ,
                'PUT ' => 'update',
            ],
            'pluralize'=>false
        ],

        ['class' =>'yii\rest\UrlRule',
            'controller'=>'theme',
            'only'=>['index'],
            'extraPatterns'=>[
                'GET ' => 'index'
            ],
            'pluralize'=>false
        ],

        ['class' =>'yii\rest\UrlRule',
            'controller'=>'report',
            'only'=>['view'],
            'extraPatterns'=>[
                'GET view/<token>' => 'view'
            ],
            'pluralize'=>false
        ],


        ['class' => 'yii\rest\UrlRule', 'controller' => 'lookups' ,'pluralize'=>false ,
            'only' => ['list-cities','list-districts'],

            'extraPatterns'=>[
                'GET list-cities' => 'list-cities',
                'GET list-districts' => 'list-districts',

            ]

        ],




    ]
];

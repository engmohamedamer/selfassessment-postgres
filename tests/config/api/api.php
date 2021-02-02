<?php

return yii\helpers\ArrayHelper::merge(
//require dirname(dirname(__DIR__)) . '/common/config/codeception-local.php',
//require __DIR__ . '/main.php',
    require YII_APP_BASE_PATH  . '/common/config/base.php',
    require  YII_APP_BASE_PATH  . '/api/config/web.php',
    require  YII_APP_BASE_PATH  . '/api/config/base.php',
    require(dirname(__DIR__) . '/base.php'),

    [
    ]
);

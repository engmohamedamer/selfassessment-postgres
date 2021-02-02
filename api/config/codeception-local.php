<?php

return yii\helpers\ArrayHelper::merge(
    //require dirname(dirname(__DIR__)) . '/common/config/codeception-local.php',
    //require __DIR__ . '/main.php',
require dirname(dirname(__DIR__)) . '/common/config/base.php',
require __DIR__ . '/web.php',
     require __DIR__ . '/base.php',
    require dirname(dirname(__DIR__)) . '/common/config/test-local.php',

    [
    ]
);

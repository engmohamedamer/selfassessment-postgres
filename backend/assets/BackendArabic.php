<?php

namespace backend\assets;

use common\assets\AdminLte;
use yii\web\AssetBundle;
use yii\web\YiiAsset;

class BackendArabic extends AssetBundle
{
    /**
     * @var string
     */
    public $basePath = '@webroot';
    /**
     * @var string
     */
    public $baseUrl = '@web';

    /**
     * @var array
     */
    public $css = [
        'css/rtl/AdminLTE-RTL.css', 
        'css/rtl/bootstrap-arabic.css', 
        'http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css',
        'https://fonts.googleapis.com/css?family=Cairo:400,600,700,900&display=swap&subset=arabic',
        'css/custom.css',
        'css/rtl/custom.css',

    ];
    /**
     * @var array
     */
    public $js = [
        'js/app.js',
        'https://kit.fontawesome.com/7bdd7e5637.js',
        //'js/adminlte.js'
    ];

    /**
     * @var array
     */
    public $depends = [
        YiiAsset::class,
        AdminLte::class,
    ];
}

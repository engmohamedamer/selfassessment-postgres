<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/3/14
 * Time: 3:14 PM
 */

namespace backend\assets;

use yii\bootstrap\BootstrapPluginAsset;
use yii\web\AssetBundle;
use yii\web\YiiAsset;

class BackendBaseAsset extends AssetBundle
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
        // 'css/style.css'
        'http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css',
        'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700',
        'css/custom.css',

    ];
    /**
     * @var array
     */
    public $js = [
        //'js/app.js'
        'https://kit.fontawesome.com/7bdd7e5637.js'
    ];

    /**
     * @var array
     */
    public $depends = [
        BootstrapPluginAsset::class,
        YiiAsset::class
    ];
}

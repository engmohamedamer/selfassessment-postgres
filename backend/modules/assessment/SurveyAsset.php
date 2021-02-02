<?php
/**
 * Created by PhpStorm.
 * User: kozhevnikov
 * Date: 05/10/2017
 * Time: 14:18
 */

namespace backend\modules\assessment;


use yii\web\AssetBundle;

class SurveyAsset extends AssetBundle
{

    public function init()
    {
        $this->sourcePath = __DIR__ . '/assets';
        parent::init();
    }

    public $publishOptions = [
        'forceCopy' => YII_ENV_DEV //dev
    ];

    public $css = [
        'css/survey.css',
        'css/preloader.css',
        "https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css",
        "https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css",
    ];
    public $js = [
        'js/survey.js',
        "https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js",
        "https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js",
        'js/html2canvas.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}

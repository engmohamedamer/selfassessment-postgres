<?php
/**
 * Created by PhpStorm.
 * User: kozhevnikov
 * Date: 05/10/2017
 * Time: 14:18
 */

namespace backend\modules\assessment;


use yii\web\AssetBundle;

class ReportComponentAR extends AssetBundle
{

    public function init()
    {
        $this->sourcePath = __DIR__ . '/assets';
        parent::init();
    }

    public $publishOptions = [
        'forceCopy' => YII_ENV_DEV //dev
    ];

    public $js = [
        'js/AssesReportAR.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}

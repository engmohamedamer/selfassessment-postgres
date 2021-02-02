<?php

namespace backend\modules\assessment;

use backend\modules\assessment\ReportComponentAR;
use backend\modules\assessment\ReportComponentEN;
use yii\base\UserException;
use yii\helpers\FileHelper;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;

/**
 * survey module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
  //  public $controllerNamespace;
    public $controllerNamespace = 'backend\modules\assessment\controllers';

    public $userClass;

    public $params = [
        'uploadsUrl' => 'http://storage.selfassest.localhost/source/survey/',
        'uploadsPath' => null,
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {

       // $this->layout = '//baselayout';



//        if (empty($this->controllerNamespace)) {
//            $this->controllerNamespace = \Yii::$app->controllerNamespace === 'backend\controllers'
//                ? 'backend\modules\assessment\controllers'
//                : 'backend\modules\assessment\widgetControllers';
//        }

        parent::init();

        if (empty($this->params['uploadsUrl'])) {
            throw new UserException("You must set uploadsUrl param in the config. Please see the documentation for more information.");
        } else {
            $this->params['uploadsUrl'] = rtrim($this->params['uploadsUrl'], '/');
        }

        if (empty($this->params['uploadsPath'])) {
            throw new UserException("You must set uploadsPath param in the config. Please see the documentation for more information.");
        } else {
            $this->params['uploadsPath'] = FileHelper::normalizePath($this->params['uploadsPath']);
        }

        //echo $this->params['uploadsUrl'];die;
        $this->userClass = \Yii::$app->user->identityClass;

        \Yii::setAlias('@surveyRoot', __DIR__);

        // set up i8n
        if (empty(\Yii::$app->i18n->translations['survey'])) {
            \Yii::$app->i18n->translations['survey'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@surveyRoot/messages',
            ];
            \Yii::$app->i18n->translations['kveditable'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@surveyRoot/messages',
            ];
        }

        $view = \Yii::$app->getView();
        SurveyAsset::register($view);
        
        if(\Yii::$app->user->identity->userProfile->locale == 'en-US') {
            ReportComponentEN::register($view);
        }else{
            ReportComponentAR::register($view);
        }
    }
}

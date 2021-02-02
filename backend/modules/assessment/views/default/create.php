<?php
/**
 * Created by PhpStorm.
 * User: kozhevnikov
 * Date: 05/10/2017
 * Time: 14:24
 */

use kartik\editable\Editable;
use kartik\helpers\Html;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $survey \backend\modules\assessment\models\Survey */
/* @var $withUserSearch boolean */

$this->title = Yii::t('survey', 'Create new assessment');


echo $this->render('_form', [
	'survey' => $survey,
	'withUserSearch' => $withUserSearch
]);


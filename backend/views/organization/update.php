<?php

use common\widgets\OrganizationForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Organization */

$this->title = Yii::t('common', 'Update') . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Organization'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Update');
?>


<?= OrganizationForm::widget(['model' => $model,
	'theme'=> $theme,
    'themeFooterLinks'=> $themeFooterLinks
]) ?>


<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\District */

$this->title = Yii::t('backend', 'Save As New {modelClass}: ', [
    'modelClass' => 'District',
]). ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Districts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Save As New');
?>
<div class="district-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\District */

$this->title = Yii::t('backend', 'Create District');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Districts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="district-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

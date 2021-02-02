<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $node backend\models\Tree */

?>

<div class="tree-form">

    <?= $form->field($node, 'child_allowed')->checkbox() ?>


</div>

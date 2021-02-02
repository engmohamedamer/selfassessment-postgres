<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use backend\models\Tree;
use kartik\tree\TreeView;
use kartik\tree\Module;
use yii\web\View;


$this->title = Yii::t('backend', 'Tree');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tree-index">

    <!-- <h1><?=Html::encode($this->title) ?></h1> -->

    <?php
    echo TreeView::widget([
        'query' => Tree::find()->addOrderBy('root, lft'),
        'headingOptions' => ['label' => Yii::t('backend', 'Tree')],
        'rootOptions' => ['label' => '<span class="text-primary">Root</span>'],
        'fontAwesome' => false,
        'isAdmin' => true, // @TODO : put your isAdmin getter here
        'displayValue' => 0,
        'cacheSettings' => ['enableCache' => true],
        'nodeAddlViews' => [
            Module::VIEW_PART_2 => '@backend/views/tree/_form'
        ]
    ]);
    ?>

</div>

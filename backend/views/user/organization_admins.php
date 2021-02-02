<?php

use common\grid\EnumColumn;
use common\models\User;
use trntv\yii\datetime\DateTimeWidget;
use yii\helpers\Html;
use kartik\grid\GridView;


use yii\web\JsExpression;


$url=\yii\helpers\Url::to(['/helper/users-list']);

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Organization Admins') . $organization->name ;
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- Content Header (Page header) -->
<div class="content-header">
                <div>
                <div class="">
                    <h1><?= Yii::t('backend', 'Organization Admins') .' - ' . $organization->name ?></h1>
                </div>
                <div class=" actionBtns">
                    <a href="/user/create-organization-admin?organization_id=<?=$organization->id ?>" class="btn btn-success"><i class="icofont-plus mr-2 ml-2"></i> <?= Yii::t('backend','Create New Organization Admin') ?></a>

                </div>
                </div>
                <!-- /.col -->
            </div>
<!-- /.content-header -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">


            <div class="card-body">
            <?php
                $gridColumns=[
                    ['class' => 'yii\grid\SerialColumn'],

                    [
                        'header'=> Yii::t('backend', 'Adminstrator Name') ,
                        'attribute' => 'SearchFullName',
                        'format'    => 'raw',
                        'value'     => function ($model) {
                            return Html::a( $model->userProfile['fullName'], ['/user/view?id='.$model->id]) ;
                        },
                        'filterType'=>GridView::FILTER_SELECT2,
                        'filter'=>'',
                        'filterWidgetOptions'=>[
                            'pluginOptions'=>[
                                'allowClear'=>true,
                                'ajax' => [
                                    'url' => $url,
                                    'dataType' => 'json',
                                    'data' => new JsExpression('function(params) { return {q:params.term}; }')
                                ],
                                'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                                'templateResult' => new JsExpression('function(owner) { return owner.text; }'),
                                'templateSelection' => new JsExpression('function (owner) { return owner.text; }'),
                            ],

                        ],
                        'filterInputOptions'=>['placeholder'=>Yii::t('common', 'Search')],

                    ],

                    [
                        'attribute' => 'email',
                        'format' => 'email',
                        'filterInputOptions' => [
                            'class'       => 'form-control',
                            'placeholder' => Yii::t('common','Search')
                        ]
                    ],
                    [
                        'class' => EnumColumn::class,
                        'attribute' => 'status',
                        'enum' => User::statuses(),
                        'filter' => User::statuses()
                    ],
                    [
                        'attribute' => 'updated_at',
                        'format' => 'datetime',
                    ],
                    [
                        'attribute' => 'logged_at',
                        'format' => 'datetime',
                    ],
                    [
                        'class' => 'kartik\grid\ActionColumn',
                        'width'=>'20%'

                    ],
                ];

                echo GridView::widget([
                    'id' => 'kv-grid-demo',
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => $gridColumns, // check the configuration for grid columns by clicking button above

                ]);
            ?>
            </div>
        </div>
    </div>
</div>

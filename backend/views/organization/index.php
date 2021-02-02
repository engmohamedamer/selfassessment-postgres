<?php

/* @var $this yii\web\View */
/* @var $searchModel common\models\OrganizationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::t('common', 'Organizations');
$this->params['breadcrumbs'][] = $this->title;




?>
<style>
.table-responsive {
    min-height: 0.01%;
    overflow-x: hidden;
}
</style>


<!-- Content Header (Page header) -->
<div class="content-header">
    <div>
        <div class="">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>

        <div class=" actionBtns">
            <a href="/organization/create" class="btn btn-success"><i class="icofont-plus"></i> <?= Yii::t('common', 'Create Organization') ?></a>
            <!-- <a href="#" class="btn btn-info search-button"><span><i class="fa fa-filter mr-2 ml-2" aria-hidden="true"></i> تخصيص </span></a> -->
            <a data-toggle="collapse" href="#filterCollapse" role="button" aria-expanded="false" aria-controls="filterCollapse" class="btn btn-info"><span><i class="fa fa-filter mr-2 ml-2"></i> <?= \Yii::t('common', 'Filter Options')?> </span></a>

        </div>

    </div>
</div>
<!-- /.content-header -->
<div class="collapse <?php if(isset($_GET["OrganizationSearch"]['from']) || isset($_GET["OrganizationSearch"]['to'])) echo 'in' ;?>" id="filterCollapse">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-filter fa-xs"></i> <?= \Yii::t('common', 'Filter')?></h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <?=  $this->render('_search', ['model' => $searchModel]); ?>

                </div>
            </div>

        </div>
    </div>

<div class="row">

    <div class="col-lg-12">
        <div class="card">


            <div class="card-body">

    <?php
    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'header'=> Yii::t('backend','Organization Name'),
            'attribute' => 'name',
            'value'=>function ($model) {
                return Html::a( $model->name, ['/organization/view?id='.$model->id]) ;
            },
            'format' => 'raw',
            'filterInputOptions' => [
                'class'       => 'form-control',
                'placeholder' => Yii::t('common','Search')
             ]
        ],
        [
            'label' => Yii::t('common', 'Organization Manager'),
            'attribute' => 'manager',
            'value'=>function ($model) {

                return  ' <a href="/user/organization-admins?organization_id='.$model->id.'">'.Yii::t('common', 'Organization Manager').'</a> ' ;
                // return  ' <a data-src="/organization/manager?id='.$model->manager->user_id.'" data-fancybox data-type="iframe" href="javascript:;" >'.$model->manager->firstname.'</a> ' ;
            },
            'format' => 'raw',
        ],
        [
            'attribute' => 'subdomain',
            'value'=>function ($model) {
                $link = 'http://'.str_ireplace('backend','',$model->slug.$_SERVER['SERVER_NAME']);
                    return Html::a($model->slug, $link, [
                        'title' => Yii::t('common', 'Organization Link'),
                        'target'=>'_blank'
                    ]); 
            },
            'format' => 'raw',
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
            'attribute' => 'phone',
            'filterInputOptions' => [
                'class'       => 'form-control',
                'placeholder' => Yii::t('common','Search')
             ]
        ],
        // [
        //     'attribute' => 'conatct_name',
        //     'filterInputOptions' => [
        //         'class'       => 'form-control',
        //         'placeholder' => Yii::t('common','Search')
        //      ]
        // ],
        // [
        //     'attribute' => 'contact_phone',
        //     'filterInputOptions' => [
        //         'class'       => 'form-control',
        //         'placeholder' => Yii::t('common','Search')
        //      ]
        // ],
        [
            'attribute' => 'created_at',
            'value'=>function ($model) {
                return  date('Y-m-d',$model->created_at);
            },
        ],
        [
            'class' => 'kartik\grid\ActionColumn',
            'template'=>'{view}{update}{link}',
            'buttons'=>[
              'link' => function ($url, $model) {  
                    $link = 'http://'.str_ireplace('backend','',$model->slug.$_SERVER['SERVER_NAME']);
                    return Html::a("<i class='fas fa-link'></i>", $link, [
                        'title' => Yii::t('common', 'Organization Link'),
                        'target'=>'_blank'
                    ]); 
              }
            ],
            'width'=>'15%'
        ],
    ];
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumn,
        'pjax' => false,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-organization']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
        ],
        'export' => false,
        // your toolbar can include the additional full export menu
        'toolbar' => [
            '{export}',
            ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $gridColumn,
                'target' => ExportMenu::TARGET_BLANK,
                'fontAwesome' => true,
                'dropdownOptions' => [
                    'label' => Yii::t('backend','Full'),
                    'class' => 'btn btn-default',
                    'itemsBefore' => [
                        '<li class="dropdown-header">'. Yii::t('backend','Export All Data') .'</li>',
                    ],
                ],
                'exportConfig' => [
                    ExportMenu::FORMAT_PDF => false
                ]
            ]) ,
        ],
    ]); ?>

</div>
            </div>
            </div>
            </div>

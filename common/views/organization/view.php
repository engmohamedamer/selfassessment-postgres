<?php

use common\models\User;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Organization */
?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div>
        <div class="">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class=" actionBtns">
            <a href="/organization/update?id=<?= $model->id ?>" class="btn btn-success"><i class="icofont-ui-edit"></i> <?= Yii::t('backend','Update Data') ?> </a>

        </div>
    </div>
    <!-- /.col -->
</div>
<!-- /.content-header -->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            
            <div class="card-body">
                <ul class="nav nav-pills innernavs">
                        <li class="nav-item active"><a class="nav-link " href="#tab1" data-toggle="tab" aria-expanded="true"><?php echo Yii::t('backend', 'Main Details') ?></a></li>
                        <li class="nav-item"><a class="nav-link" href="#tab2" data-toggle="tab" aria-expanded="false"> <?php echo Yii::t('common', 'Contact Details') ?></a></li>
                        <li class="nav-item"><a class="nav-link" href="#tab3" data-toggle="tab" aria-expanded="false"> <?php echo Yii::t('common', 'Organization Admin') ?> </a></li>
                        <li class="nav-item"><a class="nav-link" href="#tab4" data-toggle="tab" aria-expanded="false"> <?php echo Yii::t('common', 'Footer Links') ?> </a></li>
                        <li class="nav-item"><a class="nav-link" href="#tab5" data-toggle="tab" aria-expanded="false"> <?php echo Yii::t('common', 'Socail Links') ?> </a></li>
                        <li class="nav-item"><a class="nav-link" href="#tab6" data-toggle="tab" aria-expanded="false"> <?php echo Yii::t('common', 'Organization Theme') ?></a></li>
                        <li class="nav-item"><a class="nav-link" href="#tab7" data-toggle="tab" aria-expanded="false"> <?php echo Yii::t('common', 'Login Settings') ?></a></li>

                </ul>
                <div class="tab-content mt-2">
                    <div class="tab-pane active" id="tab1">
                        <div class="row">
                            

                            <div class="col-md-12">
                            <?php 
                                $gridColumn = [
                                    'id',
                                    'name',
                                    'slug',
                                    'business_sector',
                                    'address',
                                    [
                                        'attribute'=>Yii::t('common','City'),
                                        'value'=>function($model){
                                            return $model->city->title;
                                        },
                                        'format'=>'raw'
                                    ],
                                    [
                                        'attribute'=>Yii::t('common','District'),
                                        'value'=>function($model){
                                            return $model->district->title;
                                        },
                                    ],
                                    'about',
                                    'postalcode',
                                    'postalbox',
                                    'limit_account',
                                    [
                                        'attribute'=>Yii::t('common','Locale'),
                                        'value'=>function($model){
                                            return $model->organizationTheme->locale;
                                        },
                                    ],
                                ];
                                echo DetailView::widget([
                                    'model' => $model,
                                    'attributes' => $gridColumn

                                ]);
                            ?>
                            </div>
                        </div>

                           
                       
                    </div>
                    <div class="tab-pane" id="tab2">
                        <div class="row">
                            

                            <div class="col-md-12">
                            <?php 
                                $gridColumn = [
                                    'email:email',
                                    'phone',
                                    'mobile',
                                    'conatct_name',
                                    'contact_email:email',
                                    'contact_phone',
                                    'contact_position',
                                ];
                                echo DetailView::widget([
                                    'model' => $model,
                                    'attributes' => $gridColumn

                                ]);
                            ?>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab3">
                        <?php 
                            $gridColumn = [
                                'user_id',
                                'firstname',
                                'lastname',
                                'user.email',
                                'mobile',
                                // [
                                //     'attribute'=>Yii::t('common','Status'),
                                //     'value'=>function($model){
                                //         return User::statuses()[$model->user->status];
                                //     }
                                // ],
                            ];
                            if ($model->manager) {
                                echo DetailView::widget([
                                    'model' => $model->manager,
                                    'attributes' => $gridColumn
                                ]);
                            }
                        ?>
                    </div>
                    <div class="tab-pane" id="tab4">
                       <?php 
                            $organizationFooterLinks = [
                                [
                                    'attribute'=>'link1',
                                    'value'=>function($model){
                                        if ($model->link1) {
                                         return $model->name_link1 . ' ( '. $model->link1 .' )';
                                        }
                                    },
                                    'format'=>'url'
                                ],
                                [
                                    'attribute'=>'link2',
                                    'value'=>function($model){
                                        if ($model->link2) {
                                         return $model->name_link2 . ' ( '. $model->link2 .' )';
                                        }
                                    },
                                    'format'=>'url'
                                ],
                                [
                                    'attribute'=>'link3',
                                    'value'=>function($model){
                                        if ($model->link3) {
                                         return $model->name_link3 . ' ( '. $model->link3 .' )';
                                        }
                                    },
                                    'format'=>'url'
                                ],
                                [
                                    'attribute'=>'link4',
                                    'value'=>function($model){
                                        if ($model->link4) {
                                         return $model->name_link4 . ' ( '. $model->link4 .' )';
                                        }
                                    },
                                    'format'=>'url'
                                ],
                                [
                                    'attribute'=>'link5',
                                    'value'=>function($model){
                                        if ($model->link5) {
                                         return $model->name_link5 . ' ( '. $model->link5 .' )';
                                        }
                                    },
                                    'format'=>'url'
                                ],
                            ];
                            echo DetailView::widget([
                                'model' => $model->organizationFooterLinks,
                                'attributes' => $organizationFooterLinks
                            ]);
                        ?>
                    </div>
                    <div class="tab-pane" id="tab5">
                       <?php 
                            $organizationTheme = [
                                'facebook:url',
                                'twitter:url',
                                'linkedin:url',
                                'instagram:url',
                            ];
                            echo DetailView::widget([
                                'model' => $model->organizationTheme,
                                'attributes' => $organizationTheme
                            ]);
                        ?>
                    </div>

                    <div class="tab-pane" id="tab6">

                        <div class="col-md-3">
                            <p>
                            <label><?= Yii::t('common','Logo Image') ?></label>
                            </p>
                            <img src='<?= $model->first_image_base_url.$model->first_image_path ?>' alt="..." class="img-thumbnail" />
                            
                            <p class="mt-2">
                            <label><?= Yii::t('common','Logo Icon Image') ?></label>
                            </p>
                            <img src='<?= $model->second_image_base_url.$model->second_image_path ?>' alt="..." class="img-thumbnail" />
                        </div>
                        <div class="col-md-9" style="padding-top:35px">
                           
                            
                            <?php 
                                $organizationTheme = [
                                    [
                                        'attribute'=>'brandPrimColor',
                                        'value'=>function($model){
                                            return "<div style='width: 100px;height: 30px;background: ".$model->brandPrimColor.";margin: 0 10px;'></div>" . $model->brandPrimColor;
                                        },
                                        'format'=>'raw'
                                    ],
                                    [
                                        'attribute'=>'brandSecColor',
                                        'value'=>function($model){
                                            return "<div style='width: 100px;height: 30px;background: ".$model->brandSecColor.";margin: 0 10px;'></div>" . $model->brandSecColor;
                                        },
                                        'format'=>'raw'
                                    ],
                                ];
                                echo DetailView::widget([
                                    'model' => $model->organizationTheme,
                                    'attributes' => $organizationTheme
                                ]);
                            ?>
                        </div>
                      
                            
                       
                    </div>
                    <div class="tab-pane" id="tab7">

                        <div class="row">
                            

                            <div class="col-md-12">
                            <?php 
                                echo DetailView::widget([
                                    'model' => $model,
                                    'attributes' => [
                                        [
                                            'attribute'=>'sso_login',
                                            'value'=>function($model){
                                                return $model->sso_login ? \Yii::t('common','Active') :  \Yii::t('common','Not Active');
                                            },
                                            'format'=>'raw'
                                        ],
                                        'authServerUrl',
                                        'realm',
                                        'clientId',
                                        'clientSecret',
                                    ]
                                ]);
                            ?>
                            </div>
                        </div>
                            
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

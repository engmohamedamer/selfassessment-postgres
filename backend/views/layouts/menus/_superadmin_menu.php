<?php


use backend\assets\BackendAsset;
use backend\modules\system\models\SystemLog;
use backend\widgets\Menu;
use common\models\TimelineEvent;
use yii\bootstrap\Alert;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\log\Logger;
use yii\widgets\Breadcrumbs;


echo Menu::widget([
    'options' => ['class' => 'sidebar-menu tree', 'data' => ['widget' => 'tree']],
    'linkTemplate' => '<a href="{url}">{icon}<span>{label}</span>{right-icon}{badge}</a>',
    'submenuTemplate' => "\n<ul class=\"treeview-menu\">\n{items}\n</ul>\n",
    'activateParents' => true,
    'items' => [
        [
            'label' => Yii::t('backend', 'Main'),
            'options' => ['class' => 'header'],
        ],
        [
            'label' => Yii::t('backend', 'Timeline'),
            'icon' => '<i class="fa fa-bar-chart-o"></i>',
            'url' => ['/timeline-event/index'],
            'badge' => TimelineEvent::find()->today()->count(),
            'badgeBgClass' => 'label-success',
        ],


        [
            'label' => Yii::t('backend', 'Users'),
            'url' => '#',
            'icon' => '<i class="fa fa-users"></i>',
            'options' => ['class' => 'treeview'],
            'active' => (Yii::$app->controller->module->id == 'user'),
            'items' => [

                [
                    'label' => Yii::t('backend', 'Managers'),
                    'icon' => '<i class="fa fa-users"></i>',
                    'url' => ['/user/index?user_role=manager'],
                    'active' => (Yii::$app->controller->id == 'user'),
                    'visible' => (Yii::$app->user->can('administrator') or  Yii::$app->user->can('manager') ),
                ],


                [
                    'label' => Yii::t('backend', 'National Education office official'),
                    'icon' => '<i class="fa fa-users"></i>',
                    'url' => ['/user/index?user_role=officialNEoffice'],
                    'active' => (Yii::$app->controller->id == 'user'),
                    'visible' => (Yii::$app->user->can('administrator') or  Yii::$app->user->can('manager') ),
                ],






            ],
        ],



        [
            'label' => Yii::t('backend', 'Content'),
            'options' => ['class' => 'header'],
        ],
        [
            'label' => Yii::t('backend', 'Static pages'),
            'url' => ['/content/page/index'],
            'icon' => '<i class="fa fa-thumb-tack"></i>',
            'active' => Yii::$app->controller->id === 'page',
        ],
        [
            'label' => Yii::t('backend', 'Articles'),
            'url' => '#',
            'icon' => '<i class="fa fa-files-o"></i>',
            'options' => ['class' => 'treeview'],
            'active' => 'content' === Yii::$app->controller->module->id &&
                ('article' === Yii::$app->controller->id || 'category' === Yii::$app->controller->id),
            'items' => [
                [
                    'label' => Yii::t('backend', 'Articles'),
                    'url' => ['/content/article/index'],
                    'icon' => '<i class="fa fa-file-o"></i>',
                    'active' => Yii::$app->controller->id === 'article',
                ],
                [
                    'label' => Yii::t('backend', 'Categories'),
                    'url' => ['/content/category/index'],
                    'icon' => '<i class="fa fa-folder-open-o"></i>',
                    'active' => Yii::$app->controller->id === 'category',
                ],
            ],
        ],
        [
            'label' => Yii::t('backend', 'Widgets'),
            'url' => '#',
            'icon' => '<i class="fa fa-code"></i>',
            'options' => ['class' => 'treeview'],
            'active' => Yii::$app->controller->module->id === 'widget',
            'items' => [
                [
                    'label' => Yii::t('backend', 'Text Blocks'),
                    'url' => ['/widget/text/index'],
                    'icon' => '<i class="fa fa-circle-o"></i>',
                    'active' => Yii::$app->controller->id === 'text',
                ],
                [
                    'label' => Yii::t('backend', 'Menu'),
                    'url' => ['/widget/menu/index'],
                    'icon' => '<i class="fa fa-circle-o"></i>',
                    'active' => Yii::$app->controller->id === 'menu',
                ],
                [
                    'label' => Yii::t('backend', 'Carousel'),
                    'url' => ['/widget/carousel/index'],
                    'icon' => '<i class="fa fa-circle-o"></i>',
                    'active' => in_array(Yii::$app->controller->id, ['carousel', 'carousel-item']),
                ],
            ],
        ],
        [
            'label' => Yii::t('backend', 'Translation'),
            'options' => ['class' => 'header'],
        ],
        [
            'label' => Yii::t('backend', 'Translation'),
            'url' => ['/translation/default/index'],
            'icon' => '<i class="fa fa-language"></i>',
            'active' => (Yii::$app->controller->module->id == 'translation'),
        ],
        [
            'label' => Yii::t('backend', 'System'),
            'options' => ['class' => 'header'],
        ],
        [
            'label' => Yii::t('backend', 'RBAC Rules'),
            'url' => '#',
            'icon' => '<i class="fa fa-flag"></i>',
            'options' => ['class' => 'treeview'],
            'active' => in_array(Yii::$app->controller->id, ['rbac-auth-assignment', 'rbac-auth-item', 'rbac-auth-item-child', 'rbac-auth-rule']),
            'items' => [
                [
                    'label' => Yii::t('backend', 'Auth Assignment'),
                    'url' => ['/rbac/rbac-auth-assignment/index'],
                    'icon' => '<i class="fa fa-circle-o"></i>',
                ],
                [
                    'label' => Yii::t('backend', 'Auth Items'),
                    'url' => ['/rbac/rbac-auth-item/index'],
                    'icon' => '<i class="fa fa-circle-o"></i>',
                ],
                [
                    'label' => Yii::t('backend', 'Auth Item Child'),
                    'url' => ['/rbac/rbac-auth-item-child/index'],
                    'icon' => '<i class="fa fa-circle-o"></i>',
                ],
                [
                    'label' => Yii::t('backend', 'Auth Rules'),
                    'url' => ['/rbac/rbac-auth-rule/index'],
                    'icon' => '<i class="fa fa-circle-o"></i>',
                ],
            ],
        ],
        [
            'label' => Yii::t('backend', 'Files'),
            'url' => '#',
            'icon' => '<i class="fa fa-th-large"></i>',
            'options' => ['class' => 'treeview'],
            'active' => (Yii::$app->controller->module->id == 'file'),
            'items' => [
                [
                    'label' => Yii::t('backend', 'Storage'),
                    'url' => ['/file/storage/index'],
                    'icon' => '<i class="fa fa-database"></i>',
                    'active' => (Yii::$app->controller->id == 'storage'),
                ],
                [
                    'label' => Yii::t('backend', 'Manager'),
                    'url' => ['/file/manager/index'],
                    'icon' => '<i class="fa fa-television"></i>',
                    'active' => (Yii::$app->controller->id == 'manager'),
                ],
            ],
        ],
        [
            'label' => Yii::t('backend', 'Key-Value Storage'),
            'url' => ['/system/key-storage/index'],
            'icon' => '<i class="fa fa-arrows-h"></i>',
            'active' => (Yii::$app->controller->id == 'key-storage'),
        ],
        [
            'label' => Yii::t('backend', 'Cache'),
            'url' => ['/system/cache/index'],
            'icon' => '<i class="fa fa-refresh"></i>',
        ],
        [
            'label' => Yii::t('backend', 'System Information'),
            'url' => ['/system/information/index'],
            'icon' => '<i class="fa fa-dashboard"></i>',
        ],
        [
            'label' => Yii::t('backend', 'Logs'),
            'url' => ['/system/log/index'],
            'icon' => '<i class="fa fa-warning"></i>',
            'badge' => SystemLog::find()->count(),
            'badgeBgClass' => 'label-danger',
        ],
        [
            'label' => Yii::t('backend', 'Message'),
            'url' => ['/message/index'],
            'icon' => '<i class="fa fa-envelope"></i>',
            'active' => Yii::$app->controller->id === 'message',
        ],
    ],
]) ?>

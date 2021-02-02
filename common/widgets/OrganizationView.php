<?php

namespace common\widgets;

use Yii;
use yii\base\Widget;

/**
 * Class DbText
 * Return a text block content stored in db
 * @package common\widgets\text
 */
class OrganizationView extends Widget
{
    public $model;
    
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return $this->render('@common/views/organization/view', [
           'model' => $this->model,
        ]);
    }
}

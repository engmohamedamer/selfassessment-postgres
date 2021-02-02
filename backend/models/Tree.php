<?php

namespace backend\models;

use Yii;
use \backend\models\base\Tree as BaseTree;

/**
 * This is the model class for table "tree".
 */
class Tree extends BaseTree
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['root', 'lft', 'rgt', 'lvl'], 'integer'],
            [['name'], 'required'],
            [['name'], 'string', 'max' => 60],
            [['icon'], 'string', 'max' => 255],
            [['icon_type', 'active', 'selected', 'disabled', 'readonly', 'visible', 'collapsed', 'movable_u', 'movable_d', 'movable_l', 'movable_r', 'removable', 'removable_all', 'child_allowed'], 'string', 'max' => 1]
        ]);
    }
	
}

<?php

namespace backend\models\base;

use Yii;

/**
 * This is the base model class for table "tree".
 *
 * @property integer $id
 * @property integer $root
 * @property integer $lft
 * @property integer $rgt
 * @property integer $lvl
 * @property string $name
 * @property string $icon
 * @property integer $icon_type
 * @property integer $active
 * @property integer $selected
 * @property integer $disabled
 * @property integer $readonly
 * @property integer $visible
 * @property integer $collapsed
 * @property integer $movable_u
 * @property integer $movable_d
 * @property integer $movable_l
 * @property integer $movable_r
 * @property integer $removable
 * @property integer $removable_all
 * @property integer $child_allowed
 */
class Tree extends \kartik\tree\models\Tree
{

    private $_rt_softdelete;
    private $_rt_softrestore;

    public function __construct(){
        parent::__construct();
        $this->_rt_softdelete = [
            'deleted_by' => \Yii::$app->user->id,
            'deleted_at' => date('Y-m-d H:i:s'),
        ];
        $this->_rt_softrestore = [
            'deleted_by' => 0,
            'deleted_at' => date('Y-m-d H:i:s'),
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['root', 'lft', 'rgt', 'lvl'], 'integer'],
            [['name'], 'required'],
            [['name'], 'string', 'max' => 60],
            [['icon'], 'string', 'max' => 255],
            [['icon_type', 'active', 'selected', 'disabled', 'readonly', 'visible', 'collapsed', 'movable_u', 'movable_d', 'movable_l', 'movable_r', 'removable', 'removable_all', 'child_allowed'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tree';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'root' => Yii::t('backend', 'Root'),
            'lft' => Yii::t('backend', 'Lft'),
            'rgt' => Yii::t('backend', 'Rgt'),
            'lvl' => Yii::t('backend', 'Lvl'),
            'name' => Yii::t('backend', 'Name'),
            'icon' => Yii::t('backend', 'Icon'),
            'icon_type' => Yii::t('backend', 'Icon Type'),
            'active' => Yii::t('backend', 'Active'),
            'selected' => Yii::t('backend', 'Selected'),
            'disabled' => Yii::t('backend', 'Disabled'),
            'readonly' => Yii::t('backend', 'Readonly'),
            'visible' => Yii::t('backend', 'Visible'),
            'collapsed' => Yii::t('backend', 'Collapsed'),
            'movable_u' => Yii::t('backend', 'Movable U'),
            'movable_d' => Yii::t('backend', 'Movable D'),
            'movable_l' => Yii::t('backend', 'Movable L'),
            'movable_r' => Yii::t('backend', 'Movable R'),
            'removable' => Yii::t('backend', 'Removable'),
            'removable_all' => Yii::t('backend', 'Removable All'),
            'child_allowed' => Yii::t('backend', 'Child Allowed'),
        ];
    }

    /**
     * The following code shows how to apply a default condition for all queries:
     *
     * ```php
     * class Customer extends ActiveRecord
     * {
     *     public static function find()
     *     {
     *         return parent::find()->where(['deleted' => false]);
     *     }
     * }
     *
     * // Use andWhere()/orWhere() to apply the default condition
     * // SELECT FROM customer WHERE `deleted`=:deleted AND age>30
     * $customers = Customer::find()->andWhere('age>30')->all();
     *
     * // Use where() to ignore the default condition
     * // SELECT FROM customer WHERE age>30
     * $customers = Customer::find()->where('age>30')->all();
     * ```
     */

    /**
     * @inheritdoc
     * @return \backend\models\activequery\TreeQuery the active query used by this AR class.
     */
    public static function find()
    {
       return  $query = new \backend\models\activequery\TreeQuery(get_called_class());
        //return $query->where(['tree.deleted_by' => 0]);
    }
}

<?php

namespace common\models\base;

use Yii;

/**
 * This is the base model class for table "organization_structure".
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
class OrganizationStructure extends \kartik\tree\models\Tree
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
          //  [['root', 'lft', 'rgt', 'lvl'], 'integer'],
            [['name'], 'required'],
           [['name'], 'string', 'max' => 60],
           // [['icon'], 'string', 'max' => 255],
            [['root', 'lft', 'rgt', 'lvl','icon_type', 'active', 'icon','selected', 'disabled', 'readonly', 'visible', 'collapsed', 'movable_u', 'movable_d',
                'movable_l', 'movable_r', 'removable', 'removable_all', 'child_allowed','organization_id'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'organization_structure';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'root' => Yii::t('common', 'Root'),
            'lft' => Yii::t('common', 'Lft'),
            'rgt' => Yii::t('common', 'Rgt'),
            'lvl' => Yii::t('common', 'Lvl'),
            'name' => Yii::t('common', 'Name'),
            'icon' => Yii::t('common', 'Icon'),
            'icon_type' => Yii::t('common', 'Icon Type'),
            'active' => Yii::t('common', 'Active'),
            'selected' => Yii::t('common', 'Selected'),
            'disabled' => Yii::t('common', 'Disabled'),
            'readonly' => Yii::t('common', 'Readonly'),
            'visible' => Yii::t('common', 'Visible'),
            'collapsed' => Yii::t('common', 'Collapsed'),
            'movable_u' => Yii::t('common', 'Movable U'),
            'movable_d' => Yii::t('common', 'Movable D'),
            'movable_l' => Yii::t('common', 'Movable L'),
            'movable_r' => Yii::t('common', 'Movable R'),
            'removable' => Yii::t('common', 'Removable'),
            'removable_all' => Yii::t('common', 'Removable All'),
            'child_allowed' => Yii::t('common', 'Child Allowed'),
        ];
    }


    public function getParent()
    {
        return $this->hasOne(OrganizationStructure::class, ['id' => 'lvl']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\OrganizationStructureQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\OrganizationStructureQuery(get_called_class());
    }
}

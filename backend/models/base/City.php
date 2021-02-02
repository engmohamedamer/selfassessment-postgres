<?php

namespace backend\models\base;

use Yii;

/**
 * This is the base model class for table "city".
 *
 * @property integer $id
 * @property string $ref
 * @property string $title
 * @property string $slug
 * @property integer $sort
 *
 * @property \backend\models\District[] $districts
 */
class City extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'districts'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['sort'], 'integer'],
            [['ref', 'title', 'slug'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'ref' => Yii::t('backend', 'Ref'),
            'title' => Yii::t('backend', 'Title'),
            'slug' => Yii::t('backend', 'Slug'),
            'sort' => Yii::t('backend', 'Sort'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistricts()
    {
        return $this->hasMany(\backend\models\District::className(), ['city_id' => 'id']);
    }
    

    /**
     * @inheritdoc
     * @return \backend\models\activequery\CityQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\models\activequery\CityQuery(get_called_class());
    }
}

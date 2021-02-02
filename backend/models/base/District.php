<?php

namespace backend\models\base;

use Yii;

/**
 * This is the base model class for table "district".
 *
 * @property integer $id
 * @property integer $city_id
 * @property string $title
 * @property string $slug
 *
 * @property \backend\models\City $city
 */
class District extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'city',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city_id', 'title'], 'required'],
            [['city_id'], 'integer'],
            [['title', 'slug'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'district';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'city_id' => Yii::t('backend', 'City ID'),
            'title' => Yii::t('backend', 'Title'),
            'slug' => Yii::t('backend', 'Slug'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(\backend\models\City::className(), ['id' => 'city_id']);
    }



    /**
     * @inheritdoc
     * @return \backend\models\activequery\DistrictQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\models\activequery\DistrictQuery(get_called_class());
    }
}

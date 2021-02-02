<?php

namespace common\models\base;

use Yii;

/**
 * This is the base model class for table "translations_with_text".
 *
 * @property integer $id
 * @property string $table_name
 * @property integer $model_id
 * @property string $attribute
 * @property string $lang
 * @property string $value
 */
class TranslationsWithText extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            ''
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['table_name', 'model_id', 'attribute', 'lang', 'value'], 'required'],
            [['model_id'], 'integer'],
            [['value'], 'string'],
            [['table_name', 'attribute'], 'string', 'max' => 100],
            [['lang'], 'string', 'max' => 6]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'translations_with_text';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'table_name' => 'Table Name',
            'model_id' => 'Model ID',
            'attribute' => 'Attribute',
            'lang' => 'Lang',
            'value' => 'Value',
        ];
    }


    /**
     * @inheritdoc
     * @return \common\models\query\TranslationsWithTextQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TranslationsWithTextQuery(get_called_class());
    }
}

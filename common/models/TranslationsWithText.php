<?php

namespace common\models;

use Yii;
use \common\models\base\TranslationsWithText as BaseTranslationsWithText;

/**
 * This is the model class for table "translations_with_text".
 */
class TranslationsWithText extends BaseTranslationsWithText
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['table_name', 'model_id', 'attribute', 'lang', 'value'], 'required'],
            [['model_id'], 'integer'],
            [['value'], 'string'],
            [['table_name', 'attribute'], 'string', 'max' => 100],
            [['lang'], 'string', 'max' => 6]
        ]);
    }
	
}

<?php

namespace backend\models;

use webvimark\behaviors\multilanguage\MultiLanguageBehavior;
use webvimark\behaviors\multilanguage\MultiLanguageTrait;
use Yii;
use \backend\models\base\City as BaseCity;

/**
 * This is the model class for table "city".
 */
class City extends BaseCity
{
    use MultiLanguageTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['title'], 'required'],
            [['sort'], 'integer'],
            [['ref', 'title', 'slug'], 'string', 'max' => 255]
        ]);
    }


    public function behaviors()
    {
        return [

            'mlBehavior'=>[
                'class'    => MultiLanguageBehavior::className(),
                'mlConfig' => [
                    'db_table'         => 'translations_with_text',
                    'attributes'       => ['title','ref'],
                    'admin_routes'     => [
                        'city/create',
                        'city/update',
                        'city/index',
                    ],
                ],
            ],

        ];
    }
	
}

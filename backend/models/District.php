<?php

namespace backend\models;

use Yii;
use \backend\models\base\District as BaseDistrict;

/**
 * This is the model class for table "district".
 */
class District extends BaseDistrict
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['city_id', 'title'], 'required'],
            [['city_id'], 'integer'],
            [['title', 'slug'], 'string', 'max' => 255]
        ]);
    }
	
}

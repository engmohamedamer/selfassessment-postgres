<?php

namespace common\models;

use Yii;
use \common\models\base\FooterLinks as BaseFooterLinks;

/**
 * This is the model class for table "footer_links".
 */
class FooterLinks extends BaseFooterLinks
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['organization_id', 'created_at', 'updated_at'], 'integer'],
            [['link1','link2','link3','link4','link5'],'url', 'defaultScheme' => 'http'],
            [['name_link1', 'name_link2', 'name_link3', 'name_link4', 'name_link5'], 'string', 'max' => 150]
        ]);
    }
	
}

<?php

namespace common\fixtures;
use common\models\FooterLinks;
use yii\test\ActiveFixture;

class OrganizationThemeFooterLinks extends ActiveFixture
{
    public $modelClass = FooterLinks::class;
    public $dataFile = '@tests/_data/organization_footer_links.php';
}

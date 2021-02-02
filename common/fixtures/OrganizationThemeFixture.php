<?php

namespace common\fixtures;

use common\models\OrganizationTheme;
use yii\test\ActiveFixture;

class OrganizationThemeFixture extends ActiveFixture
{
    public $modelClass = OrganizationTheme::class;
    public $dataFile = '@tests/_data/organization_theme.php';
}

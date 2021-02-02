<?php
namespace common\fixtures;

use yii\test\ActiveFixture;

class UserProfileFixture extends ActiveFixture
{
    public $modelClass = 'common\models\UserProfile';
    public $dataFile = '@tests/_data/user_profile.php';
}
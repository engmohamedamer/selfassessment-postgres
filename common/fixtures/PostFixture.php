<?php

namespace common\fixtures;

use yii\test\ActiveFixture;

class PostFixture extends ActiveFixture
{
    public $modelClass = 'api\models\Post';
    public $dataFile = '@tests/_data/post.php';
}

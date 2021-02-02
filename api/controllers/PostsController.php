<?php

namespace api\controllers;

use Yii;
use api\models\Post;
use yii\rest\ActiveController;


/**
 * PostController implements the CRUD actions for Post model.
 */
class PostsController extends ActiveController
{
    public $modelClass = Post::class;
}

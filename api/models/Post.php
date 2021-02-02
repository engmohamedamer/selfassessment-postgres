<?php

namespace api\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property string $title
 * @property string|null $content_markdown
 * @property string|null $content_html
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['text', 'created_at', 'updated_at'], 'string'],
            [['title'], 'string', 'max' => 255],
            ['status', 'safe']
        ];
    }
}


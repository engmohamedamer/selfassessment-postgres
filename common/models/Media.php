<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "media".
 *
 * @property int $id
 * @property string $path
 * @property string $base_url
 * @property string $type
 * @property int $size
 * @property string $name
 * @property int $created_at
 * @property int $user_id
 * @property int $order
 * @property string $meta
 * @property string $deleted_by
 */
class Media extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'media';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['path'], 'required'],
            [['size', 'created_at', 'order','user_id'], 'integer'],
            [['path', 'base_url', 'type', 'name', 'meta', 'deleted_by'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'path' => Yii::t('common', 'Path'),
            'base_url' => Yii::t('common', 'Base Url'),
            'type' => Yii::t('common', 'Type'),
            'size' => Yii::t('common', 'Size'),
            'name' => Yii::t('common', 'Name'),
            'created_at' => Yii::t('common', 'Created At'),
            'order' => Yii::t('common', 'Order'),
            'meta' => Yii::t('common', 'Meta'),
            'deleted_by' => Yii::t('common', 'Deleted By'),
        ];
    }
}

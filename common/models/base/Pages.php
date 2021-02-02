<?php

namespace common\models\base;

use Yii;
use webvimark\behaviors\multilanguage\MultiLanguageBehavior;
use webvimark\behaviors\multilanguage\MultiLanguageTrait;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "pages".
 *
 * @property integer $id
 * @property integer $organization_id
 * @property string $name
 * @property string $link
 * @property integer $created_at
 * @property integer $updated_at
 */
class Pages extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait, MultiLanguageTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['organization_id', 'name', 'link'], 'required'],
            [['organization_id', 'created_at', 'updated_at'], 'integer'],
            [['name', 'link'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pages';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'organization_id' => Yii::t('common', 'Organization ID'),
            'name' => Yii::t('common', 'Link Title'),
            'link' => Yii::t('common', 'Link'),
        ];
    }

    /**
     * @inheritdoc
     * @return array mixed
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => date('now'),
            ],
            'mlBehavior'=>[
                'class'    => MultiLanguageBehavior::className(),
                'mlConfig' => [
                    'db_table'         => 'translations_with_text',
                    'attributes'       => [
                        'name'
                    ],
                    'admin_routes'     => [
                        'pages/update',
                        'pages/index',
                    ],
                ],
            ],
        ];
    }


    /**
     * @inheritdoc
     * @return \common\models\query\PagesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\PagesQuery(get_called_class());
    }
}

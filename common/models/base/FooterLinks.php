<?php

namespace common\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use webvimark\behaviors\multilanguage\MultiLanguageBehavior;
use webvimark\behaviors\multilanguage\MultiLanguageTrait;
/**
 * This is the base model class for table "footer_links".
 *
 * @property integer $id
 * @property integer $organization_id
 * @property string $name_link1
 * @property string $link1
 * @property string $name_link2
 * @property string $link2
 * @property string $name_link3
 * @property string $link3
 * @property string $name_link4
 * @property string $link4
 * @property string $name_link5
 * @property string $link5
 * @property integer $created_at
 * @property integer $updated_at
 */
class FooterLinks extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait, MultiLanguageTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            ''
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['organization_id', 'created_at', 'updated_at'], 'integer'],
            [['link1','link2','link3','link4','link5'],'url', 'defaultScheme' => 'http'],
            [['name_link1', 'name_link2', 'name_link3', 'name_link4', 'name_link5'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'footer_links';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'organization_id' => Yii::t('common', 'Organization ID'),
            'name_link1' => Yii::t('common', 'Name First Link'),
            'link1' => Yii::t('common', 'Link1'),
            'name_link2' => Yii::t('common', 'Name Second Link'),
            'link2' => Yii::t('common', 'Link2'),
            'name_link3' => Yii::t('common', 'Name Third Link'),
            'link3' => Yii::t('common', 'Link3'),
            'name_link4' => Yii::t('common', 'Name Fourth Link'),
            'link4' => Yii::t('common', 'Link4'),
            'name_link5' => Yii::t('common', 'Name Fifth Link'),
            'link5' => Yii::t('common', 'Link5'),
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
                        'name_link1',
                        'name_link2',
                        'name_link3',
                        'name_link4',
                        'name_link5',
                    ],
                    'admin_routes'     => [
                        'organization/update',
                        'organization/index',
                    ],
                ],
            ],
        ];
    }


    /**
     * @inheritdoc
     * @return \common\models\query\FooterLinksQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\FooterLinksQuery(get_called_class());
    }
}

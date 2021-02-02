<?php

namespace common\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "organization_theme".
 *
 * @property integer $organization_id
 * @property string $brandPrimColor
 * @property string $brandSecColor
 * @property string $brandHTextColor
 * @property string $brandPTextColor
 * @property string $brandBlackColor
 * @property string $brandGrayColor
 * @property string $arfont
 * @property string $enfont
 * @property string $facebook
 * @property string $twitter
 * @property string $linkedin
 * @property string $instagram
 * @property string $locale
 * @property string $updated_at
 *
 * @property \common\models\Organization $organization
 */
class OrganizationTheme extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'organization'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['organization_id'], 'required'],
            [['organization_id'], 'integer'],
            [['brandPrimColor', 'brandSecColor', 'brandHTextColor', 'brandPTextColor', 'brandBlackColor', 'brandGrayColor', 'arfont', 'enfont', 'facebook', 'twitter', 'linkedin', 'instagram', 'locale', 'updated_at'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'organization_theme';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'organization_id' => Yii::t('common', 'Organization ID'),
            'brandPrimColor' => Yii::t('common', 'Brand Prim Color'),
            'brandSecColor' => Yii::t('common', 'Brand Sec Color'),
            'brandHTextColor' => Yii::t('common', 'Brand H Text Color'),
            'brandPTextColor' => Yii::t('common', 'Brand P Text Color'),
            'brandBlackColor' => Yii::t('common', 'Brand Black Color'),
            'brandGrayColor' => Yii::t('common', 'Brand Gray Color'),
            'arfont' => Yii::t('common', 'Arfont'),
            'enfont' => Yii::t('common', 'Enfont'),
            'facebook' => Yii::t('common', 'Facebook'),
            'twitter' => Yii::t('common', 'Twitter'),
            'linkedin' => Yii::t('common', 'Linkedin'),
            'instagram' => Yii::t('common', 'Instagram'),
            'locale' => Yii::t('common', 'Default Organization Locale'),
        ];
    }

    public function beforeSave($insert) {

        $this->brandHTextColor = '#2c3e50';
        $this->brandPTextColor = '#34495e';
        $this->brandBlackColor = '#000';
        $this->brandGrayColor = '#f5f5f5';
        $this->arfont = 'Cairo, sans-serif';
        $this->enfont = 'Roboto, sans-serif';

        return parent::beforeSave($insert);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganization()
    {
        return $this->hasOne(\common\models\Organization::className(), ['id' => 'organization_id']);
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
                'createdAtAttribute' => false,
                'updatedAtAttribute' => 'updated_at',
                'value' => new \yii\db\Expression('NOW()'),
            ],
        ];
    }


    /**
     * @inheritdoc
     * @return \common\models\query\OrganizationThemeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\OrganizationThemeQuery(get_called_class());
    }
}

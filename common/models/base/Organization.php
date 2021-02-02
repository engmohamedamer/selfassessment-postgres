<?php

namespace common\models\base;

use Yii;
use backend\modules\assessment\models\Survey;
use backend\modules\assessment\models\SurveyStat;
use common\models\OrganizationStructure;
use common\models\Pages;
use common\models\User;
use common\models\UserProfile;
use organization\models\search\UserSearch;
use trntv\filekit\behaviors\UploadBehavior;
use webvimark\behaviors\multilanguage\MultiLanguageBehavior;
use webvimark\behaviors\multilanguage\MultiLanguageTrait;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "organization".
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $business_sector
 * @property string $address
 * @property integer $city_id
 * @property integer $district_id
 * @property string $email
 * @property string $phone
 * @property string $mobile
 * @property string $conatct_name
 * @property string $contact_email
 * @property string $contact_phone
 * @property string $contact_position
 * @property integer $limit_account
 * @property string $first_image_base_url
 * @property string $first_image_path
 * @property string $second_image_base_url
 * @property string $second_image_path
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 * @property integer $allow_registration
 * @property string $postalcode
 * @property string $postalbox
 */
class Organization extends \yii\db\ActiveRecord
{
    public $first_image;
    public $second_image;

    const STATUS_NOT_ACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public function relationNames()
    {
        return [
            'organizationTheme'
        ];
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city_id', 'district_id', 'limit_account','allow_registration','sso_login'], 'integer'],
            [['postalbox','postalcode'], 'number'],
            ['name', 'string', 'max' => 150],
            [['business_sector', 'email', 'conatct_name', 'contact_email', 'contact_position'], 'string', 'max' => 100],
            [['address','slug','authServerUrl','realm','clientId','clientSecret'], 'string', 'max' => 255],
            [['phone', 'mobile', 'contact_phone'], 'string', 'max' => 20],
            [['first_image','second_image','status'],'safe'],
        ];
    }


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'organization';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'name' => Yii::t('common', 'Name'),
            'business_sector' => Yii::t('common', 'Business Sector'),
            'address' => Yii::t('common', 'Address'),
            'city_id' => Yii::t('common', 'City'),
            'district_id' => Yii::t('common', 'District'),
            'email' => Yii::t('common', 'Email'),
            'phone' => Yii::t('common', 'Organization Phone'),
            'mobile' => Yii::t('common', 'Organization Mobile'),
            'conatct_name' => Yii::t('common', 'Contact Name'),
            'contact_email' => Yii::t('common', 'Contact Email'),
            'contact_phone' => Yii::t('common', 'Contact Phone'),
            'contact_position' => Yii::t('common', 'Contact Position'),
            'limit_account' => Yii::t('common', 'Limit Account'),
            'first_image' => Yii::t('common', 'Logo Image'),
            'second_image' => Yii::t('common', 'Logo Icon Image'),
            'status' => Yii::t('common', 'Status'),
            'slug'=> Yii::t('common', 'Slug'),
            'about'=>Yii::t('common','About Organization'),
            'postalbox'=>Yii::t('common','Postal Box'),
            'postalcode'=>Yii::t('common','Postal Code'),
            'from'=>Yii::t('common','From'),
            'to'=>Yii::t('common','To'),
            'created_at'=>Yii::t('common','Created At'),
            'allow_registration'=> Yii::t('common','Allow User Registration') ,
            'sso_login'=> Yii::t('common','Allow Login using organization SSO.') ,
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(\backend\models\City::className(), ['id' => 'city_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganizationTheme()
    {
        return $this->hasOne(\common\models\OrganizationTheme::className(), ['organization_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganizationFooterLinks()
    {
        return $this->hasOne(\common\models\FooterLinks::className(), ['organization_id' => 'id']);
    }



    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistrict()
    {
        return $this->hasOne(\backend\models\District::className(), ['id' => 'district_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManager()
    {
        return $this->hasOne(UserProfile::className(), ['organization_id' => 'id'])->andWhere(['main_admin'=>1]);
    }

    public function getPages()
    {
        return $this->hasMany(Pages::className(), ['organization_id' => 'id']);
    }

    public function getSurvey()
    {
        return $this->hasMany(Survey::className(), ['org_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\OrganizationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\OrganizationQuery(get_called_class());
    }

    /**
     * Returns organization status list
     * @return array|mixed
     */
    public static function status()
    {
        return [
            self::STATUS_ACTIVE => Yii::t('common', 'Active'),
            self::STATUS_NOT_ACTIVE => Yii::t('common', 'Not Active'),
        ];
    }


    public function logo()
    {
        return $this->first_image_base_url.$this->first_image_path;
    }

    public function countUsers()
    {
        $searchModel = new UserSearch();
        $searchModel->user_role = User::ROLE_USER;
        $searchModel->organization_id = $this->id;
        $contributors = $searchModel->search([]);
        return count($contributors->getModels());
    }


    public function startSurvey()
    {
        $countComplete = 0;
        foreach ($this->survey as $survey) {
            $countComplete += SurveyStat::find()->where(['survey_stat_survey_id'=> $survey->survey_id])->count();
        }
        return $countComplete;
    }

    public function countSurvey()
    {
        return $this->hasMany(Survey::className(), ['org_id' => 'id'])->where(['admin_enabled'=>1])->count();
    }

    public function countOrganizationStructure()
    {
        return $this->hasMany(OrganizationStructure::className(), ['organization_id' => 'id'])->count();
    }
}

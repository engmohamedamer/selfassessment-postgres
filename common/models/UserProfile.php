<?php

namespace common\models;

use Yii;
use common\models\Organization;
use common\models\OrganizationStructure;
use trntv\filekit\behaviors\UploadBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "user_profile".
 *
 * @property integer $user_id
 * @property integer $locale
 * @property string $firstname
 * @property string $middlename
 * @property string $lastname
 * @property string $picture
 * @property string $avatar
 * @property string $avatar_path
 * @property string $avatar_base_url
 * @property integer $gender
 * @property string $device_token
 * @property string $bio
 * @property integer $sector_id
 * @property integer $temporary_token_used
 * @property string $temporary_token
 * @property integer $main_admin
 *
 * @property User $user
 */
class UserProfile extends ActiveRecord
{
    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;

    const STATUS_DRAFT = 1;
    const STATUS_ACTIVE = 2;

    const SCENARIO_VALIDATE = 'validate';
    /**
     * @var
     */
    public $picture;
    public $full_name;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_profile}}';
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'picture' => [
                'class' => UploadBehavior::class,
                'attribute' => 'picture',
                'pathAttribute' => 'avatar_path',
                'baseUrlAttribute' => 'avatar_base_url'
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id','firstname'], 'required'],
            [['user_id', 'gender','organization_id','draft','sector_id','main_admin'], 'integer'],
            [['sector_id'], 'default', 'value' => 0],
            [['gender'], 'in', 'range' => [NULL, self::GENDER_FEMALE, self::GENDER_MALE]],
            [[ 'avatar_path', 'avatar_base_url','mobile','device_token','position'], 'string', 'max' => 255],
            [['firstname', 'middlename', 'lastname'], 'string', 'max' => 40 ],
            ['locale', 'default', 'value' => Yii::$app->language],
            ['locale', 'in', 'range' => array_keys(Yii::$app->params['availableLocales'])],
            [['picture','nationality_id','specialization_id','job','activity','active','bio'], 'safe'],
            [['nationality_id','specialization_id','job','activity','mobile'],'required', 'on'=>self::SCENARIO_VALIDATE],
            ['firstname','required','message' => 'full_name يجب ادخاله', 'on'=>self::SCENARIO_VALIDATE],
            [['position','temporary_token','temporary_token_used'],'safe'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('common', 'User ID'),
            'firstname' => Yii::t('common', 'Name'),
            'middlename' => Yii::t('common', 'Middlename'),
            'lastname' => Yii::t('common', 'Lastname'),
            'locale' => Yii::t('common', 'Locale'),
            'picture' => Yii::t('common', 'Picture'),
            'gender' => Yii::t('common', 'Gender'),
            'organization_id'=> Yii::t('common', 'School Admin'),
            'mobile'=> Yii::t('common', 'Mobile'),
            'bio'=> Yii::t('common', 'Bio'),
            'sector_id'=> Yii::t('common', 'Sector'),
            'position'=> Yii::t('common', 'User Position'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }


    public function getOrganization()
    {
        return $this->hasOne(Organization::class, ['id' => 'organization_id']);
    }

    public function getSector()
    {
        return $this->hasOne(OrganizationStructure::class, ['id' => 'sector_id']);
    }

    /**
     * @return null|string
     */
    public function getFullName()
    {
        if ($this->firstname || $this->lastname) {
            return implode(' ', [$this->firstname, $this->lastname]);
        }
        return null;
    }


    /**
     * @param null $default
     * @return bool|null|string
     */
    public function getAvatar($default = null)
    {
        return $this->avatar_path
            ? Yii::getAlias($this->avatar_base_url . '/' . $this->avatar_path)
            : null;
    }

    public function genderList()
    {
        return [
            UserProfile::GENDER_MALE => Yii::t('backend', 'Male'),
            UserProfile::GENDER_FEMALE => Yii::t('backend', 'Female'),
        ];
    }

}

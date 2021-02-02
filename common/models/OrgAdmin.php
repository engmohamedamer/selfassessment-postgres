<?php
namespace common\models;

use Yii;
use common\models\User;
use common\models\UserProfile;
use yii\base\Exception;
use yii\db\ActiveRecord;


class OrgAdmin extends UserProfile
{
	public $full_name;
	public $email;
	public $password;
	public $mobile;
    public $main_admin;

	/**
     * @inheritdoc
     */
    public function rules()
    {

    	return [
            ['email', 'unique', 'targetClass' => '\common\models\User', 
                'message' => Yii::t('backend','This email address has already been taken.')],
            [['full_name','email','password','mobile'], 'required'],
            [['gender','organization_id'], 'integer'],
            [['gender'], 'in', 'range' => [NULL, self::GENDER_FEMALE, self::GENDER_MALE]],
            [['full_name','email','password','mobile'], 'string', 'max' => 255],
            ['locale', 'default', 'value' => Yii::$app->language],
        ];

    }

	 /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(),[
            'email' => Yii::t('common', 'Email'),
            'password' => Yii::t('common', 'Password'),
            'full_name'=> Yii::t('common', 'Organization Admin Name')
        ]);
    }

	public function save($runValidation = true, $attributeNames = NULL)
	{

		if ($this->validate()) {
            $model = new User();
            $isNewRecord = $model->getIsNewRecord();
            $model->username = $this->email;
            $model->email = $this->email;
        	$model->status = User::STATUS_ACTIVE;
	        if ($this->password) {
                $model->setPassword($this->password);
            }
            if (!$model->save()) {
            	Yii::$app->session->setFlash('errors', $model->errors);
                throw new Exception('Model not saved');
            }
            $model->afterSignup();
            $auth = \Yii::$app->authManager;
            $auth->revokeAll($model->getId());
            $auth->assign( $auth->getRole(User::ROLE_GOVERNMENT_ADMIN) , $model->getId());
        	return !$model->hasErrors() && $this->updateUserRelatedTbls($model) ;
        }
	}

    public function updateUserRelatedTbls($model){
        $prof = $model->userProfile;
        $prof->locale = 'ar-AR';
        $name = explode(' ', $this->full_name,2);
        $prof->firstname =  $name[0];
        $prof->lastname  =  $name[1];
        $prof->gender    = $this->gender;
        $prof->organization_id = $this->organization_id;
        $prof->main_admin = $this->main_admin ? : 0;
        $prof->sector_id = 0;
        $prof->save(false);
        return $prof;
    }
   
}

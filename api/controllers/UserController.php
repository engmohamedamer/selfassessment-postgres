<?php

namespace api\controllers;

use Yii;
use api\helpers\ResetPassword;
use api\helpers\ResponseHelper;
use api\helpers\SignupForm;
use api\resources\OrganizationStructureResource;
use api\resources\User;
use cheatsheet\Time;
use common\commands\SendEmailCommand;
use common\models\Organization;
use common\models\OrganizationStructure;
use common\models\UserProfile;
use common\models\UserToken;
use organization\models\UserForm;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

class UserController extends  RestController
{

    public function actionLogin(){
        $params = \Yii::$app->request->post();

        if (!isset($params['locale'])) {
            \Yii::$app->language = 'ar';
        }else{
            if ($params['locale'] == 'ar') {
                \Yii::$app->language = 'ar';
            }
        }

        $organization = Organization::findOne(['slug'=>$params['org']]);

        if (!$organization) {
            return ResponseHelper::sendFailedResponse(['ORGANIZATION_NOT_FOUND'=>Yii::t('common','Organization Not Found')],400);
        }

        $user = User::find()
            ->andWhere(['or', ['username' => $params['identity'] ], ['email' => $params['identity']]])
            ->one();

        if(! $user){
            return ResponseHelper::sendFailedResponse(['INVALID_USERNAME_OR_PASSWORD'=>Yii::t('common','These credentials do not match our records.')],400);
        }


        if(!isset($params['password'])){
            return ResponseHelper::sendFailedResponse(['INVALID_USERNAME_OR_PASSWORD'=>Yii::t('common','These credentials do not match our records.')],400);
        }

        $valid_password = Yii::$app->getSecurity()->validatePassword($params['password'], $user->password_hash);

        if($valid_password){

            $checkIsActive = User::find()->active()->andWhere(['or', ['username' => $params['identity'] ], ['email' => $params['identity']]])->one();
            if(!$checkIsActive){
                return ResponseHelper::sendFailedResponse(['INVALID_USERNAME_OR_PASSWORD'=>Yii::t('common',Yii::t('common','Your account not activated yet'))],401);
            }

            //check role
           $roles = ArrayHelper::getColumn( Yii::$app->authManager->getRolesByUser($user->id),'name');
           $currentRole  =   array_keys($roles)[0];
           if( $currentRole != \common\models\User::ROLE_USER || $organization->id != $user->userProfile->organization_id){
               return ResponseHelper::sendFailedResponse(['INVALID_ROLE'=>Yii::t('common','You do not have access')],401);
           }

            $user->access_token = Yii::$app->getSecurity()->generateRandomString(40);
            $user->save(false);
            $data = ['token'=> $user->access_token, 'profile'=> $user ];
            return ResponseHelper::sendSuccessResponse($data);
        }else{
            return ResponseHelper::sendFailedResponse(['INVALID_USERNAME_OR_PASSWORD'=>Yii::t('common','These credentials do not match our records.')],400);
        }
    }

    public function actionSignup(){

        $params = \Yii::$app->request->post();

        if (!isset($params['locale'])) {
            \Yii::$app->language = 'ar';
        }else{
            if ($params['locale'] == 'ar') {
                \Yii::$app->language = 'ar';
            }else{
                \Yii::$app->language = 'en';
            }
        }

        // return $params['locale'];
        if (!isset($params['organization'])) {
            return ResponseHelper::sendFailedResponse(['ORGANIZATION_NOT_FOUND'=>Yii::t('common','Organization Not Found')],400);
        }

        $organization = Organization::findOne(['slug'=>$params['organization']]);

        if (!$organization) {
            return ResponseHelper::sendFailedResponse(['ORGANIZATION_NOT_FOUND'=>Yii::t('common','Organization Not Found')],400);
        }

        if ($organization->allow_registration != 1) {
            return ResponseHelper::sendFailedResponse(['ORGANIZATION_NOT_FOUND'=>Yii::t('common','There is no possibility of registration')],400);
        }

        if ( $organization->limit_account > 0   &&  (User::CountUsers(User::ROLE_USER,' organization_id='.$organization->id) >= $organization->limit_account  ) ) {
            return ResponseHelper::sendFailedResponse(['message'=>Yii::t('common','Sorry! you have exceeded the allowed numbers for participants')],400);

        }

            $model = new SignupForm();
        if ($model->load(['SignupForm'=>$params]) && $user = $model->save($organization->id)) {
            $user= User::findOne(['id'=> $user->id]);
            return ResponseHelper::sendSuccessResponse(['message'=>Yii::t('common','Account Created Successfully')]);
        }else{
            $errors =  ResponseHelper::customResponseError($model->errors);
            return ResponseHelper::sendFailedResponse($errors,400);
        }
    }

    public function actionSectors(){
        $params = \Yii::$app->request->get();
        $organization = Organization::findOne(['slug'=>$params['organization']]);
        $organizationStructure = OrganizationStructureResource::find()->where(['organization_id'=>$organization->id,'lvl'=>0])->addOrderBy('root, lft')->all();
        $data = [];
        foreach ($organizationStructure as $key => $structure) {
            $data[] = [
                'id'=> $structure->id,
                'label'=> $structure->name,
                'children'=> $this->buildTree($structure),
            ];
        }
        return ResponseHelper::sendSuccessResponse($data);
    }


    public function buildTree($structure)
    {
        $data = [];
        $organizationStructure = OrganizationStructureResource::find()
            ->where(['root'=>$structure->root,'lvl'=>$structure->lvl+1])
            ->andWhere(['<','rgt',$structure->rgt])
            ->andWhere(['>','lft',$structure->lft])
            ->addOrderBy('root, lft')
            ->all();
        foreach ($organizationStructure as $key => $value) {
            $data[] = [
                'id'=> $value->id,
                'label'=> $value->name,
                'children'=> $this->buildTree($value),
            ];
        }
        return $data;

    }

    public function actionVerify(){

    }


    public function actionRequestResetPassword(){
        $params = \Yii::$app->request->post();
        if ($params['locale'] == 'ar') {
            \Yii::$app->language = 'ar';
        }
        $user = User::findOne(['email'=> $params['email']]) ;
        if ($user) {
            $token = UserToken::create($user->id, UserToken::TYPE_PASSWORD_RESET, Time::SECONDS_IN_A_DAY);
            if ($user->save()) {
                return \Yii::$app->commandBus->handle(new SendEmailCommand([
                    'to' => $user->email,
                    'subject' => 'استعادة كلمة المرور',
                    'view' => 'passwordResetToken',
                    'params' => [
                        'user' => $user,
                        'token' => $token->token
                    ]
                ]));
            }
            return ResponseHelper::sendSuccessResponse(['SEND_EMAIL_SUCCESS'=>\Yii::t('common','Email reset password sent successfully')]);
        }
        return ResponseHelper::sendFailedResponse(['ENTER_EMAIL'=>\Yii::t('common','Email Not Found.')],401);
    }

    public function actionResetPassword(){
        $params = \Yii::$app->request->post();

        if ($params['locale'] == 'ar') {
            \Yii::$app->language = 'ar';
        }

        try{
            $model = new ResetPassword($params['token']);
        } catch (InvalidArgumentException $e) {
            return ResponseHelper::sendFailedResponse($e->getMessage());
        }
        if ($model->load(['ResetPassword'=>$params]) && $model->validate() && $model->resetPassword()) {
            return ResponseHelper::sendSuccessResponse(['RESET_PASSWORD_SUCCESS'=>\Yii::t('frontend', 'New password was saved.')]);
        }
        return ResponseHelper::sendFailedResponse($model->getErrors());
    }
}

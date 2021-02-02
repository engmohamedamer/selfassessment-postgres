<?php

namespace backend\controllers;

use Intervention\Image\ImageManagerStatic;
use Yii;
use backend\models\AccountForm;
use backend\models\UserForm;
use backend\models\search\UserSearch;
use common\models\Organization;
use common\models\User;
use common\models\UserProfile;
use common\models\UserToken;
use trntv\filekit\actions\DeleteAction;
use trntv\filekit\actions\UploadAction;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends BackendController
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'avatar-upload' => [
                'class' => UploadAction::class,
                'deleteRoute' => 'avatar-delete',
                'on afterSave' => function ($event) {
                    /* @var $file \League\Flysystem\File */
                    $file = $event->file;
                    $img = ImageManagerStatic::make($file->read())->fit(215, 215);
                    $file->put($img->encode());
                }
            ],
            'avatar-delete' => [
                'class' => DeleteAction::class
            ]
        ];
    }



    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();

        if(isset($_REQUEST['user_role'])){
            Yii::$app->session->set('UserRole',$_REQUEST['user_role']);
        }

        $searchModel->user_role = Yii::$app->session->get('UserRole');
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->sort = [
            'defaultOrder' => ['id' => SORT_DESC]
        ];
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionOrganizationAdmins($organization_id)
    {
        $searchModel = new \organization\models\search\UserSearch();
        $searchModel->user_role = 'governmentAdmin';
        $searchModel->organization_id = $organization_id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $organization = Organization::findOne($organization_id);
        $dataProvider->sort = [
            'defaultOrder' => ['id' => SORT_DESC]
        ];
        return $this->render('organization_admins', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'organization'=>$organization
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws \yii\base\Exception
     * @throws NotFoundHttpException
     */
    public function actionLogin($id)
    {
        $model = $this->findModel($id);
        $tokenModel = UserToken::create(
            $model->getId(),
            UserToken::TYPE_LOGIN_PASS,
            60
        );

        return $this->redirect(
            Yii::$app->urlManagerFrontend->createAbsoluteUrl(['user/sign-in/login-by-pass', 'token' => $tokenModel->token])
        );
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserForm();
        $model->roles = Yii::$app->session->get('UserRole') ? : User::ROLE_MANAGER;
        $profile= new UserProfile();

        $model->setScenario('create');
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->username = $model->email;
            $model->save();

            $profile->load(Yii::$app->request->post());
            $user = $this->UpdateUserRelatedTbls($model,$profile)->user;

            Yii::$app->getSession()->setFlash('alert', [
                'type' =>'success',
                'options' => [
                    'class' => 'alert-success',
                ],
                'body' => \Yii::t('backend', 'Data has been saved Successfully') ,
                'title' =>'',
            ]);


            return $this->redirect(['index?user_role='.$model->roles]);
        }
        return $this->render('create', [
            'model' => $model,
            'profile' => $profile,
            'roles' => ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'name')
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateOrganizationAdmin($organization_id)
    {
        $model = new UserForm();
        $model->roles = 'governmentAdmin';
        $profile = new UserProfile();
        $profile->organization_id = $organization_id;
        $model->setScenario('create');
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->username = $model->email;
            $model->save();

            $profile->load(Yii::$app->request->post());
            $user = $this->UpdateUserRelatedTbls($model,$profile)->user;

            Yii::$app->getSession()->setFlash('alert', [
                'type' =>'success',
                'options' => [
                    'class' => 'alert-success',
                ],
                'body' => \Yii::t('backend', 'Data has been saved Successfully') ,
                'title' =>'',
            ]);
            return $this->redirect(['/user/organization-admins?organization_id='.$organization_id]);
        }
        return $this->render('create', [
            'model' => $model,
            'profile' => $profile,
            'roles' => ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'name')
        ]);
    }

    /**
     * Updates an existing User model.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
       $model = new UserForm();
        $model->setModel($this->findModel($id));
        /* check the edit permission*/
        if(!Yii::$app->user->can('administrator')){
            if(User::CheckIsAdmin($id)) return $this->redirect('index');
        }


        $profile= $model->getModel()->userProfile;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $profile->load(Yii::$app->request->post());
            // return var_dump(Yii::$app->request->post());
            $this->UpdateUserRelatedTbls($model,$profile);


            Yii::$app->getSession()->setFlash('alert', [
                'type' =>'success',
                'body' => \Yii::t('backend', 'Data has been updated Successfully') ,
                'title' =>'',
            ]);
            // should handle for org users
            if ($profile->organization_id) {
                return $this->redirect(['/user/organization-admins?organization_id='.$profile->organization_id]);
            }
            return $this->redirect(['index?user_role=manager']);
        }

        // return var_dump($model->errors);

        return $this->render('update', [
            'model' => $model,
            'profile' => $profile,
            'roles' => ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'name'),
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        Yii::$app->authManager->revokeAll($id);
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function UpdateUserRelatedTbls($model,$profile,$post_data=null){
        $prof= $model->getModel()->userProfile;
        if(!$prof) {
            $prof = new UserProfile();
            $prof->user_id=$model->getId();
        }
        $prof->locale= 'ar-AR';
        $prof->firstname = $profile->firstname ;
        $prof->lastname = $profile->lastname ;
        $prof->mobile = $profile->mobile ;
        $prof->gender = $profile->gender;
        $prof->organization_id = $profile->organization_id;
        $prof->avatar_base_url = isset($profile->picture['base_url']) ? $profile->picture['base_url'] : null;
        $prof->avatar_path= isset($profile->picture['path'])? $profile->picture['path']: null ;


        $prof->save(false);

        return $prof;
    }

    public function actionProfile()
    {
        $model = Yii::$app->user->identity->userProfile;
        if ($model->load($_POST) && $model->save()) {
            Yii::$app->session->setFlash('alert', [
                'options' => ['class' => 'alert-success'],
                'body' => Yii::t('backend', 'Your profile has been successfully saved', [], $model->locale)
            ]);
            return $this->refresh();
        }
        return $this->render('../sign-in/profile', ['model' => $model]);
    }

    public function actionAccount()
    {
        $user = Yii::$app->user->identity;
        $model = new AccountForm();
        $model->username = $user->username;
        $model->email = $user->email;
        if ($model->load($_POST) && $model->validate()) {
            $user->username = $model->username;
            $user->email = $model->email;
            if ($model->password) {
                $user->setPassword($model->password);
            }
            $user->save();
            Yii::$app->session->setFlash('alert', [
                'options' => ['class' => 'alert-success'],
                'body' => Yii::t('backend', 'Your account has been successfully saved')
            ]);
            return $this->refresh();
        }
        return $this->render('../sign-in/account', ['model' => $model]);
    }

}

<?php

namespace backend\controllers;

use Intervention\Image\ImageManagerStatic;
use Yii;
use backend\models\UserForm;
use common\models\FooterLinks;
use common\models\MultiModel;
use common\models\OrgAdmin;
use common\models\Organization;
use common\models\OrganizationSearch;
use common\models\OrganizationTheme;
use common\models\User;
use common\models\UserProfile;
use trntv\filekit\actions\DeleteAction;
use trntv\filekit\actions\UploadAction;
use yii\base\Exception;
use yii\base\Model;
use yii\base\Response;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * OrganizationController implements the CRUD actions for Organization model.
 */
class OrganizationController extends BackendController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'first-upload' => [
                'class' => UploadAction::class,
                'deleteRoute' => 'first-delete',
                'on afterSave' => function ($event) {
                    // $file = $event->file;
                    // $img = ImageManagerStatic::make($file->read())->resize(90, 50);
                    // $file->put($img->encode());
                }
            ],
            'first-delete' => [
                'class' => DeleteAction::class
            ],
            'second-upload' => [
                'class' => UploadAction::class,
                'deleteRoute' => 'second-delete',
                'on afterSave' => function ($event) {
                    $file = $event->file;
                    $img = ImageManagerStatic::make($file->read())->resize(32, 32);
                    $file->put($img->encode());
                }
            ],
            'second-delete' => [
                'class' => DeleteAction::class
            ],
            'avatar-upload' => [
                'class' => UploadAction::class,
                'deleteRoute' => 'avatar-delete',
                'on afterSave' => function ($event) {
                }
            ],
            'avatar-delete' => [
                'class' => DeleteAction::class
            ]
        ];
    }

    /**
     * Lists all Organization models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrganizationSearch();
        $searchModel->to = date('Y-m-d');
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Organization model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Organization model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model   = new Organization();
        $theme = new OrganizationTheme();
        $themeFooterLinks = new FooterLinks();
        $modelsAdmins = [new OrgAdmin];

        // ajax validation
        if (Yii::$app->request->isAjax) {

            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $modelsAdmins = MultiModel::createMultiple(OrgAdmin::classname());
            MultiModel::loadMultiple($modelsAdmins, Yii::$app->request->post());
            return MultiModel::validateMultiple($modelsAdmins);
        }
        
        if ($model->load(Yii::$app->request->post()) &&  
            $model->validate() && $theme->load(Yii::$app->request->post()) && 
            $themeFooterLinks->load(Yii::$app->request->post())  
        ) {

            $modelsAdmins = MultiModel::createMultiple(OrgAdmin::classname());
            MultiModel::loadMultiple($modelsAdmins, Yii::$app->request->post());
            $valid = MultiModel::validateMultiple($modelsAdmins);
            if ($valid) {
                //save model and its related models
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsAdmins as $index => $modelAdmin) {
                            $modelAdmin->organization_id = $model->id;
                            if ($index == 0) {
                                $modelAdmin->main_admin = 1;
                            }
                            if (! ($flag = $modelAdmin->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag && $model->validate() && $theme->validate() && $themeFooterLinks->validate()) {
                        $theme->organization_id = $model->id;
                        $themeFooterLinks->organization_id = $model->id;
                        if($themeFooterLinks->save() && $theme->save()) {
                            $transaction->commit();
                            return $this->redirect(['view', 'id' => $model->id]);
                        }
                    }
                    $transaction->rollBack();
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
            Yii::$app->session->setFlash('errors', \Yii::t('backend','Something went wrong when adding an admin'));
            $model->isNewRecord = true;
            $theme->isNewRecord = true;
            $themeFooterLinks->isNewRecord = true;
        }

        return $this->render('create', [
            'model' => $model,
            'user' => $user,
            'profile' => $profile,
            'theme'=> $theme,
            'themeFooterLinks'=> $themeFooterLinks,
            'modelsAdmins'=>$modelsAdmins
        ]);

    }

    /**
     * Updates an existing Organization model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $theme = OrganizationTheme::findOne(['organization_id'=>$id]);
        $themeFooterLinks = FooterLinks::findOne(['organization_id'=>$id]);

        if (!$theme) {
            $theme = new OrganizationTheme();
            $theme->organization_id = $id;
        }
        $themeFooterLinks = new FooterLinks();
        if (!$themeFooterLinks) {
            $themeFooterLinks = new FooterLinks();
            $themeFooterLinks->organization_id = $id;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if (!$themeFooterLinks) {
                $themeFooterLinks = new FooterLinks();
                $themeFooterLinks->organization_id = $id;
            }
            if ($themeFooterLinks->load(\Yii::$app->request->post()) && $theme->load(\Yii::$app->request->post()) && $themeFooterLinks->save() && $theme->save()) {

                if ($model->save_exit == 'exit') {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }
        return $this->render('update', [
            'model' => $model,
            'theme' => $theme,
            'themeFooterLinks' => $themeFooterLinks,
        ]);
    }

    /**
     * Deletes an existing Organization model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->deleteWithRelated();

        return $this->redirect(['index']);
    }

    
    /**
     * Finds the Organization model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Organization the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Organization::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('common', 'The requested page does not exist.'));
        }
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function UpdateUserRelatedTbls($model,$profile,$organization_id = null){
        $prof= $model->getModel()->userProfile;
        if(!$prof) {
            $prof = new UserProfile();
            $prof->user_id = $model->getId();
        }
        $prof->locale= 'ar-AR';
        $prof->firstname = $profile->firstname ;
        $prof->lastname = $profile->lastname ;
        $prof->gender = $profile->gender;
        $prof->avatar_base_url = isset($profile->picture['base_url']) ? $profile->picture['base_url'] : null;
        $prof->avatar_path = isset($profile->picture['path'])? $profile->picture['path']: null ;
        $prof->organization_id = $organization_id;
        $prof->save(false);

        return $prof;
    }


    public function actionManager($id)
    {
        $this->layout='base';

        $model = new UserForm();
        $model->setModel(User::findOne($id));
        $model->roles = User::ROLE_GOVERNMENT_ADMIN; 
        $profile= $model->getModel()->userProfile;
        $saved = false;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $profile->load(Yii::$app->request->post());
            $this->UpdateUserRelatedTbls($model,$profile,$profile->organization_id);
            $saved = true;
        }else{
            // return var_dump($model->errors);
        }

        return $this->render('manager', [
            'model' => $model,
            'profile' => $profile,
            'saved'=> $saved
        ]);
    }
}

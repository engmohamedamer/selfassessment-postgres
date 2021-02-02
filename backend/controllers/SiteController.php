<?php

namespace backend\controllers;

use Yii;
use backend\modules\assessment\models\Survey;
use backend\modules\assessment\models\SurveyStat;
use common\helpers\Filter;
use common\models\Organization;
use common\models\User;
use yii\helpers\ArrayHelper;

/**
 * Site controller
 */
class SiteController extends BackendController
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionTest()
    {
        $date =  str_ireplace('/', '-', "26/02/2020");
        return var_dump((date('d-m-Y',strtotime($date)) != $date),date('d-m-Y',strtotime($date)));
    }

    public function actionGo(){
        $this->layout= 'baselayout';
        return $this->render('go');
    }

    public function beforeAction($action)
    {
        $this->layout = Yii::$app->user->isGuest || !Yii::$app->user->can('loginToBackend') ? 'base' : 'common';

        return parent::beforeAction($action);
    }


    public function actionDashboard(){

        $dateOrganizations = Filter::dateFilter('created_at',true);
        $organizations = Organization::find()->select('id,name')
            ->where($dateOrganizations)
            ->orderBy('id DESC')
            ->limit(10)
            ->all();

        $organizationsCount = Organization::find()->select('id,name')
            ->where($dateOrganizations)
            ->count();

        // charts data
        $chartData = Filter::chartData() ;
        $labels = $chartData['labels'];
        $dataChart  = $chartData['data'];

        $dateSurvey = Filter::dateFilter('survey_created_at');

        $surveyCount = Survey::find()->where($dateSurvey)
            ->andWhere(['admin_enabled'=>1])
            ->andWhere($this->filterByOrganization('org_id'))
            ->count();
        $dateStats = Filter::dateFilter("to_char(survey_stat_assigned_at,'YYYY-MM-DD')");
        $surveyStatsCount  = SurveyStat::find()->where($dateStats);

        if (!empty($_GET['organization_id'])) {
            $surveyIds = ArrayHelper::getColumn(Survey::find()->where(['org_id'=>$_GET['organization_id']])->all(),'survey_id');
            $surveyStatsCount->andWhere(['IN','survey_stat_survey_id',$surveyIds]);
        }
        $surveyStatsCount  = $surveyStatsCount->count();
        $dateUser = Filter::dateFilter('created_at',true,'nuser.');
        $user = User::find()
            ->join('LEFT JOIN','rbac_auth_assignment','rbac_auth_assignment.user_id::INTEGER = nuser.id')
            ->join('LEFT JOIN','user_profile','user_profile.user_id = nuser.id')
            ->andFilterWhere(['rbac_auth_assignment.item_name' => User::ROLE_USER])
            ->andWhere($dateUser)
            ->andWhere($this->filterByOrganization('organization_id'));
        $userCount = $user->count();
        return $this->render('dashboard',compact('organizations','organizationsCount','surveyCount','assessmentStatus','userCount','surveyStatsCount','labels','dataChart'));
    }

    public function filterByOrganization($organization_column)
    {
        $key = $_GET['organization_id'] ?: null;
        if ($key == null) return ['IS NOT',$organization_column,null];
        return [$organization_column=>$key];
    }

}

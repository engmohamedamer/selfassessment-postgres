<?php

namespace backend\modules\assessment\models;

use Yii;
use backend\models\SurveyDegreeLevel;
use common\models\Organization;
use common\models\OrganizationStructure;
use common\models\SurveySelectedUsers;
use common\models\Tag;
use common\models\base\SurveySelectedSectors;
use sjaakp\taggable\TaggableBehavior;
use yii\db\Expression;
use yii\db\conditions\AndCondition;
use yii\db\conditions\OrCondition;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "survey".
 *
 * @property integer $survey_id
 * @property integer $survey_created_by
 * @property string $survey_name
 * @property string $survey_created_at
 * @property string $survey_updated_at
 * @property string $survey_expired_at
 * @property boolean $survey_is_pinned
 * @property boolean $survey_is_closed
 * @property boolean $survey_is_private
 * @property boolean $survey_is_visible
 * @property integer $survey_wallet
 * @property integer $survey_status
 * @property integer $survey_time_to_pass
 * @property integer $survey_badge_id
 * @property string $survey_tags
 * @property string $survey_image
 * @property string $survey_descr
 * @property string $start_info
 * @property integer $survey_point
 * @property SurveyUserAnswer[] $surveyUserAnswers
 * @property SurveyQuestion[] $questions
 * @property SurveyStat[] $stats
 * @property-read User[] $restrictedUsers
 * @property Badge $badge
 *
 * @property-read int $restrictedUserCount
 * @property-read int[] $restrictedUserIds
 * @property-read string[] $restrictedUserNames
 * @property-read boolean $isAccessibleByCurrentUser
 */
class Survey extends \yii\db\ActiveRecord
{

    public $question = null;
    public $imageFile = null;

    public $level_title = null;
    public $level_from = null;
    public $level_to = null;

    public $usersList = [];
    public $sector_ids = [];
    const SCENARIOUPDATE = 'scenarioupdate';

    public $survey_stat;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'survey';
    }

    public function beforeSave($insert)
    {
        if ($insert) {
            $this->survey_created_by = \Yii::$app->user->getId();
        }
        return parent::beforeSave($insert);
    }



    public function behaviors()
    {
        return [
            'taggable' => [
                'class' => TaggableBehavior::class,
                'junctionTable' => 'survey_tag',
                'tagClass' => Tag::class,
                'modelKeyColumn'=>'survey_id',
            ]
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['survey_created_at', 'survey_updated_at', 'survey_expired_at','org_id','start_info','level_title','level_from','level_to','tags','usersList','sector_ids'], 'safe'],
            [['survey_is_pinned', 'survey_is_closed', 'survey_is_private', 'survey_is_visible'], 'boolean'],
            [['survey_name'], 'string', 'max' => 100],
            [['survey_descr'], 'string'],
            [['survey_tags', 'survey_image'], 'string', 'max' => 255],
            // survey_descr
            [['survey_name'], 'required'],
            [['survey_expired_at'], 'required', 'on' => self::SCENARIOUPDATE],
            [['survey_wallet', 'survey_status', 'survey_created_by', 'survey_badge_id','org_id','survey_point','sector_id','admin_enabled'], 'integer'],
            ['survey_time_to_pass','integer','min'=>1],
            ['survey_point', 'compare', 'compareValue' => 0, 'operator' => '>=', 'type' => 'number'],
            [['imageFile'], 'file', 'mimeTypes' => 'image/jpeg, image/png', 'maxSize' => 5000000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'survey_id' => Yii::t('survey', 'Survey ID'),
            'org_id' => Yii::t('survey', 'Organization ID'),
            'survey_name' => Yii::t('survey', 'Name'),
            'survey_created_at' => Yii::t('survey', 'Created at'),
            'survey_updated_at' => Yii::t('survey', 'Updated at'),
            'survey_expired_at' => Yii::t('survey', 'Expired at'),
            'survey_is_pinned' => Yii::t('survey', 'Pinned'),
            'survey_is_closed' => Yii::t('survey', 'Closed'),
            'survey_is_private' => Yii::t('survey', 'Private'),
            'survey_is_visible' => Yii::t('survey', 'Visible'),
            'survey_wallet' => Yii::t('survey', 'Price'),
            'survey_tags' => Yii::t('survey', 'Tags'),
            'survey_descr' => Yii::t('survey', 'Description'),
            'survey_time_to_pass' => Yii::t('survey', 'Time to pass'),
            'restrictedUserIds' => Yii::t('survey', 'Restricted users'),
            'imageFile' => '',
            'start_info'=>Yii::t('survey', 'Assessment Start Info'),
            'survey_point'=> Yii::t('survey', 'Assessment Point'),
            'level_title'=>Yii::t('survey', 'Level Title') ,
            'level_from'=>Yii::t('survey', 'From a percentage') ,
            'level_to'=>Yii::t('survey', 'To a percentage') ,
            'sector_id'=> Yii::t('common', 'Sector'),
            'sector_ids'=> Yii::t('common', 'Sector'),
            'tags' => Yii::t('common', 'Tags'),
            'usersList' => Yii::t('common', 'Selected Users'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyUserAnswers()
    {
        return $this->hasOne(SurveyUserAnswer::class, ['survey_user_answer_survey_id' => 'survey_id']);
    }

    public function getOrganization()
    {
        return $this->hasOne(Organization::class, ['id' => 'org_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasMany(SurveyQuestion::class, ['survey_question_survey_id' => 'survey_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStats()
    {
        return $this->hasMany(SurveyStat::class, ['survey_stat_survey_id' => 'survey_id']);
    }

    public function getStatsComplete()
    {
        return $this->hasMany(SurveyStat::class, ['survey_stat_survey_id' => 'survey_id'])->where(['survey_stat_is_done'=>1])->count();
    }

    public function getStatsNotComplete()
    {
        return $this->hasMany(SurveyStat::class, ['survey_stat_survey_id' => 'survey_id'])->where(['survey_stat_is_done'=>0])->count();
    }


    public function getLevels()
    {
        return $this->hasMany(SurveyDegreeLevel::class, ['survey_degree_level_survey_id' => 'survey_id']);
    }


    public static function countOrgSurvey($org_id)
    {
        return self::find()->where(['org_id'=>$org_id,'survey_is_visible'=>1])->count();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRestrictedUsers()
    {
        return $this->hasMany(Yii::$app->user->identityClass, ['id' => 'survey_restricted_user_user_id'])
	        ->viaTable('survey_restricted_user', ['survey_restricted_user_survey_id' => 'survey_id']);
    }

    public function getStatus()
    {
        if (isset($this->survey_expired_at) && strtotime($this->survey_expired_at) < time()) {
            $status = 'expired';
        } else {
            $status = $this->survey_is_closed ? 'closed' : 'active';
        }
        return $status;
    }

    public function setQuestions($val)
    {
        return $this->questions = $val;
    }

    public function getRespondentsCount()
    {
        return SurveyStat::find()->where(['survey_stat_survey_id' => $this->survey_id])->count();
    }

    public function getCompletedRespondentsCount()
    {
        return SurveyStat::find()->where(['survey_stat_survey_id' => $this->survey_id])
            ->andWhere("survey_stat_is_done = 1")
            ->count();
    }

    static function getDropdownList()
    {
        return ArrayHelper::map(self::find()
	        ->leftJoin('survey_restricted_user', 'survey_id = survey_restricted_user_survey_id')
            ->where(new AndCondition([
	            ['survey_is_visible' => 1],
            	new OrCondition([
		            ['>', 'survey_expired_at', new Expression('NOW()')],
		            ['survey_expired_at' => null]
	            ]),
	            new OrCondition([
	            	['survey_is_private' => 0],
		            ['survey_restricted_user_user_id' => \Yii::$app->user->id]
	            ])
            ]))
            ->orderBy(['survey_created_at' => SORT_ASC])
            ->asArray()->all(), 'survey_id', 'survey_name');
    }

    /**
     * @return string
     */
    public function getImage()
    {
        $file = !empty($this->survey_image) ? $this->survey_image : null;

        if (empty($file)) {
            return null;
        }
        $module = \Yii::$app->getModule('assessment');
        $basepath = $module->params['uploadsUrl'];
        $path = $basepath . '/' . $this->survey_image;

        return $path;
    }

    public function getAuthorName()
    {
        try {
            $userClass = \Yii::$app->user->identityClass;
            $author = $userClass::findOne($this->survey_created_by);
            if ($author) {
                return $author->username;
            } else {
                return null;
            }
        } catch (\Throwable $e) {
            return 'undefined';
        }
    }

    public static function assignRestrictedUser($userId, $surveyId) {
    	$survey = self::findOne($surveyId);
	    $userClass = \Yii::$app->user->identityClass;
	    $survey->link('restrictedUsers', $userClass::findOne($userId));
	    return true;
    }

    public static function unassignRestrictedUser($userId, $surveyId) {
    	$survey = self::findOne($surveyId);
	    $userClass = \Yii::$app->user->identityClass;
	    $survey->unlink('restrictedUsers', $userClass::findOne($userId), true);
	    return true;
    }

	public function getRestrictedUsersCount()
	{
		return self::find()
			->innerJoin('survey_restricted_user', 'survey_id = survey_restricted_user_survey_id')
			->where(['survey_id' => $this->survey_id])
			->count();
	}

	public function getRestrictedUserIds() {
    	return ArrayHelper::map($this->restrictedUsers, 'id', 'id');
    }

    public function getRestrictedUserNames() {
    	return ArrayHelper::map($this->restrictedUsers, 'id', 'fullname');
    }

    public function isAccessibleBy($userId) {
	    return ($this->survey_is_visible && (!$this->survey_is_private || in_array($userId, $this->restrictedUserIds)));
    }

    public function getIsAccessibleByCurrentUser() {
    	return $this->isAccessibleBy(\Yii::$app->user->id);
    }

    public static function surveyProgress($model,$userId){
        $no_of_question = count($model->questions);

        $userAnswersObj = SurveyUserAnswer::find()
            ->select('survey_user_answer_question_id ')
            ->distinct()
            ->where([
                'survey_user_answer_user_id'=>$userId,
                'survey_user_answer_survey_id'=>$model->survey_id,

            ])->all();
        $progress = 0;

        if ($userAnswersObj) {
            $progress= (count($userAnswersObj) /$no_of_question)*100;
        }
        return $progress;


    }

    public  function getSurveySelectedUsers(){
        $data=[];
        $selectedList= SurveySelectedUsers::find()->where(['survey_id'=>$this->survey_id])->all();
        foreach($selectedList as $item){
            $data[] = $item->user_id ;
        }
        return $data ;
    }

    public  function getSurveySelectedSectors(){
        $data=[];
        $selectedList= SurveySelectedSectors::find()->where(['survey_id'=>$this->survey_id])->all();
        foreach($selectedList as $item){
            $data[] = $item->sector_id ;
        }
        return $data ;
    }

    public function getSector()
    {
        return $this->hasOne(OrganizationStructure::class, ['id' => 'sector_id']);
    }
}

<?php

namespace backend\modules\assessment\models\search;

use Yii;
use backend\modules\assessment\models\Survey;
use common\helpers\Filter;
use common\models\SurveyTag;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/**
 * SurveySearch represents the model behind the search form about `backend\modules\assessment\models\Survey`.
 */
class SurveySearch extends Survey
{
    public $tags;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['survey_id', 'survey_badge_id','org_id','sector_id','admin_enabled'], 'integer'],
            [['survey_name', 'survey_created_at', 'survey_updated_at', 'survey_expired_at','org_id','tags'], 'safe'],
            [['survey_is_pinned', 'survey_is_closed'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {

        $this->load($params);

        $query = Survey::find();

        if (!\Yii::$app->user->identity->userProfile->main_admin) {
            $sctor_ids = Filter::adminAllowedSectorIds();
            if (!empty($sctor_ids)) {
                $query->andFilterWhere(['IN','sector_id',$sctor_ids]);
                $query->orFilterWhere(['is','sector_id',new \yii\db\Expression('null')]);
            }
        }

        if (!empty($this->tags)) {
            $tagsSurvey = ArrayHelper::getColumn(SurveyTag::find()->where(['IN','tag_id',$this->tags])->all(),'survey_id');
            $query->andFilterWhere(['IN','survey_id',array_unique($tagsSurvey)]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['defaultPageSize' => 10],
            'sort' => ['defaultOrder' => ['survey_created_at' => SORT_DESC]]
        ]);


        if (!$this->validate()) {
            $query->where('0=1');
        }

        $query->andFilterWhere(Filter::dateFilter('survey_created_at'));

        //alwyas show surveys with updated  data only
        $query->andFilterWhere(['admin_enabled' => 1]);


        $query->andFilterWhere([
            'org_id' => $this->org_id,
            'sector_id' => $this->sector_id,
            'survey_created_at' => $this->survey_created_at,
            'survey_updated_at' => $this->survey_updated_at,
            'survey_expired_at' => $this->survey_expired_at,
            'survey_is_pinned' => $this->survey_is_pinned,
            'survey_is_closed' => $this->survey_is_closed,
        ]);

        $query->andFilterWhere(['like', 'survey_name', $this->survey_name]);
        $query->groupBy('survey_id');
        return $dataProvider;
    }


    public function searchValidAssessment()
    {

        // $sql =   "
        //   SELECT g.*, COUNT(m.survey_question_survey_id) AS question
        // FROM survey AS g
        // LEFT JOIN survey_question AS m ON g.survey_id = m.survey_question_survey_id
        // where org_id = 12
        // GROUP BY g.survey_id
        // HAVING question > 0
        //  "
        $sql = "SELECT `s`.* FROM `survey` `s` WHERE 
                ((select count(*)
                from survey_question q
                where q.survey_question_survey_id = s.survey_id
                ) != 0 OR s.survey_name != 'استبيان جديد' )
        ";
        $query = Survey::findBySql($sql);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['defaultPageSize' => 5],
            'sort' => ['defaultOrder' => ['survey_created_at' => SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
             $query->where('0=1');
           // return $dataProvider;
        }

        $query->andFilterWhere([
            'survey_id' => $this->survey_id,
            'org_id' => $this->org_id,
            'survey_created_at' => $this->survey_created_at,
            'survey_updated_at' => $this->survey_updated_at,
            'survey_expired_at' => $this->survey_expired_at,
            'survey_is_pinned' => $this->survey_is_pinned,
            'survey_is_closed' => $this->survey_is_closed,
        ]);

        $query->andFilterWhere(['like', 'survey_name', $this->survey_name]);
        return var_dump($query->createCommand()->sql);

        return $dataProvider;
    }
}

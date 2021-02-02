<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CorrectiveActionReport;

/**
 * backend\models\search\CorrectiveActionReportSearch represents the model behind the search form about `backend\models\CorrectiveActionReport`.
 */
 class CorrectiveActionReportSearch extends CorrectiveActionReport
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // question_id , answer_id , 'corrective_action'
            [['id', 'org_id', 'user_id', 'survey_id'], 'integer'],
            [[ 'corrective_action_date', 'status', 'comment'], 'safe'],
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
        $query = CorrectiveActionReport::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'org_id' => $this->org_id,
            'user_id' => $this->user_id,
            'survey_id' => $this->survey_id,
            'question_id' => $this->question_id,
            'answer_id' => $this->answer_id,
            'corrective_action_date' => $this->corrective_action_date,
        ]);

        $query->andFilterWhere(['like', 'corrective_action', $this->corrective_action])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}

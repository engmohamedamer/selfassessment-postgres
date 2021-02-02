<?php

namespace backend\models\search;

use common\models\User;
use common\models\UserProfile;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * UserSearch represents the model behind the search form about `common\models\User`.
 */
class UserSearch extends User
{
    public $SearchFullName ;

    public $user_role;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status','SearchFullName'], 'integer'],
            [['created_at'], 'filter', 'filter' => 'strtotime', 'skipOnEmpty' => true],
            [['created_at'], 'default', 'value' => null],
            [['username', 'auth_key', 'password_hash', 'email','SearchFullName'], 'safe'],
            ['user_role','string'],
            ['user_role','safe'],

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
     * @return ActiveDataProvider
     */
    public function search($params)
    {

        $query = User::find();

        $query->joinWith(['userProfile']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]]
        ]);

        if (!($this->load($params) && $this->validate())) {
            //return $dataProvider;
        }

        if($this->SearchFullName){
            $query->andFilterWhere([
                    'id' => $this->SearchFullName
                ]
            );
        }
        $query->join('LEFT JOIN','{{%rbac_auth_assignment}}','{{%rbac_auth_assignment}}.user_id::INTEGER = {{%nuser}}.id')
            ->andFilterWhere([ '<>','{{%rbac_auth_assignment}}.item_name' , User::ROLE_ADMINISTRATOR]);

        if($this->user_role){
            $query->andFilterWhere(['{{%rbac_auth_assignment}}.item_name' => $this->user_role]);
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
        ]);


        if ($this->created_at !== null) {
            $query->andFilterWhere(['between', 'created_at', $this->created_at, $this->created_at + 3600 * 24]);
        }

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'email', $this->email]);

        if(! \Yii::$app->user->can('administrator')) {
            $query->andFilterWhere(['>', 'id', 1]);  //super admin

        }


        return $dataProvider;
    }

    public static function listAdminInMenu()
    {
        return  User::find()->join('LEFT JOIN','{{%rbac_auth_assignment}}','{{%rbac_auth_assignment}}.user_id::INTEGER = {{%nuser}}.id')
            ->andFilterWhere(['{{%rbac_auth_assignment}}.item_name' => User::ROLE_MANAGER])->limit(3)->orderBy('nuser.id DESC')->all();
    }
}

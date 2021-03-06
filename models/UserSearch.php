<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;

/**
 * UserSearch represents the model behind the search form of `app\models\User`.
 */
class UserSearch extends User
{

    public $name;
    public $age_min_default = 18;
    public $age_max_default = 100;
    public $age_min = 18;
    public $age_max = 100;
    public $city_id;

    public $action = '/user';

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['name', 'string'],
            ['age_min', 'integer'],
            ['age_max', 'integer'],
            ['city_id', 'integer'],

            [['id', 'status', 'created_at', 'updated_at', 'online_at'], 'integer'],
            [['name','second_name','username', 'auth_key', 'password_hash', 'password_reset_token', 'email_confirm_token', 'email'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = User::find();

        // add conditions that should always apply here

        $childRolesArray = User::getChildRolesArray();
        $auth = Yii::$app->authManager;
        $ids = [];
        foreach($childRolesArray as $roleName => $description) {
            $ids = array_merge($ids, $auth->getUserIdsByRole($roleName));
        }

        $query->andWhere([
            'in', 'id', $ids
        ]);

        $query->with('profile');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'online_at' => $this->online_at,
            'city_id' => $this->city_id,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email_confirm_token', $this->email_confirm_token])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'second_name', $this->second_name]);

        return $dataProvider;
    }
}

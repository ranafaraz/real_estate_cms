<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\UserType;

/**
 * UserTypeSearch represents the model behind the search form about `backend\models\UserType`.
 */
class UserTypeSearch extends UserType
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_type_id'], 'integer'],
            [['user_type'], 'safe'],
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
        $query = UserType::find();

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
            'user_type_id' => $this->user_type_id,
        ]);

        $query->andFilterWhere(['like', 'user_type', $this->user_type]);

        return $dataProvider;
    }
}

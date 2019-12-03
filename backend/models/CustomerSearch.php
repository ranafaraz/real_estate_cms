<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Customer;

/**
 * CustomerSearch represents the model behind the search form about `backend\models\Customer`.
 */
class CustomerSearch extends Customer
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'user_id', 'organization_id'], 'integer'],
            [['name', 'father_name', 'cnic_no', 'contact_no', 'email_address', 'address', 'created_date','customer_type_id'], 'safe'],
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
        $query = Customer::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->joinWith('customerType');
        $query->andFilterWhere([
            'customer_id' => $this->customer_id,
            // 'customer_type_id' => $this->customer_type_id,
            'user_id' => $this->user_id,
            'organization_id' => $this->organization_id,
            'created_date' => $this->created_date,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'father_name', $this->father_name])
            ->andFilterWhere(['like', 'cnic_no', $this->cnic_no])
            ->andFilterWhere(['like', 'customer_type.customer_type', $this->customer_type_id])
            ->andFilterWhere(['like', 'contact_no', $this->contact_no])
            ->andFilterWhere(['like', 'email_address', $this->email_address])
            ->andFilterWhere(['like', 'address', $this->address]);

        return $dataProvider;
    }
}

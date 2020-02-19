<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AccountPayable;

/**
 * AccountPayableSearch represents the model behind the search form about `backend\models\AccountPayable`.
 */
class AccountPayableSearch extends AccountPayable
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'transaction_id'], 'integer'],
            [['amount'], 'number'],
            [['due_date' , 'account_payable'],'string'],
            [['updated_at', 'updated_by','due_date'], 'safe'],
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
        $query = AccountPayable::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        // $query->joinWith('')
        $query->joinWith('accountPayable');
        $query->andFilterWhere([
            'id' => $this->id,
            'transaction_id' => $this->transaction_id,
            'amount' => $this->amount,
            'updated_at' => $this->updated_at,
        ]);
        $query->andFilterWhere(['like', 'account_payable.updated_by', $this->updated_by])
            ->andFilterWhere(['like', 'due_date', $this->due_date])
            ->andFilterWhere(['like', 'account_name', $this->account_payable]);

        return $dataProvider;
    }
}

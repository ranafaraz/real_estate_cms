<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AccountRecievable;

/**
 * AccountRecievableSearch represents the model behind the search form about `backend\models\AccountRecievable`.
 */
class AccountRecievableSearch extends AccountRecievable
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'transaction_id'], 'integer'],
            [['amount'], 'number'],
            [['payer_id','due_date'],'string'],
            [['due_date'],'safe'],
            [['updated_by','account_receivable', 'updated_at'], 'safe'],
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
        $query = AccountRecievable::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        // $query->joinWith('accountReceivable');
        $query->andFilterWhere([
            'id' => $this->id,
            'transaction_id' => $this->transaction_id,
            'amount' => $this->amount,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'due_date', $this->due_date])
              ->andFilterWhere(['like', 'name', $this->payer_id]);
              // ->andFilterWhere(['like', 'account_name', $this->account_receivable])
              // ->andFilterWhere(['like', 'account_recievable.updated_by', $this->updated_by]);

        return $dataProvider;
    }
}

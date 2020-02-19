<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Payment;

/**
 * PaymentSearch represents the model behind the search form about `backend\models\Payment`.
 */
class PaymentSearch extends Payment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'transaction_id', 'debit_account', 'credit_account'], 'integer'],
            [['type', 'narration', 'date', 'ref_no', 'created_by','transaction_date'], 'safe'],
            [['debit_amount', 'credit_amount'], 'number'],
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
        $nature = AccountNature::find()->where(['name' => 'Income'])->One();
        $head = AccountHead::find()->select('id')->where(['nature_id' => $nature->id])->all();
        foreach ($head as  $value) {
            $query = Receipt::find()->where(['credit_account' => $value->id])->andWhere(['organization_id' => \Yii::$app->user->identity->organization_id]);
        }
        $query = Payment::find();

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
            'transaction_id' => $this->transaction_id,
            'debit_account' => $this->debit_account,
            'debit_amount' => $this->debit_amount,
            'credit_account' => $this->credit_account,
            'credit_amount' => $this->credit_amount,
            'date' => $this->date,
        ]);


        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'narration', $this->narration])
            ->andFilterWhere(['like', 'ref_no', $this->ref_no])
            ->andFilterWhere(['like', 'transaction_date', $this->transaction_date])
            ->andFilterWhere(['like', 'created_by', $this->created_by]);

        return $dataProvider;
    }
}

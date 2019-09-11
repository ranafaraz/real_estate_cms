<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\InstallmentPayment;

/**
 * InstallmentPaymentSearch represents the model behind the search form about `backend\models\InstallmentPayment`.
 */
class InstallmentPaymentSearch extends InstallmentPayment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['installment_id', 'no_of_installments', 'organization_id'], 'integer'],
            [['installment_type', 'remaning_amount', 'total_amount'], 'safe'],
            [['customer_id', 'property_id'],'string'],
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
        $ins_id = \Yii::$app->user->identity->organization_id;
        $query = InstallmentPayment::find();

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
            'installment_id' => $this->installment_id,
            'no_of_installments' => $this->no_of_installments,
            'organization_id' => $this->organization_id,
        ]);
        $query->joinWith('customer', 'customer.customer_id = installment.customer_id')->joinWith('property', 'property.property_id = installment.property_id');
        $query->andFilterWhere(['like', 'installment_type', $this->installment_type])
            ->andFilterWhere(['like', 'remaning_amount', $this->remaning_amount])
            ->andFilterWhere(['like', 'total_amount', $this->total_amount])
            ->andFilterWhere(['like', 'name', $this->customer_id])
            ->andFilterWhere(['like', 'property_name', $this->property_id]);

        return $dataProvider;
    }
}

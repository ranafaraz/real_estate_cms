<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Installment;

/**
 * InstallmentSearch represents the model behind the search form about `backend\models\Installment`.
 */
class InstallmentSearch extends Installment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['installment_id', 'no_of_installments', 'customer_id', 'property_id', 'organization_id'], 'integer'],
            [['installment_type', 'remaning_amount', 'total_amount'], 'safe'],
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
        $id=yii::$app->user->identity->organization_id;
        $query = Installment::find()->where(['organization_id'=>$id]);

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
            'customer_id' => $this->customer_id,
            'property_id' => $this->property_id,
            'organization_id' => $this->organization_id,
        ]);

        $query->andFilterWhere(['like', 'installment_type', $this->installment_type])
            ->andFilterWhere(['like', 'remaning_amount', $this->remaning_amount])
            ->andFilterWhere(['like', 'total_amount', $this->total_amount]);

        return $dataProvider;
    }
}

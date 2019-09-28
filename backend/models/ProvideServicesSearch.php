<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ProvideServices;

/**
 * ProvideServicesSearch represents the model behind the search form about `backend\models\ProvideServices`.
 */
class ProvideServicesSearch extends ProvideServices
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['provide_services_id', 'organization_id'], 'integer'],
            [['customer_id', 'services_type_id', 'services_id'],'string'],
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
        $query = ProvideServices::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        


        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }



         $query->leftJoin('services_details', 'services_details.services_id = provide_services.services_id')->rightJoin('customer', 'customer.customer_id = provide_services.customer_id')->innerJoin('services_type', 'services_type.services_type_id = provide_services.services_type_id');

        $query->ANDFilterWhere(['like', 'name', $this->customer_id])
            ->ANDFilterWhere(['like','services_type', $this->services_type_id])
            ->ANDFilterWhere(['like','provide_name', $this->services_id]);
      

        return $dataProvider;
    }
}

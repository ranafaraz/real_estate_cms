<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\BuyPlot;

/**
 * BuyPlotSearch represents the model behind the search form of `backend\models\BuyPlot`.
 */
class BuyPlotSearch extends BuyPlot
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['buy_plot_id', 'created_by', 'updated_by'], 'integer'],
            [['property_name', 'plot_no', 'plot_area', 'plot_location','city', 'district', 'province', 'created_at', 'updated_at', 'plot_status'], 'safe'],
            [['plot_price'], 'number'],
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
        $query = BuyPlot::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->joinWith('customerId');

        // grid filtering conditions
        $query->andFilterWhere([
            'buy_plot_id' => $this->buy_plot_id,
            'plot_price' => $this->plot_price,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'property_name', $this->property_name])
            ->andFilterWhere(['like', 'plot_no', $this->plot_no])
            ->andFilterWhere(['like', 'plot_area', $this->plot_area])
            ->andFilterWhere(['like', 'plot_location', $this->plot_location])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'district', $this->district])
            ->andFilterWhere(['like', 'province', $this->province])
            ->andFilterWhere(['like', 'plot_status', $this->plot_status])
            ->andFilterWhere(['like','name' , $this->customer_id]);

        return $dataProvider;
    }
}

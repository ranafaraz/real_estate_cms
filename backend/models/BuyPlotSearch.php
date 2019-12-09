<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\BuyPlot;

/**
 * BuyPlotSearch represents the model behind the search form about `backend\models\BuyPlot`.
 */
class BuyPlotSearch extends BuyPlot
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['buy_plot_id', 'created_by', 'updated_by', 'organization_id'], 'integer'],
            [['property_name', 'plot_no', 'plot_area', 'plot_location', 'city', 'district', 'province', 'buy_date', 'created_at', 'updated_at', 'plot_status','customer_id'], 'safe'],
            [['plot_price', 'plot_paid_price'], 'number'],
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
        $query = BuyPlot::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->joinWith('customer');
        $query->andFilterWhere([
            'buy_plot_id' => $this->buy_plot_id,
            // 'customer_id' => $this->customer_id,
            'plot_price' => $this->plot_price,
            'plot_paid_price' => $this->plot_paid_price,
            'buy_date' => $this->buy_date,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'organization_id' => $this->organization_id,
        ]);

        $query->andFilterWhere(['like', 'property_name', $this->property_name])
            ->andFilterWhere(['like', 'plot_no', $this->plot_no])
            ->andFilterWhere(['like', 'plot_area', $this->plot_area])
            ->andFilterWhere(['like', 'plot_location', $this->plot_location])
            ->andFilterWhere(['like', 'customer.name', $this->customer_id])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'district', $this->district])
            ->andFilterWhere(['like', 'province', $this->province])
            ->andFilterWhere(['like', 'plot_status', $this->plot_status]);

        return $dataProvider;
    }
}

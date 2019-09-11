<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\PlotOwnerInfo;

/**
 * PlotOwnerInfoSearch represents the model behind the search form about `backend\models\PlotOwnerInfo`.
 */
class PlotOwnerInfoSearch extends PlotOwnerInfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'property_id', 'plot_no', 'organization_id'], 'integer'],
            [['start_date', 'end_date'], 'safe'],
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
        $query = PlotOwnerInfo::find();

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
            'property_id' => $this->property_id,
            'plot_no' => $this->plot_no,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'organization_id' => $this->organization_id,
        ]);

        return $dataProvider;
    }
}

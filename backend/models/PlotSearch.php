<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Plot;

/**
 * PlotSearch represents the model behind the search form about `backend\models\Plot`.
 */
class PlotSearch extends Plot
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'property_id', 'plot_no', 'organization_id'], 'integer'],
            [['plot_length', 'plot_width', 'plot_type', 'status', 'created_by', 'created_at', 'updated_by', 'updated_at','area'], 'safe'],
            [['plot_price', 'per_merla_rate'], 'number'],
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
        $query = Plot::find()->where(['organization_id'=>$id]);

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
            'plot_price' => $this->plot_price,
            'per_merla_rate' => $this->per_merla_rate,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'organization_id' => $this->organization_id,
        ]);

        $query->andFilterWhere(['like', 'plot_length', $this->plot_length])
            ->andFilterWhere(['like', 'plot_width', $this->plot_width])
            ->andFilterWhere(['like', 'plot_type', $this->plot_type])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by]);

        return $dataProvider;
    }
}

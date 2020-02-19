<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Header;

/**
 * HeaderSearch represents the model behind the search form about `backend\models\Header`.
 */
class HeaderSearch extends Header
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'contact', 'logo', 'created_by', 'created_at', 'organization_id'], 'integer'],
            [['organization_name', 'organization_address'], 'safe'],
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
        $query = Header::find();

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
            'contact' => $this->contact,
            'logo' => $this->logo,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'organization_id' => $this->organization_id,
        ]);

        $query->andFilterWhere(['like', 'organization_name', $this->organization_name])
            ->andFilterWhere(['like', 'organization_address', $this->organization_address]);

        return $dataProvider;
    }
}

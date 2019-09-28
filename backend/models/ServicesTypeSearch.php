<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ServicesType;

/**
 * ServicesTypeSearch represents the model behind the search form about `backend\models\ServicesType`.
 */
class ServicesTypeSearch extends ServicesType
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['services_type_id'], 'integer'],
            [['services_type'], 'safe'],
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
        $query = ServicesType::find()->where(['organization_id' => \Yii::$app->user->identity->organization_id]);

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
            'services_type_id' => $this->services_type_id,
        ]);

        $query->andFilterWhere(['like', 'services_type', $this->services_type]);

        return $dataProvider;
    }
}

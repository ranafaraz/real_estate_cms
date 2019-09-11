<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ServicesDetails;

/**
 * ServicesDetailsSearch represents the model behind the search form about `backend\models\ServicesDetails`.
 */
class ServicesDetailsSearch extends ServicesDetails
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['services_id', 'services_type_id', 'organization_id'], 'integer'],
            [['provide_name', 'contact_no', 'address'], 'safe'],
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
        $query = ServicesDetails::find()->where(['organization_id'=>\Yii::$app->user->identity->organization_id]);

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
            'services_id' => $this->services_id,
            'services_type_id' => $this->services_type_id,
            'organization_id' => $this->organization_id,
        ]);

        $query->andFilterWhere(['like', 'provide_name', $this->provide_name])
            ->andFilterWhere(['like', 'contact_no', $this->contact_no])
            ->andFilterWhere(['like', 'address', $this->address]);

        return $dataProvider;
    }
}

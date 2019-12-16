<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\EmployeeTypes;

/**
 * EmployeeTypesSearch represents the model behind the search form about `backend\models\EmployeeTypes`.
 */
class EmployeeTypesSearch extends EmployeeTypes
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['emp_type_id', 'created_by', 'updated_by', 'organization_id'], 'integer'],
            [['emp_type_name', 'description', 'created_at', 'updated_at'], 'safe'],
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
        $query = EmployeeTypes::find()->where(['organization_id' => \Yii::$app->user->identity->organization_id]);

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
            'emp_type_id' => $this->emp_type_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'organization_id' => $this->organization_id,
        ]);

        $query->andFilterWhere(['like', 'emp_type_name', $this->emp_type_name])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}

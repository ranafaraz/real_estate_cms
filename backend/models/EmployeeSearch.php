<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Employee;

/**
 * EmployeeSearch represents the model behind the search form about `backend\models\Employee`.
 */
class EmployeeSearch extends Employee
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['emp_id', 'emp_type_id', 'organization_id', 'created_by', 'updated_by'], 'integer'],
            [['emp_name', 'emp_cnic', 'emp_contact', 'emp_father_name', 'emp_gender', 'emp_status', 'emp_photo', 'created_at', 'updated_at'], 'safe'],
            [['salary'], 'number'],
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
        $query = Employee::find()->where(['organization_id' => \yii::$app->user->identity->organization_id]);

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
            'emp_id' => $this->emp_id,
            'emp_type_id' => $this->emp_type_id,
            'organization_id' => $this->organization_id,
            'salary' => $this->salary,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'emp_name', $this->emp_name])
            ->andFilterWhere(['like', 'emp_cnic', $this->emp_cnic])
            ->andFilterWhere(['like', 'emp_contact', $this->emp_contact])
            ->andFilterWhere(['like', 'emp_father_name', $this->emp_father_name])
            ->andFilterWhere(['like', 'emp_gender', $this->emp_gender])
            ->andFilterWhere(['like', 'emp_status', $this->emp_status])
            ->andFilterWhere(['like', 'emp_photo', $this->emp_photo]);

        return $dataProvider;
    }
}

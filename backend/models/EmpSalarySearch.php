<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\EmpSalary;

/**
 * EmpSalarySearch represents the model behind the search form about `backend\models\EmpSalary`.
 */
class EmpSalarySearch extends EmpSalary
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['emp_salary_id', 'created_by', 'updated_by', 'organization_id'], 'integer'],
            [['date', 'emp_id' ,'salary_month', 'status', 'created_at', 'updated_at'], 'safe'],
            [['paid_amount', 'remaining'], 'number'],
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
        $query = EmpSalary::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->joinWith('emp');
        $query->andFilterWhere([
            'emp_salary_id' => $this->emp_salary_id,
            'date' => $this->date,
            'paid_amount' => $this->paid_amount,
            'remaining' => $this->remaining,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'organization_id' => $this->organization_id,
        ]);

        $query->andFilterWhere(['like', 'salary_month', $this->salary_month])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'emp_name', $this->emp_id])
            ->orFilterWhere(['like','emp_cnic',$this->emp_id]);

        return $dataProvider;
    }
}

<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\InstallmentStatus;

/**
 * InstallmentStatusSearch represents the model behind the search form about `backend\models\InstallmentStatus`.
 */
class InstallmentStatusSearch extends InstallmentStatus
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'installment_id', 'installment_no'], 'integer'],
            [['installment_amount'], 'number'],
            [['status', 'date', 'paid_date', 'created_by'], 'safe'],
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
        $query = InstallmentStatus::find()->where(['organization_id'=>$id]);


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        //$query('installment');
        $query->andFilterWhere([
            'id' => $this->id,
            'installment_id' => $this->installment_id,
            'installment_no' => $this->installment_no,
            'installment_amount' => $this->installment_amount,
            'date' => $this->date,
            'paid_date' => $this->paid_date,
        ]);

        $query->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'created_by', $this->created_by]);

        return $dataProvider;
    }
}

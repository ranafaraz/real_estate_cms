<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "emp_salary".
 *
 * @property int $emp_salary_id
 * @property int $emp_id
 * @property string $date
 * @property string $salary_month
 * @property double $paid_amount
 * @property double $remaining
 * @property string $status
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 * @property int $organization_id
 *
 * @property Employee $emp
 * @property Organization $organization
 */
class EmpSalary extends \yii\db\ActiveRecord
{

    public $emp_cnic;
    public $salary;
    public $narration;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'emp_salary';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['emp_id', 'date', 'salary_month', 'paid_amount', 'remaining', 'status', 'created_by', 'created_at', 'organization_id'], 'required'],
            [['emp_id', 'created_by', 'updated_by', 'organization_id'], 'integer'],
            [['date', 'created_at', 'updated_at','narration'], 'safe'],
            [['paid_amount', 'remaining'], 'number'],
            [['status'], 'string'],
            [['salary_month'], 'string', 'max' => 11],
            [['emp_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['emp_id' => 'emp_id']],
            [['organization_id'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['organization_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'emp_salary_id' => 'Emp Salary ID',
            'emp_id' => 'Emp ID',
            'date' => 'Date',
            'salary_month' => 'Salary Month',
            'paid_amount' => 'Paid Amount',
            'remaining' => 'Remaining',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'organization_id' => 'Organization ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmp()
    {
        return $this->hasOne(Employee::className(), ['emp_id' => 'emp_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganization()
    {
        return $this->hasOne(Organization::className(), ['id' => 'organization_id']);
    }
}

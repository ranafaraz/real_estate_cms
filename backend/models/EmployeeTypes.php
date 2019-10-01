<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "employee_types".
 *
 * @property int $emp_type_id
 * @property string $emp_type_name
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property int $organization_id
 *
 * @property Employee[] $employees
 * @property Organization $organization
 */
class EmployeeTypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employee_types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['emp_type_name', 'description', 'created_at', 'updated_at', 'created_by', 'updated_by', 'organization_id'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by', 'organization_id'], 'integer'],
            [['emp_type_name'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 150],
            [['organization_id'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['organization_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'emp_type_id' => 'Emp Type ID',
            'emp_type_name' => 'Emp Type Name',
            'description' => 'Description',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'organization_id' => 'Organization ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployees()
    {
        return $this->hasMany(Employee::className(), ['emp_type_id' => 'emp_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganization()
    {
        return $this->hasOne(Organization::className(), ['id' => 'organization_id']);
    }
}

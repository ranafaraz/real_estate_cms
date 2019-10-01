<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "employee".
 *
 * @property int $emp_id
 * @property int $emp_type_id
 * @property int $
 * @property int $city_id
 * @property string $emp_name
 * @property string $emp_cnic
 * @property string $emp_contact
 * @property string $emp_father_name
 * @property string $emp_gender
 * @property string $emp_status
 * @property string $emp_photo
 * @property string $emp_driving_liscence
 * @property double $salary
 * @property string $created_at
 * @property string $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property EmpSalary[] $empSalaries
 * @property EmployeeTypes $empType
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['emp_type_id', 'emp_name', 'emp_cnic', 'emp_contact', 'emp_father_name', 'emp_gender', 'emp_status', 'emp_photo', 'salary', 'created_at', 'created_by', 'updated_by'], 'required'],
            [['emp_type_id', 'created_by', 'updated_by'], 'integer'],
            [['emp_status'], 'string'],
            [['salary'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['emp_name', 'emp_father_name'], 'string', 'max' => 20],
            [['emp_cnic', 'emp_contact'], 'string', 'max' => 15],
            [['emp_gender'], 'string', 'max' => 6],
            [['emp_photo'], 'string', 'max' => 200],
            [['emp_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => EmployeeTypes::className(), 'targetAttribute' => ['emp_type_id' => 'emp_type_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'emp_id' => 'Emp ID',
            'empType.emp_type_name' => 'Emp Type',
            'emp_name' => 'Emp Name',
            'emp_cnic' => 'Emp Cnic',
            'emp_contact' => 'Emp Contact',
            'emp_father_name' => 'Emp Father Name',
            'emp_gender' => 'Emp Gender',
            'emp_status' => 'Emp Status',
            'emp_photo' => 'Emp Photo',
            'salary' => 'Salary',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpSalaries()
    {
        return $this->hasMany(EmpSalary::className(), ['emp_id' => 'emp_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpType()
    {
        return $this->hasOne(EmployeeTypes::className(), ['emp_type_id' => 'emp_type_id']);
    }
        public function getOrganization()
    {
        return $this->hasOne(Organization::className(), ['organization_id' => 'organization_id']);
    }
}

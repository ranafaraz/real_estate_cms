<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "organization".
 *
 * @property int $id
 * @property string $name
 * @property string $organization_address
 * @property int $contact
 * @property string $logo
 * @property int $user_id
 * @property string $created_at
 *
 * @property AccountNature[] $accountNatures
 * @property BuyPlot[] $buyPlots
 * @property EmpSalary[] $empSalaries
 * @property EmployeeTypes[] $employeeTypes
 * @property Installment[] $installments
 * @property User $user
 * @property Plot[] $plots
 * @property PlotOwnerInfo[] $plotOwnerInfos
 * @property Property[] $properties
 * @property ProvideServices[] $provideServices
 * @property ServicesDetails[] $servicesDetails
 * @property ServicesType[] $servicesTypes
 */
class Organization extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'organization';
    }
     public $image_name;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'organization_address', 'contact', 'user_id', 'created_at'], 'required'],
            [[ 'user_id'], 'integer'],
            [['created_at'], 'safe'],
            [['name', 'image_name' , 'logo'], 'string', 'max' => 255],
            [['contact'] , 'string'],
            [['organization_address'], 'string', 'max' => 200],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['logo'], 'file'],
            [['organization_address'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'organization_address' => 'Organization Address',
            'contact' => 'Contact',
            'logo' => 'Logo',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[AccountNatures]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAccountNatures()
    {
        return $this->hasMany(AccountNature::className(), ['organization_id' => 'id']);
    }

    /**
     * Gets query for [[BuyPlots]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBuyPlots()
    {
        return $this->hasMany(BuyPlot::className(), ['organization_id' => 'id']);
    }

    /**
     * Gets query for [[EmpSalaries]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmpSalaries()
    {
        return $this->hasMany(EmpSalary::className(), ['organization_id' => 'id']);
    }

    /**
     * Gets query for [[EmployeeTypes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployeeTypes()
    {
        return $this->hasMany(EmployeeTypes::className(), ['organization_id' => 'id']);
    }

    /**
     * Gets query for [[Installments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInstallments()
    {
        return $this->hasMany(Installment::className(), ['organization_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * Gets query for [[Plots]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlots()
    {
        return $this->hasMany(Plot::className(), ['organization_id' => 'id']);
    }

    /**
     * Gets query for [[PlotOwnerInfos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlotOwnerInfos()
    {
        return $this->hasMany(PlotOwnerInfo::className(), ['organization_id' => 'id']);
    }

    /**
     * Gets query for [[Properties]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProperties()
    {
        return $this->hasMany(Property::className(), ['organization_id' => 'id']);
    }

    /**
     * Gets query for [[ProvideServices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProvideServices()
    {
        return $this->hasMany(ProvideServices::className(), ['organization_id' => 'id']);
    }

    /**
     * Gets query for [[ServicesDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getServicesDetails()
    {
        return $this->hasMany(ServicesDetails::className(), ['organization_id' => 'id']);
    }

    /**
     * Gets query for [[ServicesTypes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getServicesTypes()
    {
        return $this->hasMany(ServicesType::className(), ['organization_id' => 'id']);
    }
}

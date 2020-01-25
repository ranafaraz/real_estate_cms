<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property int $customer_id
 * @property int $customer_type_id
 * @property string $name
 * @property string $father_name
 * @property string $cnic_no
 * @property string $contact_no
 * @property string $email_address
 * @property string $address
 * @property int $user_id
 * @property int $organization_id
 * @property string $created_date
 *
 * @property BuyPlot[] $buyPlots
 * @property CustomerType $customerType
 * @property Installment[] $installments
 * @property PlotOwnerInfo[] $plotOwnerInfos
 * @property ProvideServices[] $provideServices
 */
class Customer extends \yii\db\ActiveRecord
{
    public $no_of_installment;
    public $amount;
    public $first_payment;
    public $date_to_paid;
    public $checkifexist =0;
    public $customerid =0;
    public $narration;
    public $status;
    public $only_create_customer;
    public $file;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
    
            [['customer_type_id', 'name', 'father_name', 'cnic_no', 'contact_no', 'email_address', 'address', 'user_id', 'organization_id', 'created_date'], 'required'],
            [['customer_type_id', 'user_id', 'organization_id'], 'integer'],
            [['created_date','checkifexist','customerid','no_of_installment','narration','status','only_create_customer'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['father_name', 'cnic_no', 'contact_no', 'email_address'], 'string', 'max' => 150],
            [['address'], 'string', 'max' => 250],
            [['image'], 'string', 'max' => 250],
            [['customer_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => CustomerType::className(), 'targetAttribute' => ['customer_type_id' => 'customer_type_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'customer_id' => 'Customer ID',
            'customer_type_id' => 'Customer Type',
            'name' => 'Name',
            'father_name' => 'Father Name',
            'cnic_no' => 'Cnic No',
            'contact_no' => 'Contact No',
            'email_address' => 'Email Address',
            'address' => 'Address',
            'file' => 'Customer Picture',
            'user_id' => 'User ID',
            'organization_id' => 'Organization ID',
            'created_date' => 'Created Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuyPlots()
    {
        return $this->hasMany(BuyPlot::className(), ['customer_id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerType()
    {
        return $this->hasOne(CustomerType::className(), ['customer_type_id' => 'customer_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstallments()
    {
        return $this->hasMany(Installment::className(), ['customer_id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlotOwnerInfos()
    {
        return $this->hasMany(PlotOwnerInfo::className(), ['customer_id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvideServices()
    {
        return $this->hasMany(ProvideServices::className(), ['customer_id' => 'customer_id']);
    }
}

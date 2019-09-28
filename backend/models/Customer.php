<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property int $customer_id
 * @property string $name
 * @property string $father_name
 * @property string $cnic_no
 * @property string $contact_no
 * @property string $email_address
 * @property string $sale_purchase_type
 * @property string $address
 * @property int $user_id
 * @property int $organization_id
 * @property string $created_date
 *
 * @property UserLogin $user
 * @property Installment[] $installments
 * @property Property[] $properties
 * @property ProvideServices[] $provideServices
 */
class Customer extends \yii\db\ActiveRecord
{

    public $no_of_installment;
    public $amount;
    public $first_payment;
    public $date_to_paid;
    public $checkifexist;
    public $customerid;
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
            [['name', 'father_name', 'cnic_no', 'contact_no', 'email_address', 'address', 'organization_id', 'created_date'], 'required'],
            [['user_id', 'organization_id'], 'integer'],
            [['created_date','checkifexist','customerid'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['cnic_no'],'unique'],
            [['father_name', 'cnic_no', 'contact_no', 'email_address'], 'string', 'max' => 150],
            [['address'], 'string', 'max' => 250],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserLogin::className(), 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'customer_id' => 'Customer ID',
            'name' => 'Name',
            'father_name' => 'Father Name',
            'cnic_no' => 'Cnic No',
            'contact_no' => 'Contact No',
            'email_address' => 'Email Address',
            'address' => 'Address',
            'user_id' => 'User ID',
            'organization_id' => 'Organization ID',
            'created_date' => 'Created Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    // public function getUser()
    // {
    //     return $this->hasOne(UserLogin::className(), ['user_id' => 'user_id']);
    // }

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
    public function getProperties()
    {
        return $this->hasMany(Property::className(), ['customer_id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvideServices()
    {
        return $this->hasMany(ProvideServices::className(), ['customer_id' => 'customer_id']);
    }
}

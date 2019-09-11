<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "installment".
 *
 * @property int $installment_id
 * @property string $installment_type
 * @property string $remaning_amount
 * @property string $total_amount
 * @property int $no_of_installments
 * @property int $customer_id
 * @property int $property_id
 * @property int $organization_id
 *
 * @property Customer $customer
 * @property Property $property
 * @property Organization $organization
 * @property InstallmentStatus[] $installmentStatuses
 */
class InstallmentPayment extends \yii\db\ActiveRecord
{

    public $paid;
    public $custm_id;
    public $installment_no;
    public $date_to_pay;
    public $plot_no;
    public $installment_amount;
    public $message;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'installment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['installment_type', 'remaning_amount', 'total_amount', 'no_of_installments', 'customer_id', 'property_id', 'organization_id','paid','date_to_pay','installment_amount','plot_no','installment_no'], 'required'],
            [['date_to_pay'],'safe'],
            [['no_of_installments', 'customer_id', 'property_id', 'organization_id'], 'integer'],
            [['installment_type', 'remaning_amount', 'total_amount','paid'], 'string', 'max' => 250],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'customer_id']],
            [['property_id'], 'exist', 'skipOnError' => true, 'targetClass' => Property::className(), 'targetAttribute' => ['property_id' => 'property_id']],
            [['organization_id'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['organization_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'installment_id' => 'Installment ID',
            'installment_type' => 'Installment Type',
            'remaning_amount' => 'Remaning Amount',
            'total_amount' => 'Total Amount',
            'no_of_installments' => 'No Of Installments',
            'customer_id' => 'Customer Name',
            'property_id' => 'Property Name',
            'organization_id' => 'Organization ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['customer_id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProperty()
    {
        return $this->hasOne(Property::className(), ['property_id' => 'property_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganization()
    {
        return $this->hasOne(Organization::className(), ['id' => 'organization_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstallmentStatuses()
    {
        return $this->hasMany(InstallmentStatus::className(), ['installment_id' => 'installment_id']);
    }
}

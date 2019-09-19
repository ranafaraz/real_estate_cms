<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "provide_services".
 *
 * @property int $provide_services_id
 * @property int $customer_id
 * @property int $services_type_id
 * @property int $services_id
 * @property int $organization_id
 *
 * @property Customer $customer
 * @property ServicesDetails $services
 * @property ServicesType $servicesType
 * @property Organization $organization
 */
class ProvideServices extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'provide_services';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id', 'services_type_id', 'services_id', 'organization_id','service_details'], 'required'],
            [['customer_id', 'services_type_id', 'services_id', 'organization_id'], 'integer'],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'customer_id']],
            [['services_id'], 'exist', 'skipOnError' => true, 'targetClass' => ServicesDetails::className(), 'targetAttribute' => ['services_id' => 'services_id']],
            [['services_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ServicesType::className(), 'targetAttribute' => ['services_type_id' => 'services_type_id']],
            [['organization_id'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['organization_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'provide_services_id' => 'Provide Services ID',
            'customer_id' => 'Customer Name',
            'services_type_id' => 'Services Type',
            'services_id' => 'Services ',
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
    public function getServices()
    {
        return $this->hasOne(ServicesDetails::className(), ['services_id' => 'services_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServicesType()
    {
        return $this->hasOne(ServicesType::className(), ['services_type_id' => 'services_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganization()
    {
        return $this->hasOne(Organization::className(), ['id' => 'organization_id']);
    }
}

<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "services_details".
 *
 * @property int $services_id
 * @property string $provide_name
 * @property string $contact_no
 * @property string $address
 * @property int $services_type_id
 * @property int $organization_id
 *
 * @property ProvideServices[] $provideServices
 * @property ServicesType $servicesType
 * @property Organization $organization
 */
class ServicesDetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'services_details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['provide_name', 'contact_no', 'address', 'services_type_id', 'organization_id'], 'required'],
            [['services_type_id', 'organization_id'], 'integer'],
            [['provide_name', 'address'], 'string', 'max' => 250],
            [['contact_no'], 'string', 'max' => 150],
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
            'services_id' => 'Services ID',
            'provide_name' => 'Provide Name',
            'contact_no' => 'Contact No',
            'address' => 'Address',
            'services_type_id' => 'Services Type ID',
            'organization_id' => 'Organization ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvideServices()
    {
        return $this->hasMany(ProvideServices::className(), ['services_id' => 'services_id']);
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

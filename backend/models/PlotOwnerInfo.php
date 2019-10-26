<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "plot_owner_info".
 *
 * @property int $id
 * @property int $customer_id
 * @property int $property_id
 * @property int $plot_no
 * @property string $start_date
 * @property string $end_date
 * @property int $organization_id
 * @property string $status
 *
 * @property Installment[] $installments
 * @property Customer $customer
 * @property Plot $plotNo
 * @property Property $property
 * @property Organization $organization
 */
class PlotOwnerInfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'plot_owner_info';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id', 'property_id', 'plot_no', 'start_date', 'end_date', 'organization_id', 'status'], 'required'],
            [['customer_id', 'property_id', 'plot_no', 'organization_id'], 'integer'],
            [['start_date', 'end_date'], 'safe'],
            [['status'], 'string'],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'customer_id']],
            [['plot_no'], 'exist', 'skipOnError' => true, 'targetClass' => Plot::className(), 'targetAttribute' => ['plot_no' => 'plot_no']],
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
            'id' => 'ID',
            'customer_id' => 'Customer ID',
            'property_id' => 'Property ID',
            'plot_no' => 'Plot No',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'organization_id' => 'Organization ID',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstallments()
    {
        return $this->hasMany(Installment::className(), ['plot_no' => 'plot_no']);
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
    public function getPlotNo()
    {
        return $this->hasOne(Plot::className(), ['plot_no' => 'plot_no']);
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
}

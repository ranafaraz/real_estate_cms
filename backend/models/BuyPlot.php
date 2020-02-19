<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "buy_plot".
 *
 * @property int $buy_plot_id
 * @property int $customer_id
 * @property string $property_name
 * @property string $plot_no
 * @property string $plot_area
 * @property float $plot_price
 * @property float $plot_paid_price
 * @property string $plot_location
 * @property string $city
 * @property string $district
 * @property string $province
 * @property string $buy_date
 * @property string $status
 * @property string $created_at
 * @property int $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 * @property string $plot_status
 * @property int $organization_id
 *
 * @property Organization $organization
 * @property Customer $customer
 */
class BuyPlot extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'buy_plot';
    }
    public $narration;
    public $due_date;
    public $pay;
    public $transaction_date;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id', 'property_name', 'plot_no', 'plot_area', 'plot_price', 'plot_paid_price', 'plot_location', 'city', 'district', 'province', 'buy_date', 'status', 'created_at', 'created_by', 'plot_status', 'organization_id','remaning_price'], 'required'],
            [['customer_id', 'created_by', 'updated_by', 'organization_id'], 'integer'],
            [['plot_price', 'plot_paid_price'], 'number'],
            [['plot_location', 'status', 'plot_status'], 'string'],
            [['buy_date', 'created_at', 'updated_at','narration','remaning_price','due_date','status','pay','transaction_date'], 'safe'],
            [['property_name'], 'string', 'max' => 255],
            [['plot_no', 'plot_area', 'city', 'district', 'province'], 'string', 'max' => 50],
            [['organization_id'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['organization_id' => 'id']],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'customer_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'buy_plot_id' => 'Buy Plot ID',
            'customer_id' => 'Customer ID',
            'property_name' => 'Property Name',
            'plot_no' => 'Plot No',
            'plot_area' => 'Plot Area',
            'plot_price' => 'Plot Price',
            'plot_paid_price' => 'Plot Paid Price',
            'plot_location' => 'Plot Location',
            'city' => 'City',
            'district' => 'District',
            'province' => 'Province',
            'buy_date' => 'Buy Date',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'plot_status' => 'Plot Status',
            'organization_id' => 'Organization ID',
        ];
    }

    /**
     * Gets query for [[Organization]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrganization()
    {
        return $this->hasOne(Organization::className(), ['id' => 'organization_id']);
    }

    /**
     * Gets query for [[Customer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['customer_id' => 'customer_id']);
    }
}

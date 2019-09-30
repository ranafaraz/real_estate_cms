<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "buy_plot".
 *
 * @property int $buy_plot_id
 * @property string $property_name
 * @property string $plot_no
 * @property string $plot_area
 * @property double $plot_price
 * @property string $plot_location
 * @property string $seller_name
 * @property string $seller_cnic
 * @property string $seller_phno
 * @property string $seller_address
 * @property string $city
 * @property string $district
 * @property string $province
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $updated_by
 * @property string $plot_status
 */
class BuyPlot extends \yii\db\ActiveRecord
{
    public $narration;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'buy_plot';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['property_name', 'plot_no', 'plot_area', 'plot_price', 'plot_location', 'city', 'district', 'province', 'created_at', 'created_by', 'plot_status'], 'required'],
            [['plot_price'], 'number'],
            [['plot_location','plot_status'], 'string'],
            [['created_at', 'updated_at','narration'], 'safe'],
            [['created_by', 'updated_by'], 'integer'],
            [['property_name'], 'string', 'max' => 255],
            [['plot_no', 'plot_area','city', 'district', 'province'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            // 'buy_plot_id' => 'Buy Plot ID',
            'customerId.name' => 'Customer Name',
            'property_name' => 'Property Name',
            'plot_no' => 'Plot No',
            'plot_area' => 'Plot Area',
            'plot_price' => 'Plot Price',
            'plot_location' => 'Plot Location',
            'city' => 'City',
            'district' => 'District',
            'province' => 'Province',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'plot_status' => 'Plot Status',
        ];
    }

    public function getCustomerId()
    {
        return $this->hasMany(Customer::className(), ['customer_id' => 'customer_id']);
    }
    public function getOrganizationId()
    {
        return $this->hasMany(Organization::className(), ['id' => 'organization_id']);
    }
}

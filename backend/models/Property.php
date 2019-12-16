<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "property".
 *
 * @property int $property_id
 * @property string $property_name
 * @property string $area
 * @property int $property_price
 * @property string $location
 * @property string $city
 * @property string $district
 * @property string $province
 * @property string $created_by
 * @property string $created_at
 * @property int $organization_id
 *
 * @property Installment[] $installments
 * @property Plot[] $plots
 * @property Organization $organization
 */
class Property extends \yii\db\ActiveRecord
{
	  public $selected_id;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'property';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['property_name', 'area', 'property_price', 'location', 'city', 'district', 'province', 'created_by', 'created_at', 'organization_id'], 'required'],
            [[ 'organization_id','no_of_plots'], 'integer'],
            [['property_price'],'number'],
            [['created_at'], 'safe'],
            [['property_name', 'location'], 'string', 'max' => 250],
            [['area'], 'string', 'max' => 50],
            [['city', 'district', 'province'], 'string', 'max' => 200],
            [['created_by'], 'string', 'max' => 150],
            [['organization_id'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['organization_id' => 'id']],
        ];
    } 

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'property_id' => 'Property ID',
            'property_name' => 'Property Name',
            'area' => 'Area (Marla\'s)',
            'property_price' => 'Property Price',
            'location' => 'Address',
            'city' => 'City',
            'district' => 'District',
            'province' => 'Province',
            'no_of_plots'=>'No. Of Plots',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'organization_id' => 'Organization ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstallments()
    {
        return $this->hasMany(Installment::className(), ['property_id' => 'property_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlots()
    {
        return $this->hasMany(Plot::className(), ['property_id' => 'property_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganization()
    {
        return $this->hasOne(Organization::className(), ['id' => 'organization_id']);
    }
}

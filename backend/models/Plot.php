<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "plot".
 *
 * @property int $id
 * @property int $property_id
 * @property int $plot_no
 * @property string $plot_length
 * @property string $plot_width
 * @property string $plot_type
 * @property double $plot_price
 * @property double $per_merla_rate
 * @property string $status
 * @property string $created_by
 * @property string $created_at
 * @property string $updated_by
 * @property string $updated_at
 * @property int $organization_id
 *
 * @property Property $property
 * @property Organization $organization
 */
class Plot extends \yii\db\ActiveRecord
{
    public $property;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'plot';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['property_id', 'plot_no', 'plot_length', 'plot_width', 'plot_type', 'plot_price', 'per_merla_rate', 'status', 'created_by', 'created_at', 'updated_by', 'updated_at', 'organization_id','area'], 'safe'],
            [['property_id', 'plot_no', 'organization_id'], 'integer'],
            [['plot_type', 'status'], 'string'],
            [['plot_price', 'per_merla_rate'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['plot_length', 'plot_width'], 'string', 'max' => 50],
            [['created_by', 'updated_by'], 'string', 'max' => 150],
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
            'property_id' => 'Property ID',
            'plot_no' => 'Plot No',
            'plot_length' => 'Plot Length',
            'plot_width' => 'Plot Width',
            'plot_type' => 'Plot Type',
            'plot_price' => 'Plot Price',
            'per_merla_rate' => 'Per Merla Rate',
            'status' => 'Status',
            'area' => 'Area (Marla)',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
            'organization_id' => 'Organization ID',
        ];
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

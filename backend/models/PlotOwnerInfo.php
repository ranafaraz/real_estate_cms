<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "plot_owner_info".
 *
 * @property int $id
 * @property int $property_id
 * @property int $plot_no
 * @property string $start_date
 * @property string $end_date
 * @property int $organization_id
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
            [['property_id', 'plot_no', 'start_date', 'organization_id'], 'required'],
            [['property_id', 'plot_no', 'organization_id'], 'integer'],
            [['start_date', 'end_date'], 'safe'],
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
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'organization_id' => 'Organization ID',
        ];
    }
}

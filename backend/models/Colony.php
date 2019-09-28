<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "colony".
 *
 * @property int $id
 * @property string $name
 * @property string $start date
 * @property string $area
 * @property double $cost_price
 * @property string $Address
 *
 * @property Property[] $properties
 */
class Colony extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'colony';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'start date', 'area', 'cost_price', 'Address'], 'required'],
            [['start date'], 'safe'],
            [['cost_price'], 'number'],
            [['Address'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['area'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'start date' => 'Start Date',
            'area' => 'Area',
            'cost_price' => 'Cost Price',
            'Address' => 'Address',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProperties()
    {
        return $this->hasMany(Property::className(), ['colony_id' => 'id']);
    }
}

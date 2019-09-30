<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "customer_type".
 *
 * @property int $customer_type_id
 * @property string $customer_type
 * @property string $created_at
 * @property int $created_by
 */
class CustomerType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_type', 'created_at', 'created_by','organization_id'], 'required'],
            [['customer_type'], 'string'],
            [['created_at'], 'safe'],
            [['created_by'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'customer_type_id' => 'Customer Type ID',
            'customer_type' => 'Customer Type',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
        ];
    }
}

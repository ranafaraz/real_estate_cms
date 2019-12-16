<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "installment_status".
 *
 * @property int $id
 * @property int $installment_id
 * @property int $installment_no
 * @property double $installment_amount
 * @property int $status
 * @property string $date
 * @property string $paid_date
 * @property string $created_by
 *
 * @property Installment $installment
 */
class InstallmentStatus extends \yii\db\ActiveRecord
{
    public $rema_amount;
    public $advance_amount;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'installment_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['installment_id', 'installment_no', 'installment_amount', 'status', 'date', 'paid_date', 'created_by'], 'required'],
            [['installment_id', 'installment_no', 'status'], 'integer'],
            [['installment_amount'], 'number'],
            [['date', 'paid_date'], 'safe'],
            [['created_by'], 'string', 'max' => 150],
            [['installment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Installment::className(), 'targetAttribute' => ['installment_id' => 'installment_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'installment_id' => 'Installment ID',
            'installment_no' => 'Installment No',
            'installment_amount' => 'Installment Amount',
            'status' => 'Status',
            'date' => 'Date',
            'paid_date' => 'Due Date',
            'created_by' => 'Created By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstallment()
    {
        return $this->hasOne(Installment::className(), ['installment_id' => 'installment_id']);
    }
}

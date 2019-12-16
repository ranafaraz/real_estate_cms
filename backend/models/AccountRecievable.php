<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "account_recievable".
 *
 * @property int $id
 * @property int $transaction__id
 * @property int $payer_id
 * @property double $amount
 * @property int $account_receivable
 * @property string $updated_by
 * @property string $updated_at
 *
 * @property PayerReceiverInfo $payer
 * @property AccountHead $accountReceivable
 */
class AccountRecievable extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'account_recievable';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['transaction_id', 'payer_id', 'amount', 'account_receivable','due_date' ,'updated_by', 'updated_at'], 'required'],
            [['transaction_id', 'payer_id'], 'integer'],
            [['amount'], 'number'],
            [['updated_at'], 'safe'],
            [['updated_by'], 'string', 'max' => 150],
            [['payer_id'], 'exist', 'skipOnError' => true, 'targetClass' => PayerReceiverInfo::className(), 'targetAttribute' => ['payer_id' => 'id']],
            // [['account_receivable'], 'exist', 'skipOnError' => true, 'targetClass' => AccountHead::className(), 'targetAttribute' => ['account_receivable' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'transaction_id' => 'Transaction ID',
            'payer_id' => 'Payer ID',
            'amount' => 'Amount',
            // 'account_receivable' => 'Account Receivable',
            'due_date' => 'Due Date',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayer()
    {
        return $this->hasOne(PayerReceiverInfo::className(), ['id' => 'payer_id']);
    }

    // public function getaccountHead()
    // {
    //     return $this->hasOne(AccountHead::className(), ['id' => 'account_receivable']);
    // }

    /**
     * @return \yii\db\ActiveQuery
     */
}

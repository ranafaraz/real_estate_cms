<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "account_payable".
 *
 * @property int $id
 * @property int $transaction_id
 * @property int $recipient_id
 * @property double $amount
 * @property int $account_payable
 * @property string $updated_at
 * @property string $updated_by
 *
 * @property Staff $accountPayable
 * @property PayerReceiverInfo $recipient
 */
class AccountPayable extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'account_payable';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['transaction_id', 'amount', 'account_payable','due_date' ,'updated_at', 'updated_by'], 'required'],
            [['transaction_id', 'account_payable'], 'integer'],
            [['amount'], 'number'],
            [['updated_at'], 'safe'],
            [['updated_by'], 'string', 'max' => 150],
            [['account_payable'], 'exist', 'skipOnError' => true, 'targetClass' => AccountHead::className(), 'targetAttribute' => ['account_payable' => 'id']],
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
            'amount' => 'Amount',
            'account_payable' => 'Account Payable',
            'due_date' => 'Due Date',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountPayable()
    {
        return $this->hasOne(AccountHead::className(), ['id' => 'account_payable']);
    }
}

<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "transactions".
 *
 * @property int $id
 * @property int $transaction_id
 * @property string $type
 * @property string $narration
 * @property int $debit_account
 * @property double $debit_amount
 * @property int $credit_account
 * @property double $credit_amount
 * @property string $date
 * @property string $ref_no
 * @property string $created_by
 * @property string $updated_by
 * @property string $updated_at
 *
 * @property AccountHead $creditAccount
 * @property AccountHead $debitAccount
 */
class receipt extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public $prev_remaning;
    public static function tableName()
    {
        return 'transactions';
    }
    
    public function rules()
    {
        return [
            [['transaction_id', 'type', 'narration', 'debit_account', 'debit_amount', 'credit_account', 'credit_amount', 'date', 'created_by','transaction_date'], 'required'],
            [['transaction_id', 'debit_account', 'credit_account'], 'integer'],
            [['type', 'narration'], 'string'],
            [['debit_amount', 'credit_amount'], 'number'],
            [['date','prev_remaning','transaction_date'], 'safe'],
            [['ref_no'], 'string', 'max' => 50],
            [['created_by'], 'string', 'max' => 150],
            [['credit_account'], 'exist', 'skipOnError' => true, 'targetClass' => AccountHead::className(), 'targetAttribute' => ['credit_account' => 'id']],
            [['debit_account'], 'exist', 'skipOnError' => true, 'targetClass' => AccountHead::className(), 'targetAttribute' => ['debit_account' => 'id']],
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
            'type' => 'Type',
            'narration' => 'Narration',
            'debit_account' => 'Debit Account',
            'debit_amount' => 'Debit Amount',
            'credit_account' => 'Credit Account',
            'credit_amount' => 'Credit Amount',
            'date' => 'Date',
            'ref_no' => 'Ref No',
            'created_by' => 'Created By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreditAccount()
    {
        return $this->hasOne(AccountHead::className(), ['id' => 'credit_account']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDebitAccount()
    {
        return $this->hasOne(AccountHead::className(), ['id' => 'debit_account']);
    }
}

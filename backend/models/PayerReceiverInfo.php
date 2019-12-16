<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "payer_receiver_info".
 *
 * @property int $id
 * @property int $head_id
 * @property string $name
 * @property string $choice
 * @property string $created_by
 * @property string $created_at
 *
 * @property AccountPayable[] $accountPayables
 * @property AccountRecievable[] $accountRecievables
 * @property AccountHead $head
 */
class PayerReceiverInfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payer_receiver_info';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['head_id', 'id', 'choice', 'created_by', 'created_at'], 'required'],
            [['head_id'], 'string'],
            [['choice'], 'string'],
            [['created_at','head_id'], 'safe'],
            [[ 'created_by'], 'string', 'max' => 150],
            [['head_id'], 'exist', 'skipOnError' => true, 'targetClass' => AccountHead::className(), 'targetAttribute' => ['head_id' => 'id']],
            [['head_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'payer_receiver_id']],
        ];
    }

    /**
     * {@inheritdoc},
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'head_id' => 'Account Name',
            'payer_receiver_id' => 'Payer/Receiver',
            'payer_receiver_id' => 'payer_receiver_id',
            'choice' => 'Choice',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    /**
     * @return \yii\db\ActiveQuery
     */

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHead()
    {
        return $this->hasOne(AccountHead::className(), ['id' => 'head_id']);
    }

    
}

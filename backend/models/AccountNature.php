<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "account_nature".
 *
 * @property int $id
 * @property int $organization_id
 * @property string $name
 * @property string $account_no
 * @property string $created_at
 *
 * @property AccountHead[] $accountHeads
 * @property Organization $organization
 */
class AccountNature extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'account_nature';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['organization_id', 'name', 'account_no', 'created_at'], 'required'],
            [['organization_id'], 'integer'],
            [['created_at'], 'safe'],
            [['name'], 'string', 'max' => 150],
            [['account_no'], 'string', 'max' => 20],
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
            'organization_id' => 'Organization Name',
            'name' => 'Name',
            'account_no' => 'Account No',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountHeads()
    {
        return $this->hasMany(AccountHead::className(), ['nature_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganization()
    {
        return $this->hasOne(Organization::className(), ['id' => 'organization_id']);
    }
}

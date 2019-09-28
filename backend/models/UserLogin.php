<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_login".
 *
 * @property int $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $password
 * @property string $cnic_no
 * @property string $contact_no
 * @property string $email_address
 * @property string $address
 * @property int $user_type_id
 *
 * @property Customer[] $customers
 * @property Property[] $properties
 * @property UserType $userType
 */
class UserLogin extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_login';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'password', 'cnic_no', 'contact_no', 'email_address', 'address', 'user_type_id'], 'required'],
            [['user_type_id'], 'integer'],
            [['first_name', 'last_name'], 'string', 'max' => 100],
            [['password', 'cnic_no', 'contact_no'], 'string', 'max' => 150],
            [['email_address', 'address'], 'string', 'max' => 250],
            [['user_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserType::className(), 'targetAttribute' => ['user_type_id' => 'user_type_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'password' => 'Password',
            'cnic_no' => 'Cnic No',
            'contact_no' => 'Contact No',
            'email_address' => 'Email Address',
            'address' => 'Address',
            'user_type_id' => 'User Type ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers()
    {
        return $this->hasMany(Customer::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProperties()
    {
        return $this->hasMany(Property::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserType()
    {
        return $this->hasOne(UserType::className(), ['user_type_id' => 'user_type_id']);
    }
}

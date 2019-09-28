<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_type".
 *
 * @property int $user_type_id
 * @property string $user_type
 *
 * @property UserLogin[] $userLogins
 */
class UserType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_type'], 'required'],
            [['user_type'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_type_id' => 'User Type ID',
            'user_type' => 'User Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserLogins()
    {
        return $this->hasMany(UserLogin::className(), ['user_type_id' => 'user_type_id']);
    }
}

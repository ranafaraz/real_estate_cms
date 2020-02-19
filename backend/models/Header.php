<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "header".
 *
 * @property int $id
 * @property string $organization_name
 * @property string $organization_address
 * @property int $contact
 * @property int $logo
 * @property int $created_by
 * @property int $created_at
 * @property int $organization_id
 */
class Header extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'header';
    }
    public $image_name;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['organization_name', 'organization_address', 'contact', 'created_by', 'created_at', 'organization_id','image_name'], 'required'],
            [['contact', 'created_by', 'created_at', 'organization_id'], 'integer'],
            [['image_name','logo'], 'string', 'max' => 255],
            [['logo'], 'file'],
            [['organization_name'], 'string', 'max' => 150],
            [['organization_address'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'organization_name' => 'Organization Name',
            'organization_address' => 'Organization Address',
            'contact' => 'Contact',
            'logo' => 'Logo',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'organization_id' => 'Organization ID',
        ];
    }
}

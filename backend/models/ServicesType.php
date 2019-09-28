<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "services_type".
 *
 * @property int $services_type_id
 * @property string $services_type
 *
 * @property ServicesDetails[] $servicesDetails
 */
class ServicesType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'services_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['services_type','organization_id'], 'required'],
            [['organization_id'],'integer'],
            [['services_type'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'services_type_id' => 'Services Type ID',
            'services_type' => 'Services Type',
            'organization_id'=>'Organization',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServicesDetails()
    {
        return $this->hasMany(ServicesDetails::className(), ['services_type_id' => 'services_type_id']);
    }
    public function getOrganization()
    {
        return $this->hasMany(Organization::className(), ['id' => 'organization_id']);
    }
}

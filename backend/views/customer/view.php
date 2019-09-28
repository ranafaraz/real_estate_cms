<?php

use yii\widgets\DetailView;
use backend\models\PlotOwnerInfo;
use backend\models\Property;

/* @var $this yii\web\View */
/* @var $model backend\models\Customer */
?>
<div class="customer-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'customer_id',
            'name',
            'father_name',
            'cnic_no',
            'contact_no',
            'email_address:email',
            'sale_purchase_type',
            'address',
            'user_id',
            'created_date',
        ],
    ]) ?>
        
    <?PHP
     $mod = PlotOwnerInfo::find()->where(['customer_id' => $model->customer_id])->andwhere(['organization_id' => \Yii::$app->user->identity->organization_id])->all();
        foreach ($mod as $value) {
        $prop_name = Property::find()->where(['property_id' => $value->property_id])->andwhere(['organization_id' => \Yii::$app->user->identity->organization_id])->One();

        ?>
    <div class="row">
        <div class="col-md-6">
            <?= DetailView::widget([
                    'model' => $prop_name,
                    'attributes' => [
                    'property_name',
                    ],
                ]) ?>
        </div>
        <div class="col-md-6">
            <?= DetailView::widget([
                'model' => $value,
                'attributes' => [
                'plot_no',
                ],
            ]) ?>
        </div>
    </div>
    <?php
        }
    ?>
</div>

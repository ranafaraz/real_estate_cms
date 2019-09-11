<?php

use yii\widgets\DetailView;

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
    <h4 class="text-danger">Property Detail</h4>
     <?= DetailView::widget([
        'model' => $prop_name,
        'attributes' => [
           'property_name',
        ],
    ]) ?>
    <h4 class="text-danger">Plot Detail </h4>
    <?= DetailView::widget([
        'model' => $mod,
        'attributes' => [
           'plot_no',
        ],
    ]) ?>
   



</div>

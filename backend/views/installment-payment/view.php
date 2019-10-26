<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\InstallmentPayment */
?>
<div class="installment-payment-view">
    <h4 class="text-danger font-weight-bold">Customer Details</h4>
 <?= DetailView::widget([
        'model' => $cus_model,
        'attributes' => [
            'name',
            'father_name',
            'cnic_no',
            'contact_no',
            'email_address',
            'created_date',
            // 'organization_id',
        ],
    ]) ?>
    <h4 class="text-danger font-weight-bold">Customer Installment Details</h4>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'installment_id',
            'installment_type',
            'advance_amount',
            'total_amount',
            'no_of_installments',
            'property.property_name',
            // 'organization_id',
        ],
    ]) ?>

    <h4 class="text-danger font-weight-bold">Customer Installment status Details</h4>

    <div class="row">
    <?php
    foreach ($install as $value) {
        ?>
        <div class="col-md-6">
            <h5 class="text-info" style="font-weight: bolder;">Install No. <u><i><?PHP echo $value->installment_no;?></i></u> Details:</h5>
            <?php if($value->status == '0')
            {
                $value->status = 'Paid';
            }
            else
            {
                $value->status = 'Unpaid';
            }?>
             <?= DetailView::widget([
                'model' => $value,
                'attributes' => [
                    'installment_no',
                    'installment_amount',
                    'status',
                    'date',
                    'paid_date',
                    'created_by',
                    // 'organization_id',
                ],
            ]) ?>
        </div>
        <?php
        }
        ?>
</div>
   




</div>

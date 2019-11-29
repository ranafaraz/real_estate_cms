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
            'customer_type_id',
            'name',
            'father_name',
            'cnic_no',
            'contact_no',
            'email_address:email',
            'address',
            'user_id',
            'organization_id',
            'created_date',
        ],
    ]) ?>

</div>

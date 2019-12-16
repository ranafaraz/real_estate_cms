<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\InstallmentStatus */
?>
<div class="installment-status-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'installment_id',
            'installment_no',
            'installment_amount',
            'status',
            'date',
            'paid_date',
            'created_by',
        ],
    ]) ?>

</div>

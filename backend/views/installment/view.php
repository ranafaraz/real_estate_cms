<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Installment */
?>
<div class="installment-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'installment_id',
            'installment_type',
            'advance_amount',
            'total_amount',
            'no_of_installments',
            'customer_id',
            'property_id',
            'organization_id',
        ],
    ]) ?>

</div>

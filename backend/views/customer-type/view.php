<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\CustomerType */
?>
<div class="customer-type-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'customer_type_id',
            'customer_type',
            'created_at',
            'created_by',
        ],
    ]) ?>

</div>

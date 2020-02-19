<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AccountPayable */
?>
<div class="account-payable-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'transaction_id',
            'amount',
            'accountPayable.account_name',
            'due_date',
            'updated_at',
            'updated_by',
        ],
    ]) ?>

</div>

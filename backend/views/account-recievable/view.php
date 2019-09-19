<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AccountRecievable */
?>
<div class="account-recievable-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'transaction_id',
            'payer.name',
            'amount',
            'accountReceivable.account_name',
            'due_date',
            'updated_by',
            'updated_at',
        ],
    ]) ?>

</div>

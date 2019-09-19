<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Transactions */
?>
<div class="transactions-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'transaction_id',
            'type',
            'narration:ntext',
            'debit_account',
            'debit_amount',
            'credit_account',
            'credit_amount',
            'date',
            'ref_no',
            'created_by',
            'updated_by',
            'updated_at',
        ],
    ]) ?>

</div>

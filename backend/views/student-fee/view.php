<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\StudentFee */
?>
<div class="student-fee-view">
 
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
            'amount',
            'balance',
            'date',
            'ref_no',
            'created_by',
            'updated_by',
            'updated_at',
        ],
    ]) ?>

</div>

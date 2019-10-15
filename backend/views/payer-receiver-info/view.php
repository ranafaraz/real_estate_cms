<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\PayerReceiverInfo */
?>
<div class="payer-receiver-info-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'head_id',
            'choice',
            'created_by',
            'created_at',
        ],
    ]) ?>

</div>

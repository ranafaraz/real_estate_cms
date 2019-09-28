<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Colony */
?>
<div class="colony-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'start date',
            'area',
            'cost_price',
            'Address:ntext',
        ],
    ]) ?>

</div>

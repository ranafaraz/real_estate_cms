<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Property */
?>
<div class="property-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'property_name',
            'property_price',
            'location',
            'city',
            'district',
            'province',
            'no_of_plots',
            'created_by',
            'created_at',
        ],
    ]) ?>

</div>

<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\PlotOwnerInfo */
?>
<div class="plot-owner-info-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'customer.name',
            'property.property_name',
            'plot_no',
            'start_date',
            'end_date',
            'organization_id',
            'status',
        ],
    ]) ?>

</div>

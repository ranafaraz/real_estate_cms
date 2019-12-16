<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\BuyPlot */
?>
<div class="buy-plot-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'buy_plot_id',
            'customer_id',
            'property_name',
            'plot_no',
            'plot_area',
            'plot_price',
            'plot_paid_price',
            'plot_location:ntext',
            'city',
            'district',
            'province',
            'buy_date',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
            'plot_status',
            'organization_id',
        ],
    ]) ?>

</div>

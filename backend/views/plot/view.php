<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Plot */
?>
<div class="plot-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'property_id',
            'plot_no',
            'plot_length',
            'plot_width',
            'plot_type',
            'plot_price',
            'per_merla_rate',
            'status',
            'created_by',
            'created_at',
            'updated_by',
            'updated_at',
            'organization_id',
        ],
    ]) ?>

</div>

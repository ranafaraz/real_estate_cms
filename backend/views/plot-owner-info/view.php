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
            'property_id',
            'plot_no',
            'start_date',
            'end_date',
            'organization_id',
        ],
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\BuyPlot */
$this->title = 'Update Buy Plot: ' . $model->buy_plot_id;
$this->params['breadcrumbs'][] = ['label' => 'Buy Plots', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->buy_plot_id, 'url' => ['view', 'id' => $model->buy_plot_id]];

?>
<div class="buy-plot-update">

    <?= $this->render('_form1', [
        'model' => $model,
        'customer_model' => $customer_model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\BuyPlot */

$this->title = $model->buy_plot_id;
$this->params['breadcrumbs'][] = ['label' => 'Buy Plots', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="buy-plot-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->buy_plot_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->buy_plot_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'customerId.name',
            'buy_plot_id',
            'property_name',
            'plot_no',
            'plot_area',
            'plot_price',
            'plot_location:ntext',
            'city',
            'district',
            'province',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
            'plot_status',
        ],
    ]) ?>

</div>

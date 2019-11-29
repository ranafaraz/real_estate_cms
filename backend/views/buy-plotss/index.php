<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BuyPlotSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Buy Plots';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="buy-plot-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Buy Plot', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'buy_plot_id',
            'customerId.name',
            'property_name',
            'plot_no',
            'plot_area',
            'plot_price',
            'plot_location:ntext',
            'city',
            'district',
            'province',
            //'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',
            //'plot_status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

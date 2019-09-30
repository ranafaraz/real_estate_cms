<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\BuyPlot */

$this->title = 'Buy Plot';
$this->params['breadcrumbs'][] = ['label' => 'Buy Plots', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="buy-plot-create">

    <?= $this->render('_form', [
        'model' => $model,
        'customer_model' => $customer_model,
    ]) ?>

</div>

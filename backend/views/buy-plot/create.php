<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\BuyPlot */

?>
<div class="buy-plot-create">
    <?= $this->render('_form', [
        'model' => $model,
        'customer_model' => $customer_model,
    ]) ?>
</div>

<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ProvideServices */
?>
<div class="provide-services-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'provide_services_id',
            'customer.name',
            'services.provide_name',
        ],
    ]) ?>

</div>

<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ServicesDetails */
?>
<div class="services-details-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'services_id',
            'provide_name',
            'contact_no',
            'address',
            
        ],
    ]) ?>

</div>

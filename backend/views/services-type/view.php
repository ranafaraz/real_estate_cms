<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ServicesType */
?>
<div class="services-type-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'services_type_id',
            'services_type',
        ],
    ]) ?>

</div>

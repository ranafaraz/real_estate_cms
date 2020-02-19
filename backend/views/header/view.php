<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Header */
?>
<div class="header-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'organization_name',
            'organization_address',
            'contact',
            'logo',
            'created_by',
            'created_at',
            'organization_id',
        ],
    ]) ?>

</div>

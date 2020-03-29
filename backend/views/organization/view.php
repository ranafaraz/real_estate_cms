<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Organization */
?>
<div class="organization-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'organization_address',
            'contact',
            'logo',
            'user_id',
            'created_at',
        ],
    ]) ?>

</div>

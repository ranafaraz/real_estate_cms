<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Organization */
?>
<div class="organization-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            
            'name',
            'user.username',
            'created_at',
        ],
    ]) ?>

</div>

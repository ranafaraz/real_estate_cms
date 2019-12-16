<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\UserType */
?>
<div class="user-type-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'user_type_id',
            'user_type',
        ],
    ]) ?>

</div>

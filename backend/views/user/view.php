<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
?>
<div class="user-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'first_name',
            'last_name',
            'username',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            'email:email',
            //'status',
            'created_at',
            'updated_at',
            //'verification_token',
            'organization_id',
        ],
    ]) ?>

<?= DetailView::widget([        
        'model' => $auth_model,
        'attributes' => [
            'item_name',
        ],
    ]) ?>

</div>

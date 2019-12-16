<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\UserLogin */
?>
<div class="user-login-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'user_id',
            'first_name',
            'last_name',
            'password',
            'cnic_no',
            'contact_no',
            'email_address:email',
            'address',
            'user_type_id',
        ],
    ]) ?>

</div>

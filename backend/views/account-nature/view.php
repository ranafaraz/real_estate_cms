<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AccountNature */
?>
<div class="account-nature-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'organization_id',
            'name',
            'account_no',
            'created_at',
        ],
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
?>
<div class="user-update">

	<?php $model->password_hash = ''; ?>

    <?= $this->render('_form', [
        'model' => $model,
        'authitems' => $authitems,
        'auth_model' => $auth_model,
    ]) ?>

</div>

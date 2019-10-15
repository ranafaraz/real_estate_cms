<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ProvideServices */
?>
<div class="provide-services-update">

    <?= $this->render('_form', [
        'model' => $model,
        'services_detail_id' => $services_detail_id,
    ]) ?>

</div>

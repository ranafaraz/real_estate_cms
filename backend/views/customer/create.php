<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Customer */

?>
<div class="customer-create">
    <?= $this->render('_form', [
        'model' => $model,
        'plotinfo' => $plotinfo,
        'installmentinfo' => $installmentinfo,
        'installmentstatus' => $installmentstatus,
    ]) ?>
</div>

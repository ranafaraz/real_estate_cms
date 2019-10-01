<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Employee */
?>
<div class="employee-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'emp_id',
            'empType.emp_type_name',
            'emp_name',
            'emp_cnic',
            'emp_contact',
            'emp_father_name',
            'emp_gender',
            'emp_status',
            'emp_photo',
            'salary',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>

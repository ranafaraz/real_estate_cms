<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\EmpSalary */
?>
<div class="emp-salary-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'emp_salary_id',
            'emp.emp_name',
            'emp.emp_cnic',
            'date',
            'salary_month',
            'paid_amount',
            'remaining',
            'status',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
            'organization_id',
        ],
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\EmployeeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employee-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'emp_id') ?>

    <?= $form->field($model, 'emp_type_id') ?>

    <?= $form->field($model, 'branch_id') ?>

    <?= $form->field($model, 'city_id') ?>

    <?= $form->field($model, 'emp_name') ?>

    <?php // echo $form->field($model, 'emp_cnic') ?>

    <?php // echo $form->field($model, 'emp_contact') ?>

    <?php // echo $form->field($model, 'emp_father_name') ?>

    <?php // echo $form->field($model, 'emp_gender') ?>

    <?php // echo $form->field($model, 'emp_status') ?>

    <?php // echo $form->field($model, 'emp_photo') ?>

    <?php // echo $form->field($model, 'emp_driving_liscence') ?>

    <?php // echo $form->field($model, 'salary') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

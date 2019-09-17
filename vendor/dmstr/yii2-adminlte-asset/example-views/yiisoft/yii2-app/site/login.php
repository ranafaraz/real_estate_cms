<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Sign In';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>

<div class="login-box">
    <div class="login-logo">
        <a href="#" style="color: #000000;font-family: georgea"><b>Real Estate</b></a>
        <hr style="margin:0px;padding:0px;">
        <p style="margin:0px;padding:0px;"><small>Powered by </small><a onclick="window.open('www.dexdevs.com')">DEXDEVS</a></p>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <div class="row">
            <img src="realestatelogo.png" class="img-responsive "alt="">
        </div>
        <p class="login-box-msg">Sign in to start your session</p>

        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

        <?= $form
            ->field($model, 'username', $fieldOptions1)
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>

        <?= $form
            ->field($model, 'password', $fieldOptions2)
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>
        
        <div class="row">
            <div class="col-sm-12 " style="padding-left: 20px;">
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
            </div>
            <!-- /.col -->
            <div class="col-sm-12">
                <?= Html::submitButton('Sign in', ['class' => 'btn btn-primary btn-block btn-flat ', 'id'=>'loginbtn','name' => 'login-button']) ?>
            </div>
            <!-- /.col -->
        </div>


        <?php ActiveForm::end(); ?>

       
    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->

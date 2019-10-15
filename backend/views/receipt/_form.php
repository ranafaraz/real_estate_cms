<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use backend\models\PayerReceiverInfo;
use backend\models\AccountHead;
use backend\models\AccountNature;
/* @var $this yii\web\View */
/* @var $model backend\models\Receipt */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="Receipt-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-5">
            <?= $form->field($model, 'transaction_id')->textInput() ?>
        </div>

        <div class="col-md-5">
            <?= $form->field($model, 'type')->dropDownList([ 'Cash Payment' => 'Cash Payment', 'Bank Payment' => 'Bank Payment', ], ['prompt' => 'Select Payment Type']) ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'receiver_payer_id')->widget(Select2::classname(), [
                'data' =>ArrayHelper::map(PayerReceiverInfo::findall(['choice'=>'Payer']),'id', 'choice'),
                'language' => 'en',
                'options' => ['placeholder' => 'Select a state ...'],

                'pluginOptions' => [
                'allowClear' => true
            ],
            ]);
        ?>
        </div>
    </div>
    <div class="row" style="margin: 20px 0px;">
        <div class="col-12 my-auto" style="border-top:2px dashed skyblue;border-bottom:2px dashed skyblue;">
            <p class="mx-auto py-2 w-100 text-center font-weight-bold" style="font-size: 20px;margin-bottom: 0px">Receiver Info</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?php 
                $natureca=AccountNature::findOne(['name'=>'Current Assets']);
                $nature_idca=$natureca->id;
                $naturefa=AccountNature::findOne(['name'=>'Fixed Assets']);
                $nature_idfa=$naturefa->id;
                $dataca=ArrayHelper::map(AccountHead::findAll(['nature_id'=>$nature_idca]),'id', 'account_name');
                $datafa=ArrayHelper::map(AccountHead::findAll(['nature_id'=>$nature_idfa]),'id', 'account_name');
            ?>
           
            <?= $form->field($model, 'debit_account')->widget(Select2::classname(), [
                'data' =>$dataca+$datafa,
                'language' => 'en',
                'options' => ['placeholder' => 'Select a state ...'],

                'pluginOptions' => [
                'allowClear' => true
            ],
            ]);
        ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'debit_amount')->textInput() ?>

        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'narration')->textarea(['rows' => 2]) ?>
        </div>
    </div>
    <div class="row" style="margin: 20px 0px;">
        <div class="col-12 my-auto" style="border-top:2px dashed skyblue;border-bottom:2px dashed skyblue;">
            <p class="mx-auto py-2 w-100 text-center font-weight-bold" style="font-size: 20px;margin-bottom: 0px">Payer Info</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?php 
                $naturein=AccountNature::findOne(['name'=>'Earning']);
                $nature_idin=$naturein->id;
                $data1=ArrayHelper::map(AccountHead::findAll(['account_name'=>'Account Receivable']),'id', 'account_name');
                $data2=ArrayHelper::map(AccountHead::findAll(['nature_id'=>$nature_idin]),'id', 'account_name');
            ?>
            <?= $form->field($model, 'credit_account')->widget(Select2::classname(), [
                'data' =>$data1+$data2,
                'language' => 'en',
                'options' => ['placeholder' => 'Select a state ...'],

                'pluginOptions' => [
                'allowClear' => true
            ],
            ]);
        ?>

            
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'credit_amount')->textInput() ?>
        </div>
    </div>

    <?= $form->field($model, 'ref_no')->textInput(['maxlength' => true,'placeholder'=>'Optional']) ?>

    <?php if (!Yii::$app->request->isAjax){ ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>

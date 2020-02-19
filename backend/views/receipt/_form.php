<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use backend\models\PayerReceiverInfo;
use backend\models\AccountHead;
use backend\models\AccountNature;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $model backend\models\Receipt */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="Receipt-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'transaction_id')->textInput(['readOnly' => true]) ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'type')->dropDownList([ 'Cash Payment' => 'Cash Payment', 'Bank Payment' => 'Bank Payment', ], ['prompt' => 'Select Payment Type']) ?>
        </div>
        <div class="col-md-4">
            <?PHP $model->transaction_date = date('Y-m-d');?>
            <?= $form->field($model,'transaction_date')->widget(
            DatePicker::className(), [
                // inline too, not bad
                 'inline' => false, 
                 // modify template for custom rendering
                // 'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
        ]);?>
        </div>
    </div>
    <div class="row" style="margin: 20px 0px;">
        <div class="col-12 my-auto" style="border-top:2px dashed skyblue;border-bottom:2px dashed skyblue;">
            <p class="mx-auto py-2 w-100 text-center font-weight-bold" style="font-size: 20px;margin-bottom: 0px">Others Info</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?php 
                $natureca=AccountNature::findOne(['name'=>'Current Assets']);
                $nature_idca=$natureca->id;

                $dataca=ArrayHelper::map(AccountHead::findAll(['nature_id'=>$nature_idca]),'id', 'account_name');

            ?>
           
            <?= $form->field($model, 'debit_account')->widget(Select2::classname(), [
                'data' =>$dataca,
                'language' => 'en',
                'options' => ['placeholder' => 'Select a state ...'],

                'pluginOptions' => [
                'allowClear' => true
                ],
                ])->label('Receiveing In');
             ?>
        </div>
        <div class="col-md-4">
            <?php 
                $nature=AccountNature::find()->where(['name'=>'Earning'])->One();
            ?>
            <?= $form->field($model, 'credit_account')->widget(Select2::classname(), [
                'data' =>ArrayHelper::map(AccountHead::find()->where(['nature_id'=>$nature->id])->all(),'id', 'account_name'),
                'language' => 'en',
                'options' => ['placeholder' => 'Select a state ...'],

                'pluginOptions' => [
                'allowClear' => true
            ],
            ])->label('Receiveing From');
        ?>

            
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'credit_amount')->textInput()->label("Amount") ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'narration')->textarea(['rows' => 2]) ?>
        </div>
    </div>

    

    <?php if (!Yii::$app->request->isAjax){ ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>

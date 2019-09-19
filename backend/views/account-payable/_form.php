<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use backend\models\AccountHead;
use backend\models\AccountNature;
use backend\models\PayerReceiverInfo;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\AccountPayable */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="account-payable-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'transaction_id')->textInput() ?>

 <!--    <?= $form->field($model, 'recipient_id')->textInput() ?> -->
    <?= $form->field($model, 'recipient_id')->widget(Select2::classname(), [
                'data' =>ArrayHelper::map(PayerReceiverInfo::find()->all(),'id','name'),
                'language' => 'en',
                'options' => ['placeholder' => 'Select a state ...'],
        
                'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
        ?>

    <?= $form->field($model, 'amount')->textInput() ?>

   <!--  <?= $form->field($model, 'account_payable')->textInput() ?> -->
   <?PHP
        $dat = AccountNature::find()->where(['name' => 'Liabilities'])->One();
        $dat1 = AccountNature::find()->where(['name' => 'Expense'])->One();
        if($dat == "")
        {
            $nature_id = 0;
        }
        else
        {
            $nature_id = $dat->id;
        }
        if($dat1 == "")
        {
            $nature_idn = 0;
        }
        else
        {
            $nature_idn = $dat1->id;
        }
        $data1 = ArrayHelper::map(AccountHead::find()->where(['nature_id' => $nature_id ])->all(),'id','account_name');
        $data2 = ArrayHelper::map(AccountHead::find()->where(['nature_id' => $nature_idn ])->all(),'id','account_name')
        
        ?> 
   <?= $form->field($model, 'account_payable')->widget(Select2::classname(), [
                'data' =>$data1+$data2,
                'language' => 'en',
                'options' => ['placeholder' => 'Select a state ...'],
        
                'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
        ?>
        <?= $form->field($model,'due_date')->widget(
            DatePicker::className(), [
                // inline too, not bad
                 'inline' => false, 
                 // modify template for custom rendering
                // 'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
        ]);
    ?>
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

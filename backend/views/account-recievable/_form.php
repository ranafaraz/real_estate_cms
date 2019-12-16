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
/* @var $model backend\models\AccountRecievable */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="account-recievable-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'transaction_id')->textInput() ?>

   <!--  <?= $form->field($model, 'payer_id')->textInput() ?> -->
   <?= $form->field($model, 'payer_id')->widget(Select2::classname(), [
                'data' =>ArrayHelper::map(PayerReceiverInfo::find()->all(),'id','choice'),
                'language' => 'en',
                'options' => ['placeholder' => 'Select a state ...'],
        
                'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
        ?>

    <?= $form->field($model, 'amount')->textInput() ?>
  <?PHP
        $dat = AccountNature::find()->where(['name' => 'Current Assets'])->One();
        if($dat == "")
        {
            $nature_id = 0;
        }
        else
        {
            $nature_id = $dat->id;
        }
        
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

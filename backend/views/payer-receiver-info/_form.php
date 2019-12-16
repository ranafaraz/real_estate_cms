<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\AccountHead;

/* @var $this yii\web\View */
/* @var $model backend\models\PayerReceiverInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="payer-receiver-info-form">

    <?php $form = ActiveForm::begin(); ?>

   <!--  <?= $form->field($model, 'head_id')->textInput() ?> -->
    <?= $form->field($model, 'head_id')->widget(Select2::classname(), [
                'data' =>ArrayHelper::map(AccountHead::find()->all(),'id','account_name'),
                'language' => 'en',
                'options' => ['placeholder' => 'Select an Account head ...'],
        
                'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
        ?>

    <?= $form->field($model, 'choice')->dropDownList([ 'Receiver' => 'Receiver', 'Payer' => 'Payer', ], ['prompt' => 'Select a Choice']) ?>

    

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

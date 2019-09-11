<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Property;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use backend\models\Plot;
use backend\models\Customer;
use dosamigos\datepicker\DatePicker;
use backend\models\InstallmentStatus;
use yii\web\JsonParser;

/* @var $this yii\web\View */
/* @var $model backend\models\InstallmentPayment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="installment-payment-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <div class="row">

        <div class="col-md-4">

             <?= $form->field($model, 'customer_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Customer::find()->all(),'customer_id','name'),
                'language' => 'en',
                'options' => ['placeholder' => 'Select a state ...'],
                'pluginOptions' => [
                    'allowClear' => true
                        ],
                        'pluginEvents' => [
                            "select2:select" => 'function() { 
                                $("#installmentpayment-custm_id").attr("value",$(this).val());
                             $.get("index.php?r=installment-payment/property&customer_id='.'"+$(this).val(),function(data){
                                console.log(data);
                                 $("#installmentpayment-property_id").html(data);
                            });
                             }',
                        ]
                    ]) 
                ?>
        </div>
        <div class="col-md-4">

             <?= $form->field($model, 'property_id')->widget(Select2::classname(), [
                'language' => 'en',
                'options' => ['placeholder' => 'Select a state ...'],
                'pluginOptions' => [
                    'allowClear' => true
                        ],
                        'pluginEvents' => [
                            "select2:select" => 'function() { 
                                 $.get("index.php?r=plot-owner-info/plots&customer_id='.'"+$("#installmentpayment-customer_id").val(),function(data){
                                    console.log(data);
                                 $("#installmentpayment-plot_no").html(data);
                            });
                             }',
                        ]
                    ]) 
                ?>
        </div>
       <!--  <?= $form->field($model, 'custm_id')->hiddenInput(['readonly'=> true])->label(false) ?> -->


        <div class="col-md-4">
            <?= $form->field($model, 'plot_no')->widget(Select2::classname(), [
                    
                    'language' => 'en',
                    'options' => ['placeholder' => 'Select a state ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                        ],
                       
                    ])
            ?>
        </div>
       
        <div class="col-md-6">
            <?= $form->field($model, 'installment_no')->textInput(['readonly'=> true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'installment_amount')->textInput(['readonly'=> true]) ?>
        </div>
         <div class="col-md-6">
            <?= $form->field($model, 'date_to_pay')->textInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'paid')->textInput() ?>
        </div>
         
        
    </div>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>


<?PHP

$script = <<< JS

    $('#installmentpayment-property_id').on('change',function()
    {
       $('#installmentpayment-plot_no').on('change',function()
       {
            var property_id = $('#installmentpayment-property_id').val();
            var plot_no = $('#installmentpayment-plot_no').val();
            $.get("index.php?r=installment-payment/price",{property_id:property_id,plot_no:plot_no},function(data)
            {
                if(data == "empty")
                {
                    $('#installmentpayment-installment_no').attr('value',"All Installment Submitted");
                    $('#installmentpayment-installment_amount').attr('value',"All Installment Submitted");
                    $('#installmentpayment-date_to_pay').attr('value',"All Installment Submitted");
                    $('#installmentpayment-paid').attr('value',"All Installment Submitted");
                }else
                {
                    data = JSON.parse(data);
                    $('#installmentpayment-installment_no').attr('value',data.installment_no);
                    $('#installmentpayment-installment_amount').attr('value',data.installment_amount);
                    $('#installmentpayment-date_to_pay').attr('value',data.paid_date);
                     $('#installmentpayment-paid').attr('value',"");
                }
                
            });
            
        }) 
    })

JS;
$this->registerJs($script);


?>

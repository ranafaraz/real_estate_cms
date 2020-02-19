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
                'data' => ArrayHelper::map(Customer::find()->where(['organization_id' => \Yii::$app->user->identity->organization_id])->all(),'customer_id','name'),
                'language' => 'en',
                'options' => ['placeholder' => 'Select a state ...'],
                'pluginOptions' => [
                    'allowClear' => true
                        ],
                        'pluginEvents' => [
                            "select2:select" => 'function() { 
                                $("#installmentpayment-custm_id").attr("value",$(this).val());
                             $.get("installment-payment/property?customer_id='.'"+$(this).val(),function(data){
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
                                 $.get("./plot-owner-info/plots?customer_id='.'"+$("#installmentpayment-customer_id").val()+"&property_id='.'"+$(this).val(),function(data){
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
       
        <div class="col-md-3">
            <?= $form->field($model, 'installment_no')->textInput(['readonly'=> true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'installment_amount')->textInput(['readonly'=> true]) ?>
        </div>
        <div class="col-md-3"> 
            <?= $form->field($model,'remaning_amount')->textInput(['readonly'=> true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'previous_pay_amount')->textInput(['readonly'=> true]) ?>
        </div>

         <div class="col-md-3">
            <?= $form->field($model, 'date_to_pay')->textInput(['readOnly' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'paid')->textInput() ?>
        </div>
        <div class="col-md-3">
            <?PHP $model->transaction_date = date('Y-m-d');?>
            <?= $form->field($model, 'transaction_date')->widget(
                    DatePicker::className(), [
                         'inline' => false, 
                         // modify template for custom rendering
                        'clientOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy-m-dd',
                            'todayHighlight' => true,
                        ],
                ]); ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'narration')->textInput() ?>
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
            $.get("./installment-payment/price",{property_id:property_id,plot_no:plot_no},function(data)
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
                    console.log(data);
                    $('#installmentpayment-installment_no').attr('value',data.installment_no);
                    
                    $('#installmentpayment-installment_amount').attr('value',data.installment_amount);
                    
                    $('#installmentpayment-date_to_pay').attr('value',data.paid_date);
                    $('#installmentpayment-paid').attr('value',data.installment_amount);

                    $.get("./installment-payment/advance",{property_id:property_id,plot_no:plot_no},function(data2)
                    {
                        var data2=JSON.parse(data2);
                        console.log(data2);
                        var get_val = $('#installmentpayment-installment_amount').val();
                        if(data2.advance_amount < get_val)
                        {
                            var minus_amount = get_val - data2.advance_amount;
                            $('#installmentpayment-previous_pay_amount').attr('value',data2.advance_amount);  
                            $('#installmentpayment-remaning_amount').attr('value',minus_amount);
                        }
                        else
                        if(data2.advance_amount > get_val)
                        {
                            var minus_amount = get_val - data2.advance_amount;
                            $('#installmentpayment-remaning_amount').attr('value',0);
                            $('#installmentpayment-previous_pay_amount').attr('value',data2.advance_amount);  
                        }
                    });
                } 
            }); 
        }) 
    })

JS;
$this->registerJs($script);


?>

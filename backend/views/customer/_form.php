<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Property;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use backend\models\Plot;
use backend\models\Installment;
use dosamigos\datepicker\DatePicker;
use backend\models\InstallmentStatus;

/* @var $this yii\web\View */
/* @var $model backend\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-form">

    <?php $form = ActiveForm::begin(['options' => ['enableClientValidation' => true]]); ?>
    <div class="row">
        <div class="col-md-12"><h3 style="font-size: 25px;margin-bottom: 20px;" class="text-danger ">Customer Info</h3></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'cnic_no')->textInput(['maxlength' => true]) ?>
        </div>
        <?= $form->field($model,'checkifexist')->hiddenInput()->label(false)?>
        <?= $form->field($model,'customerid')->hiddenInput()->label(false)?>
    </div>
    <div class="row">
        <div class="col-md-3">
             <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'father_name')->textInput(['maxlength' => true]) ?>        
        </div>
       
        <div class="col-md-3">
            <?= $form->field($model, 'contact_no')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'email_address')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
        </div>
       

    </div>
    <div class="row">
        <div class="col-md-12"><h3 style="font-size: 25px;margin-bottom: 20px;" class="text-danger ">Property/Plot Info</h3></div>
    </div>
    <div class="row">

        <div class="col-md-4">
              <?= $form->field($plotinfo, 'property_id')->dropDownList(
                    ArrayHelper::map(Property::find()->where(['organization_id' => \Yii::$app->user->identity->organization_id])->all(),'property_id','property_name'),
                    [
                        'prompt' => 'Select Service Type',
                        'onchange' => '$.post("index.php?r=plot/list&id='.'"+$(this).val(),function(data){
                            $("#plotownerinfo-plot_no").html(data);

                        });'
                    ]

                )
                ?>
        </div>
        <div class="col-md-4">

             <?= $form->field($plotinfo, 'plot_no')->widget(Select2::classname(), [
                'language' => 'en',
                'options' => ['placeholder' => 'Select a state ...'],
                'pluginOptions' => [
                    'allowClear' => true
                        ],
                        'pluginEvents' => [
                            "select2:select" => 'function() { 
                            var property_id = $("#plotownerinfo-property_id").val();
                            $.get("index.php?r=plot/plot&plot_no='.'"+$(this).val()+"&property_id='.'"+property_id,function(data){
                                 $("#installment-total_amount").attr("value",data);
                            });
                             }',
                        ]
                    ]) 
                ?>
        </div>
         <div class="col-md-4">
             <?= $form->field($plotinfo, 'start_date')->widget(
                    DatePicker::className(), [
                         'inline' => false, 
                         // modify template for custom rendering
                        'clientOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy-m-dd'
                        ]
                ]);
            ?>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12"><h3 style="font-size: 25px;margin-bottom: 20px;" class="text-danger ">Installment Info</h3></div>
    </div>
    <div class="row ">

       <div class="col-md-4">
            <?PHP $data = ['Monthly'=>'Monthly', '6 Months' => '6 Months' , 'Yearly' => 'Yearly'];?>
                <?= $form->field($installmentinfo, 'installment_type')->widget(Select2::classname(), [
                'data' => $data,
                'language' => 'en',
                'options' => ['placeholder' => 'Select a state ...'],
                'pluginOptions' => [
                    'allowClear' => true
                    ],
                ])
            ?>
        </div>
    
        <div class="col-md-4">
            <?= $form->field($installmentinfo, 'advance_amount')->textInput(['maxlength' => true]) ?>
        </div>  
        <div class="col-md-4">
            <?= $form->field($installmentinfo, 'total_amount')->textInput(['maxlength' => true]) ?>
        </div>  
         <div class="col-md-9">
            <?= $form->field($installmentinfo, 'minus_amonut')->hiddenInput(['maxlength' => true])->label(false) ?>
        </div>
        <div class="col-md-4">
            <?PHP $data = ['1' => '1 Year', '1.5' => '1.5 Year','2'=>'2 Year','2.5'=>'2.5 Year', '3' => '3 Year' ,'3.5' => '3.5 Year' , '4' => '4 Year','4.5' => '4.5 Year','5'=>'5 Year','5.5'=>'5.5 Year','6' => '6 Year','6.5' => '6.5 Year','7' => '7 Year' , '7.5' => '7.5 Year' , '8' => '8 Year' , '9' => '9 Year' , '10' => '10 Year'];?>
                <?= $form->field($installmentinfo, 'no_of_installments')->widget(Select2::classname(), [
                'data' => $data,
                'language' => 'en',
                'options' => ['placeholder' => 'Select a state ...'],
                'pluginOptions' => [
                    'allowClear' => true
                    ],
                ])
            ?>
        </div> 

       <!--  -->
    <div class="col-md-6">
        <?= $form->field($installmentstatus, 'installment_amount')->textInput() ?>
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
$(document).ready(function()
{
        $('#installment-advance_amount').on('change',function()
        {

                var advance = $('#installment-advance_amount').val();
                var total = $('#installment-total_amount').val();
                var remaning_installmented_amount = total - advance;
                $('#installment-minus_amonut').attr('value',remaning_installmented_amount);
        })

      

        $('#installment-no_of_installments').on('change',function()
        {   
            if($('#installment-installment_type').val() == 'Monthly')
                {
                    var pro_amount = $('#installment-no_of_installments').val() * 12;
                    var remaning_money = $('#installment-minus_amonut').val();
                    var rem = remaning_money/pro_amount;
                    $('#installmentstatus-installment_amount').attr('value',Math.ceil(rem)); 
                }else if($('#installment-installment_type').val() == '6 Months'){
                    var pro_amount = ($('#installment-no_of_installments').val() / 6) * 12;
                    var remaning_money = $('#installment-minus_amonut').val();
                    var rem = remaning_money/pro_amount;
                    $('#installmentstatus-installment_amount').attr('value',Math.ceil(rem)); 
                }
                else if($('#installment-installment_type').val() == 'Yearly')
                {
                    var pro_amount = (($('#installment-no_of_installments').val() / 12)*12);
                    var remaning_money = $('#installment-minus_amonut').val();
                    alert(pro_amount);
                    var rem = remaning_money/pro_amount;
                    $('#installmentstatus-installment_amount').attr('value',Math.ceil(rem)); 
                }
             
        });
                
        $('#customer-cnic_no').on('change',function()
        {
            var customer_cnic = $(this).val();
              $.get("index.php?r=customer/check-customer",{customer_cnic:customer_cnic},function(data)
                    {
                        data = JSON.parse(data);
                        if(data == "empty")
                        {
                            $('#customer-checkifexist').attr('value','0');
                        }
                        else
                        {
                            $('#customer-checkifexist').attr('value','1');
                            $('#customer-customerid').attr('value',data.customer_id);
                            $('#customer-name').attr('value',data.name);
                             $('#customer-father_name').attr('value',data.father_name);
                            $('#customer-contact_no').attr('value',data.contact_no);
                            $('#customer-email_address').attr('value',data.email_address);
                             $('#customer-address').attr('value',data.address);
                        }
                        });
            
            })
    })





JS;
$this->registerJs($script);

?>

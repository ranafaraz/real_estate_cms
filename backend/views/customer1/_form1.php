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
use backend\models\CustomerType;

/* @var $this yii\web\View */
/* @var $model backend\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-form">

    <?php $form = ActiveForm::begin(); ?>
<div class="row">
        <div class="col-md-12"><h3 style="font-size: 25px;margin-bottom: 20px;" class="text-danger ">Customer Info</h3></div>
    </div>
    <?= $form->field($model,'checkifexist')->hiddenInput()->label(false)?>
        <?= $form->field($model,'customerid')->hiddenInput()->label(false)?>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'cnic_no')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
             <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'father_name')->textInput(['maxlength' => true]) ?>        
        </div>
       
        <div class="col-md-3">
            <?= $form->field($model, 'contact_no')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'customer_type_id')->dropDownList(ArrayHelper::map(CustomerType::find()->where(['customer_type' => 'Buyer'])->all(),'customer_type_id','customer_type'), ['prompt' => 'Select Customer Type']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'email_address')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-5">
            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?PHP

$script = <<< JS
        $('#installment-installment_type').on('change',function()
    {
        var installment_type = $(this).val();
        
        if(installment_type == 'Yearly')
        {
            $('#installment-no_of_installments option').each(function()
            {   
                if($(this).val() == '1.5' || $(this).val() ==  '2.5' || $(this).val() == '3.5' || $(this).val() == '4.5')
                {
                   $(this).remove(); 
                }
            })   
        }
        else
        if(installment_type == 'Monthly' || installment_type == '6 Months')
        {
                 if($(this).val() != '1.5' || $(this).val() !=  '2.5' || $(this).val() != '3.5' || $(this).val() != '4.5')
                {
                    $("#installment-no_of_installments option").eq(2).before($("<option></option>").val("1.5").text("1.5 Year"));
                    $("#installment-no_of_installments option").eq(4).before($("<option></option>").val("2.5").text("2.5 Year"));
                    $("#installment-no_of_installments option").eq(6).before($("<option></option>").val("3.5").text("3.5 Year"));
                    $("#installment-no_of_installments option").eq(8).before($("<option></option>").val("4.5").text("4.5 Year"));
                }
        }
    })
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
          $.get("./customer/check-customer",{customer_cnic:customer_cnic,customer_type:'Buyer'},function(data)
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
                         $('#customer-customer_type_id').val(data.customer_type_id);
                    }
                    });
        
        })
JS;
$this->registerJs($script);


?>
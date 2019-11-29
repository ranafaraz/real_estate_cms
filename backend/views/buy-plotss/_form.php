<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use backend\models\Customer;
use yii\helpers\ArrayHelper;
use backend\models\CustomerType;

/* @var $this yii\web\View */
/* @var $model backend\models\BuyPlot */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="buy-plot-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-12"><h3 style="font-size: 25px;margin-bottom: 20px;" class="text-danger ">Customer Info</h3></div>
    </div>
    <?= $form->field($customer_model,'checkifexist')->hiddenInput()->label(false)?>
        <?= $form->field($customer_model,'customerid')->hiddenInput()->label(false)?>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($customer_model, 'cnic_no')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
             <?= $form->field($customer_model, 'name')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($customer_model, 'father_name')->textInput(['maxlength' => true]) ?>        
        </div>
       
        <div class="col-md-3">
            <?= $form->field($customer_model, 'contact_no')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($customer_model, 'customer_type_id')->dropDownList(ArrayHelper::map(CustomerType::find()->where(['customer_type' => 'Seller'])->all(),'customer_type_id','customer_type'), ['prompt' => 'Select Customer Type']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($customer_model, 'email_address')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-5">
            <?= $form->field($customer_model, 'address')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-danger">Property & Plot Info...</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'property_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'plot_no')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'plot_area')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'plot_price')->textInput() ?>
        </div>
    </div>
    <div class="row"> 
        <div class="col-md-3">
             <?= $form->field($model, 'plot_paid_price')->textInput() ?>
        </div>
        <div class="col-md-3">
             <?= $form->field($model, 'remaning_price')->textInput() ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model,'due_date')->widget(
                    DatePicker::className(), [
                         'inline' => false, 
                         // modify template for custom rendering
                        'clientOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy-m-dd',
                            'todayHighlight' => true,
                        ],
                ]);?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model,'buy_date')->widget(
                    DatePicker::className(), [
                         'inline' => false, 
                         // modify template for custom rendering
                        'clientOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy-m-dd',
                            'todayHighlight' => true,
                        ],
                ]);?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
           <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'district')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'province')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'plot_status')->dropDownList([ 'Owned' => 'Owned', 'Self Owned' => 'Self Owned', 'Customer Owned' => 'Customer Owned', ], ['prompt' => '']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'plot_location')->textarea(['rows' => 0]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model,'narration')->textarea(['rows' => 0])?>
        </div>
    </div>
    

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?PHP

$script = <<< JS

    $('#customer-cnic_no').on('change',function()
    {
        var customer_cnic = $(this).val();
        $.get("./customer/check-customer",{customer_cnic:customer_cnic,customer_type:'Seller'},function(data)
        {
            data = JSON.parse(data);
            if(data == "empty")
            {
                $('#-customer').attr('value','0');
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

    $('#buyplot-plot_price').on('input',function()
    {
        $('#buyplot-plot_paid_price').on('input',function()
        {
            var plot_total_price = $('#buyplot-plot_price').val();
            var paid_price = $('#buyplot-plot_paid_price').val();
            var remaining_price = plot_total_price - paid_price;
            $('#buyplot-remaning_price').val(remaining_price);
        })
    })
    $('#buyplot-plot_paid_price').on('input',function()
    {
        $('#buyplot-plot_price').on('input',function()
        {
            var plot_total_price = $('#buyplot-plot_price').val();
            var paid_price = $('#buyplot-plot_paid_price').val();
            var remaining_price = plot_total_price - paid_price;
            $('#buyplot-remaning_price').val(remaining_price);
        })
    })
JS;
$this->registerJs($script);
?>
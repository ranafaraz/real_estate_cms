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
$this->title = 'Create Customers';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="customer-form"> 

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <?= $form->field($model,'checkifexist')->hiddenInput()->label(false)?>
        <?= $form->field($model,'customerid')->hiddenInput()->label(false)?>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'cnic_no')->widget(yii\widgets\MaskedInput::class, [ 'mask' => '99999-9999999-9']) ?>
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
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'image')->fileInput(['maxlength' => true]) ?>
        </div>
    </div>
<div class="property_installment">
    <div class="row">
        <div class="col-md-12"><h3 style="font-size: 25px;margin-bottom: 20px;" class="text-danger ">Property/Plot Info</h3></div>
    </div>
    <div class="row">

        <div class="col-md-4">
              <?= $form->field($plotinfo, 'property_id')->dropDownList(
                    ArrayHelper::map(Property::find()->where(['organization_id' => \Yii::$app->user->identity->organization_id])->all(),'property_id','property_name'),
                    [
                        'prompt' => 'Select Service Type',
                        'onchange' => '$.post("plot/list?id='.'"+$(this).val(),function(data){
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
                            $.get("plot/plot?plot_no='.'"+$(this).val()+"&property_id='.'"+property_id,function(data){
                                 $("#installment-total_amount").attr("value",data);
                                 $("#installment-advance_amount").attr("value",data*.25);
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
            <?= $form->field($installmentinfo, 'total_amount')->textInput(['maxlength' => true,'readonly'=>true]) ?> 
        </div>  
        <div class="col-md-2">
             <?= $form->field($installmentinfo,'distype')->dropDownList(
                        ['amount'=>'Amount','percent'=>'Percent']
                    )    ?>
            
        </div>
        <div class="col-md-2" id="discount_percent_div" style="display: none;" >
            <label for="disper">Discount Percent</label>
            <select name="select" id="disper" class="form-control">
                <option value="-1">Not Set</option>
                <?php 
                    for ($j = 1; $j <= 50 ; $j=$j+1) {
                    ?>
                        <option value="<?php echo $j/100; ?>" > <?php echo $j; ?></option>
                    <?php
                    }
                ?>
            </select>
        </div>
            <?= $form->field($installmentinfo, 'minus_amonut')->hiddenInput(['maxlength' => true])->label(false) ?>
        
        
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($installmentinfo, 'discount_amount')->textInput() ?>
        </div>
        <div class="col-md-4">
            <label for="advancepercent">Advance Percent</label>
            <select name="select" id="advancepercent" class="form-control">
                <?php 
                    for ($i = 5; $i <= 75 ; $i=$i+5) {
                    ?>
                        <option value="<?php echo $i/100; ?>" <?php if($i==25){echo "selected";} ?> > <?php echo $i; ?></option>
                    <?php
                    }
                ?>
            </select>
        </div>
        <div class="col-md-4">
            <?= $form->field($installmentinfo, 'advance_amount')->textInput(['maxlength' => true,'readonly'=>true]) ?>
        </div> 
    </div>
    <div class="row">
        <div class="col-md-4">
                <?PHP $data = ['1' => '1 Year', '1.5' => '1.5 Year','2'=>'2 Year','2.5'=>'2.5 Year', '3' => '3 Year' ,'3.5' => '3.5 Year' , '4' => '4 Year','4.5' => '4.5 Year','5'=>'5 Year'];?>
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
        <div class="col-md-4">
            <?= $form->field($installmentstatus, 'installment_amount')->textInput() ?>
        </div>
            <div class="col-md-4">
            <?= $form->field($model, 'narration')->textInput() ?>
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
    $('#installment-distype').on('change',function(){
        var valuedis=$('#installment-distype').val();
        if(valuedis=='amount'){
            $("#installment-discount_amount").prop("readonly",false);
            $('#discount_percent_div').css('display','none');
        }
         if(valuedis=='percent'){
            $("#installment-discount_amount").prop("readonly",true);
            $('#discount_percent_div').css('display','block');
        }
    });

    $('#disper').on('change',function(){
        var discount_percent=$('#disper').val();
        var total_amount=$('#installment-total_amount').val();
        if(discount_percent == -1){
            var disam=0;
        }else{
            var disam=total_amount*discount_percent;    
        }
        
        $('#installment-discount_amount').attr('value',disam);
    });

    $("#advancepercent").on('change',function(){
        var total = $("#installment-total_amount").val();
        var percent = $("#advancepercent").val();
        $("#installment-advance_amount").attr('value',total*percent);
        });
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
                if($(this).val() != '1.5'){
                    $("#installment-no_of_installments option").eq(2).before($("<option></option>").val("1.5").text("1.5 Year"));
                } 
                if($(this).val() !=  '2.5'){
                    $("#installment-no_of_installments option").eq(4).before($("<option></option>").val("2.5").text("2.5 Year"));
                }
                if($(this).val() != '3.5'){
                    $("#installment-no_of_installments option").eq(6).before($("<option></option>").val("3.5").text("3.5 Year"));
                }
                if($(this).val() != '4.5')
                {
                    $("#installment-no_of_installments option").eq(8).before($("<option></option>").val("4.5").text("4.5 Year"));
                }
            
        }
    })
   
    $('#installment-no_of_installments').on('change',function()
    {   
        if($('#installment-installment_type').val() == 'Monthly')
            {
                var advance = $('#installment-advance_amount').val();
                var total = $('#installment-total_amount').val();
                var discount_amount = $('#installment-discount_amount').val();
                var remaning_installmented_amount = total - advance;
                remaning_installmented_amount = remaning_installmented_amount - discount_amount;
                $('#installment-minus_amonut').attr('value',remaning_installmented_amount);

                var pro_amount = $('#installment-no_of_installments').val() * 12;
                var remaning_money = $('#installment-minus_amonut').val();
                var rem = remaning_money/pro_amount;
                $('#installmentstatus-installment_amount').attr('value',Math.ceil(rem)); 
            }else if($('#installment-installment_type').val() == '6 Months'){
                var advance = $('#installment-advance_amount').val();
                var total = $('#installment-total_amount').val();
                var discount_amount = $('#installment-discount_amount').val();
                var remaning_installmented_amount = total - advance;
                remaning_installmented_amount = remaning_installmented_amount - discount_amount;
                $('#installment-minus_amonut').attr('value',remaning_installmented_amount);
                var pro_amount = ($('#installment-no_of_installments').val() / 6) * 12;
                var remaning_money = $('#installment-minus_amonut').val();
                var rem = remaning_money/pro_amount;
                $('#installmentstatus-installment_amount').attr('value',Math.ceil(rem)); 
            }
            else if($('#installment-installment_type').val() == 'Yearly')
            {
                var advance = $('#installment-advance_amount').val();
                var total = $('#installment-total_amount').val();
                var discount_amount = $('#installment-discount_amount').val();
                var remaning_installmented_amount = total - advance;
                remaning_installmented_amount = remaning_installmented_amount - discount_amount;
                $('#installment-minus_amonut').attr('value',remaning_installmented_amount);
                var pro_amount = (($('#installment-no_of_installments').val() / 12)*12);
                var remaning_money = $('#installment-minus_amonut').val();
                var rem = remaning_money/pro_amount;
                $('#installmentstatus-installment_amount').attr('value',Math.ceil(rem)); 
            }
         
    });
                
    $('#customer-cnic_no').on('change',function()
    {
        var customer_cnic = $(this).val();
          $.get("customer/check-customer",{customer_cnic:customer_cnic,customer_type:'Buyer'},function(data)
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
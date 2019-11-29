<?php
use yii\helpers\Html;

use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use backend\models\PayerReceiverInfo;
use backend\models\AccountHead;
use backend\models\AccountNature;
use backend\models\AccountPayable;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $model backend\models\Payment */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Payment';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="payment-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-5">
            <?= $form->field($model, 'transaction_id')->textInput() ?>

        </div>

        <div class="col-md-5">
            <?= $form->field($model, 'type')->dropDownList([ 'Cash Payment' => 'Cash Payment', 'Bank Payment' => 'Bank Payment', ], ['prompt' => 'Select payment Type']) ?>
        </div>
    </div>
    <div class="row" style="margin: 20px 0px;">
        <div class="col-12 my-auto" style="border-top:2px dashed skyblue;border-bottom:2px dashed skyblue;">
            <p class="mx-auto py-2 w-100 text-center font-weight-bold" style="font-size: 20px;margin-bottom: 0px">Receiver Info</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <?php
                $natureex=AccountNature::findOne(['name'=>'Expense']);
                $nature_idex=$natureex->id;
                $data1=ArrayHelper::map(AccountHead::findAll(['nature_id'=>$nature_idex]),'id', 'account_name');
            ?>
            <?= $form->field($model, 'debit_account',['options'=>['id'=>'debit_id']])->widget(Select2::classname(), [
                'data' =>$data1,
                'language' => 'en',
                'options' => ['placeholder' => 'Select a state ...'],

                'pluginOptions' => [
                'allowClear' => true
            ],
            ]);
        ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'prev_remaning')->textInput(['readonly' => true]) ?>
        </div>
        <div class="col-md-3">

            <?= $form->field($model, 'debit_amount')->textInput()->label("Total amount") ?>

        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'credit_amount')->textInput()->label("Paid amount") ?>
        </div>
        <div class="col-12">
            <div id="debitnoamaountmsg" class="text-danger font-weight-bold mx-auto text-center"></div>
        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'narration')->textarea(['rows' => 2]) ?>
        </div>
    </div>
    <div class="row" style="margin: 20px 0px;">
        <div class="col-12 my-auto" style="border-top:2px dashed skyblue;border-bottom:2px dashed skyblue;">
            <p class="mx-auto py-2 w-100 text-center font-weight-bold" style="font-size: 20px;margin-bottom: 0px">Payer Info</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?php
                $natureca=AccountNature::findOne(['name'=>'Current Assets']);
                $nature_idca=$natureca->id;
            ?>

            <?= $form->field($model, 'credit_account')->widget(Select2::classname(), [
                'data' =>ArrayHelper::map(AccountHead::findAll(['nature_id'=>$nature_idca]),'id', 'account_name'),
                'language' => 'en',
                'options' => ['placeholder' => 'Select a state ...'],

                'pluginOptions' => [
                'allowClear' => true
            ],
            ]);
        ?>
        </div>
 <!--        <div class="col-md-6 align-content-center align-middle"  >
            <label for="checkamount" style="margin-top: 30px;font-size: 16px"><input type="checkbox" name="checkamount" style="height: 16px;width: 16px;" id="checkamount"  />  Debit amount is same as Credit Amount</label>
        </div> -->

            <div class="col-md-4">
               <?= $form->field($accountpayable,'due_date')->widget(
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
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'ref_no')->textInput(['maxlength' => true,'placeholder'=>'Optional']) ?>
            </div>
        </div>

    
    <?= $form->field($model, 'updateid')->textInput() ?>
<!--     <?= $form->field($model, 'checkstate')->textInput()?> -->

	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>

</div>
<?php
$script=<<<JS
var rec_id;
var deb_id;
$('#payment-receiver_payer_id').change(function(){
    $('#payment-debit_account').change(function(){
        rec_id=$('#payment-receiver_payer_id').val();
        deb_id= $('#payment-debit_account').val();
        $.get('./account-payable/get-receiver-id',{rec_id:rec_id,deb_id:deb_id},function(heads){
                var heads = $.parseJSON(heads);
                if(heads.value=="empty"){
                    $("#debitnoamaountmsg").html("Do not have any <b>PAYABLE</b> record againt this account , Make new transaction");
                    $('#payment-updateid').attr('value',"0");
                    
                }else{
                $("#payment-debit_amount").attr('value',heads.amount);
                $('#payment-updateid').attr('value',heads.id);
                }
        });
    });
});
$('#payment-debit_account').change(function(){
    $('#payment-receiver_payer_id').change(function(){
    rec_id=$('#payment-receiver_payer_id').val();
    deb_id= $('#payment-debit_account').val();
    $.get('./account-payable/get-receiver-id',{rec_id:rec_id,deb_id:deb_id},function(heads){
    var heads = $.parseJSON(heads);
    if(heads.value=="empty"){
        $("#debitnoamaountmsg").html("Do not have any <b>PAYABLE</b> record againt this account , Make new transaction");
        $('#payment-updateid').attr('value',"0"); 
    }else{ 
        $("#payment-debit_amount").attr('value',heads.amount);
        $('#payment-updateid').attr('value',heads.id);
    }
   });
 });
});
$('#checkamount'). click(function(){
    if($(this). prop("checked") == true){
       var debit_value=$("#payment-debit_amount").val();
       $("#payment-credit_amount").attr("value",debit_value);
        $('#payable_info').css("display","block");
        $('#payment-checkstate').attr('value',"1");
    }else if($(this). prop("checked") == false){
        $('#payable_info').css("display","block");
        $('#payment-checkstate').attr('value',"0");
    }
});

$('#payment-debit_account').on('change',function()
{ 
    var id = $(this).val();
    $.get("./account-payable/get-previous",{type:'Expense',id:id},function(data)
    {
        if(data == "empty")
        {
            $('#payment-prev_remaning').attr('value','0');
        }
        else
        {
            data = JSON.parse(data);
            $('#payment-prev_remaning').attr('value',data.sum);
            $('#payment-updateid').attr('value',data.id);
        }
    })
})
// $('#payment-debit_amount').on('input',function()
// {
//     var remaning = $('#payment-remaning').val();
//     var paid = $('#payment-debit_amount').val();
//     var sum = parseInt(remaning) + parseInt(paid);
//     $('#payment-credit_amount').val(sum);
//     })
JS;
$this->registerJs($script);
?>

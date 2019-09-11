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
            
        
        <div class="col-md-3">
             <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'father_name')->textInput(['maxlength' => true]) ?>        
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'cnic_no')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'contact_no')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'email_address')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-9">
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
            <?= $form->field($installmentinfo, 'remaning_amount')->textInput(['maxlength' => true]) ?>
        </div>  
        <div class="col-md-4">
            <?= $form->field($installmentinfo, 'total_amount')->textInput(['maxlength' => true]) ?>
        </div>  
        <div class="col-md-4">
            <?PHP $data = ['1' => '1','2'=>'2', '3' => '3' , '4' => '4','5'=>'5','6' => '6', '7' => '7' , '8' => '8' , '9' => '9' , '10' => '10'];?>
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

        $('#installment-no_of_installments').on('change',function()
        {
            $('#installment-remaning_amount').on('input',function()
            {
               no_installment = $('#installment-no_of_installments').val();
               remaning_money = $('#installment-remaning_amount').val();
                var rem = remaning_money/no_installment;
                $('#installmentstatus-installment_amount').attr('value',rem);
            });   
        });

        $('#installment-remaning_amount').on('input',function()
            {
            $('#installment-no_of_installments').on('change',function()
            {
               no_installment = $('#installment-no_of_installments').val();
               remaning_money = $('#installment-remaning_amount').val();
               var rem = remaning_money/no_installment;
                $('#installmentstatus-installment_amount').attr('value',rem);
            });  
        });
    })





JS;
$this->registerJs($script);

?>

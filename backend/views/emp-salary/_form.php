<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use backend\models\Employee;
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\EmpSalary */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="emp-salary-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'emp_cnic')->widget(yii\widgets\MaskedInput::class, ['mask' => '99999-9999999-9']) ?>
        </div>
        <div class="col-md-4">
           <?= $form->field($model, 'emp_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Employee::find()->all(),'emp_id','emp_name'),
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
                    ]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'date')->widget(
                    DatePicker::className(), [
                         'inline' => false, 
                         // modify template for custom rendering
                        'clientOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy-m-dd'
                        ]
                ]);?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <label for="month">Select Salary Month</label>
            <input type="month" id="month" name="salary_month" class="form-control form input">
            <?= $form->field($model,'salary_month')->hiddenInput()->label(false)?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'salary')->textInput(['readonly' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'remaining')->textInput(['readonly' => true]) ?>
        </div>
        
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'paid_amount')->textInput() ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'status')->dropDownList([ 'Paid' => 'Paid', 'Unpaid' => 'Unpaid', 'Partially Paid' => 'Partially Paid','Advance paid' ], ['prompt' => 'Select Status']) ?>
        </div>
    </div>

 <!--    <?= $form->field($model, 'salary_month')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'paid_amount')->textInput() ?>

    <?= $form->field($model, 'remaining')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([ 'Paid' => 'Paid', 'Unpaid' => 'Unpaid', 'Partially Paid' => 'Partially Paid', 'Advance Paid' => 'Advance Paid', ], ['prompt' => '']) ?> -->

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', [ 'id' => 'submitbutton' ,  'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
<?PHP
$script = <<< JS
$(document).ready(function()
{

    $('#empsalary-emp_id').on('change',function()
    {
        var emp_id = $(this).val();
        $.get("index.php?r=employee/get-employee",{emp_id:emp_id},function(data)
             {
                if(data == "empty")
                {
                    // var emp_sal = $('#empsalary-salary').val();
                    // $('#empsalary-remaining').val(emp_sal);
                }
                else
                {
                    data = JSON.parse(data);
                    $('#empsalary-emp_cnic').val(data.emp_cnic);
                    $('#empsalary-salary').val(data.salary);
                    // $('#empsalary-remaining').val(data.remaining);  
                }
               
            });

    })
    $('#empsalary-paid_amount').on('input',function()
    {
        var paid_val = parseInt($(this).val());
        var remaning_val = parseInt($('#empsalary-remaining').val());
        if(paid_val < remaning_val)
        {
            $('#empsalary-status').val('Partially Paid');
        }
        else if(paid_val > remaning_val)
        {
            $('#submitbutton').css('display','none');
        }
        else if(paid_val == remaning_val)
        {
           $('#empsalary-status').val('Paid');
        }
        else if(paid_val == '')
        {
            $('#empsalary-status').val('Unpaid');
        }
    })

    $('#month').on('change',function()
    {
        var remaining = $('#empsalary-remaining').val();
        var salary_month = $(this).val();
        var emp_id = $('#empsalary-emp_id').val();
        $('#empsalary-salary_month').val(salary_month);
        $.get("index.php?r=emp-salary/get-data-date",{emp_id:emp_id,month:salary_month},function(data)
        {
            if(data == "empty")
            {
                var emp_sal = $('#empsalary-salary').val();
                $('#empsalary-remaining').val(emp_sal);
            }
            else
            {
                data = JSON.parse(data);
                $('#empsalary-remaining').val(data.remaining);  
            }
           
        });
    })

    $('#empsalary-paid_amount').on('input',function()
    {
            var paid_amount = $('#empsalary-paid_amount').val();
            var rem_val = $('#empsalary-remaining').val();

            if(parseInt(paid_amount) > parseInt(rem_val))
            {
                
            }else
            {
                $('#submitbutton').css('display','inline-block');
            }
    })

        // $(windows).keydown(function(event)
        // {
        //     if(event.keyCode == 13)
        //     {
        //         event.preventDefault();
        //         return false;
        //     }
        // })
    })
JS;
$this->registerJs($script);
?>
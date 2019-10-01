<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Employee;
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DatePicker;
use common\models\EmpSalary;


/* @var $this yii\web\View */
/* @var $model common\models\EmpSalary */
/* @var $form yii\widgets\ActiveForm */
$empId = $model->emp_id;
$empData = Employee::find()->where(['emp_id' => $empId])->one();
if(isset($_GET['id']))
{
    $empsalary_id = $_GET['id'];
}
$emp_model = EmpSalary::find()->where(['emp_salary_id' => $empsalary_id])->One();
if(isset($emp_model))
{
    $model->date = $emp_model->date;
    $model->salary_month =  $emp_model->salary_month;
    $model->remaining = $emp_model->remaining;
}
?>
<div class="row">
        <div class="col-md-12">
            <h2 style="text-align: center;font-family:georgia;color:#367FA9;margin-top:0px;">Update Employee Salary</h2>
        </div>
</div>
<div class="emp-salary-form" style="background-color:#efefef;padding:20px;border-top:3px solid #367FA9;">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'emp_id')->dropDownList(
                ArrayHelper::map(Employee::find()->all(),'emp_id','emp_name'),["disabled"=>"disabled" ]
            )?>

        </div>
        <div class="col-md-4">
            <?= $form->field($model, "date")->widget(
                DatePicker::className(), [
                    // inline too, not bad
                     'inline' => false,
                     // modify template for custom rendering
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true,
                    ],                     
                    ]);?>

        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'salary')->textInput(['value' => $empData->salary,'readonly' => true]) ?>
        </div>  
        <div class="col-md-4">
            <label for="month">Select Salary Month</label>
            <input type="month" id="month" value="<?PHP echo $model->salary_month;?>" name="salary_month" class="form-control form input">
            <?= $form->field($model,'salary_month')->hiddenInput()->label(false)?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'paid_amount')->textInput() ?>
        </div> 
        <div class="col-md-4">
            <?= $form->field($model, 'remaining')->textInput(['readonly' => true]) ?>
        </div>        
    </div>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'status')->dropDownList([ 'Paid' => 'Paid', 'Unpaid' => 'Unpaid', 'Partially Paid' => 'Partially Paid', 'Advanced Paid' => 'Advanced Paid',], ['prompt' => 'Select Status']) ?>
        </div>        
    </div>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
            <a href="./employee-detail-view?id=<?php echo $empId;?>" class="btn btn-danger"><i class="glyphicon glyphicon-arrow-left"></i> Back</a>
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : '<i class="glyphicon glyphicon-open"></i> Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>


<?PHP

$script = <<< JS


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
            $('#empsalary-status').val('Advanced Paid');
        }
        else if(paid_val == remaning_val)
        {
           $('#empsalary-status').val('Paid');
        }
    })
    $('#month').on('change',function()
    {
        var remaining = $('#empsalary-remaining').val();
        var salary_month = $(this).val();
        var id = $('#employee-emp_id').val();
        $('#empsalary-salary_month').val(salary_month);
          $.get("./emp-salary/get-data-date",{emp_id:id,month:salary_month},function(data)
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
        var paid_amount = parseInt($(this).val());
        var remaining = $('#empsalary-remaining').val();
        var salary = $('#empsalary-salary').val();

        var remaining = salary-paid_amount;

        $('#empsalary-remaining').val(remaining);


    })
JS;
$this->registerJs($script);

?>
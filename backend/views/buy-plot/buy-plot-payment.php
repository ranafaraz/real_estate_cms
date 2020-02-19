<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use backend\models\Customer;
use yii\helpers\ArrayHelper;
use backend\models\CustomerType;
use backend\models\BuyPlot;

/* @var $this yii\web\View */
/* @var $model backend\models\BuyPlot */
/* @var $form yii\widgets\ActiveForm */
?>
<?PHP

if(isset($_GET['id']))
{
	$id = $_GET['id'];
}
?>
<?PHP
$this->title = 'Plots Payments';
$this->params['breadcrumbs'][] = $this->title;
$model = BuyPlot::find()->where(['buy_plot_id' => $id])->andwhere(['organization_id' => \Yii::$app->user->identity->organization_id])->One();
if($model->remaning_price == 0)
{
	echo "<div class='row bg-success text-center'>
	<div class='col-md-12'><h1 class='text-success'><i class='fa fa-check'></i> Fully Paid!</h1></div></div>";
}
else{
$customer_model = Customer::find()->where(['customer_id' => $model->customer_id])->andwhere(['organization_id' => \Yii::$app->user->identity->organization_id])->One();
?>
<div class="buy-plot-form">

    <div class="row">
        <div class="col-md-12"><h3 style="font-size: 25px;margin-bottom: 20px;" class="text-danger ">Customer Info</h3></div>
    </div>
    <input type="hidden" name="buy_plot_id" id="buy_plot_id" value="<?PHP echo $id;?>">
    	<input type="hidden" name="customerid" id="cus_id" value="<?PHP echo $model->customer_id;?>">
    <div class="row" style="margin-top: 5px;">
        <div class="col-md-3">
        	<label>Cnic#</label>
        	<input type="text" name="cnic_no" readonly="" class="form-control" value="<?PHP echo $customer_model->cnic_no;?>">
        </div>
        <div class="col-md-3">
        	<label>Customer Name</label>
        	<input type="text" name="name" readonly="" class="form-control" value="<?PHP echo $customer_model->name;?>">
        </div>
       
        <div class="col-md-3">
        	<label>Contact No#</label>
        	<input type="text" name="contact_no" readonly="" class="form-control" value="<?PHP echo $customer_model->contact_no;?>">
        </div>
        <div class="col-md-3">
        	<label>Transaction Date</label>
        	<input type="date" name="transaction_date" class="form-control" id="transaction_date" value="<?PHP echo date('Y-m-d')?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-danger">Property & Plot Info...</h3>
        </div>
    </div>
    <div class="row" style="margin-top: 5px;">
        <div class="col-md-3">
        	<label>Property Name</label>
        	<input type="text" name="property_name" readonly="" class="form-control" value="<?PHP echo $model->property_name;?>">
        </div>
        <div class="col-md-3">
        	<label>Plot No#</label>
        	<input type="text" name="plot_no" readonly="" class="form-control" value="<?PHP echo $model->plot_no;?>">
        </div>
        <div class="col-md-3">
        	<label>Plot Price</label>
        	<input type="text" name="plot_price" id="total" readonly="" class="form-control" value="<?PHP echo $model->plot_price;?>">
        </div>
        <div class="col-md-3">
        	<label>Plot Paid Price</label>
        	<input type="text" name="plot_paid_price" id="paid" readonly="" class="form-control" value="<?PHP echo $model->plot_paid_price;?>">
        </div>
    </div>
    <div class="row" style="margin-top: 5px;"> 
    	<div class="col-md-3">
    		<?PHP $model->remaning_price = $model->plot_price - $model->plot_paid_price;?>
    		<label>Remaning Price</label>
    		<input type="text" name="remaning_price" id="rem" readonly="" class="form-control" value="<?PHP echo $model->remaning_price;?>">
        </div>
        <div class="col-md-3">
        	<label>Pay</label>
        	<input type="text" name="pay" class="form-control" id="pay">
        	<span id="error_msg"></span>
        </div>
        <div class="col-md-3">
        	<label>Status</label>
        	<input type="text" name="status" id="status" readonly="" class="form-control" value="<?PHP echo $model->status;?>">
        </div>
    </div>
    <div class="row" style="margin-top: 5px;">
	    <div class="col-md-12">
		<label>Transaction Narration</label>
		<textarea id="narration" class="form-control"></textarea>
		</div>  
	</div>  
    <div class="form-group">
        <button class="btn btn-success form-control-sm" name="send" id="send" style="margin-top: 5px;">Pay</button>
    </div>

</div>
<?PHP } ?>

<?PHP
$script = <<< JS
	$('#pay').on('input',function()
	{
		var pay = $('#pay').val();
		var rem = $('#rem').val();
		var paid = $('#paid').val();
		var total = $('#total').val();
		var ss = parseInt(total) - parseInt(paid);
		if(parseInt(pay) == 0 || pay == '')
		{
			$('#error_msg').html("<h6 class='text-danger'>Invalid Payment Amount!</h6>");
			$('#send').css('display',"none");
			$('#rem').val(ss);
			return false;
		}
		else if(parseInt(pay) > parseInt(ss))
		{
			$('#error_msg').html("<h6 class='text-danger'>Invalid Payment Amount!</h6>");
			$('#send').css('display',"none");
			return false;
		}
		else
		{
			$('#send').css('display',"block");
			$('#pay').css('border','1px solid green');
			$('#error_msg').html("");
			rem = parseInt(total) - (parseInt(paid) + parseInt(pay)); 
			$('#rem').val(rem);
			
			if(rem == 0)
			{
				$('#status').val('Paid');
			}
			else
			{
				$('#status').val('Partially Paid');
			}
		}
	})

	$('#send').on('click',function()
	{
		var customer_id = $('#cus_id').val();
		var rem = $('#rem').val();
		var pay = $('#pay').val();
		var paid = $('#paid').val();
		var prop_name = $('#property_name').val();
		var plot_no = $('#plot_no').val();
		var status = $('#status').val();
		var id = $('#buy_plot_id').val();
		var narration = $('#narration').val();
		var transaction_date = $('#transaction_date').val();
		$.ajax(
		{
			method : 'POST',
			url : 'submit-data',
			data : {buy_plot_id:id,remaning_price:rem,pay:pay,status:status,plot_paid_price:paid,narration:narration,transaction_date:transaction_date},
			success:function(data)
			{
				if(data == 'Ok')
				{
					window.location.href = './buy-plot';
				}
			}
		})
	})
JS;
$this->registerJs($script);

?>
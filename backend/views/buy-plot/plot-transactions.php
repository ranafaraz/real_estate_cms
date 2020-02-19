<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use backend\models\Customer;
use yii\helpers\ArrayHelper;
use backend\models\CustomerType;
use backend\models\BuyPlot;
use backend\models\Transactions;
use backend\models\Header;

$this->title = 'Buy Plot Transactions';
$this->params['breadcrumbs'][] = $this->title;

/* @var $this yii\web\View */
/* @var $model backend\models\BuyPlot */
/* @var $form yii\widgets\ActiveForm */
?>
<?PHP

if(isset($_GET['buy_plot_id']))
{
	echo "ok";
}
if(isset($_GET['id']))
{
	$id = $_GET['id'];
}
?>
<input type="hidden" name="id" id="id" value="<?PHP echo $id?>">
<?PHP

$info = BuyPlot::find()->where(['buy_plot_id' => $id])->andwhere(['organization_id' => \Yii::$app->user->identity->organization_id])->One();
// customer record

$customer = Customer::find()->where(['customer_id' => $info->customer_id])->andwhere(['organization_id' => \Yii::$app->user->identity->organization_id])->One();
// customer type 

$type = CustomerType::find()->where(['customer_type_id' => $customer->customer_type_id])->One();

// transactions 

$transaction = Transactions::find()->where(['buy_plot_id' => $id])->andwhere(['organization_id' => \Yii::$app->user->identity->organization_id])->All();
$header = Header::find()->where(['organization_id' => \Yii::$app->user->identity->organization_id])->One();
?>
<div class="row">
							<div class="col-md-12"> <tr id="printrow"><td colspan="4" ><button style="float: right;" onclick="printContent('show-record1')" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-print"></i> Print
								</button></td></tr> </div>
						</div>
						<div class="row" id="show-record1">
							<div class="row">
								<div class="col-md-2" style="margin-left:15px;">
									<img src="<?PHP echo  $header->logo;?>" class="img img-fluid img-circle" height="90px" width="90px">
								</div>
								<div class="col-md-7 text-center">
									<h2 style="text-align:center;" class="float-left"><b style="color:#00A00A"><?PHP echo $header->organization_name;?></b></h2><h6 style="text-align:center;" class="float-left"><?PHP echo $header->organization_address;?> | <?PHP echo $header->contact;?></h6>
									<h5 class="text-info font-wight-bold"><b style="color: grey"><?PHP echo date('Y-m-d');?></b></h5>
								</div>
							</div>
<div class="row">
	<div class="col-md-12" style="background-color: white;">
		<h4 class="text-success" style="font-size: 24px;">Customer Info</h4>
	</div>
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-12">
				<table class="table text-center table-hover table-bordered table-responsive" style="margin-top: 4px;">
					<tr style="background: #65c97b;color: white">
						<th>Name</th>
						<th>Cnic#</th>
						<th>Type</th>
						<th>Fath. Name</th>
						<th>Cell#</th>
						<th>Email</th>
						<th>Address</th>

					</tr>
					<tr>
						<th><?PHP echo $customer->name;?></th>
						<th><?PHP echo $customer->cnic_no;?></th>
						<th><?PHP echo $type->customer_type;?></th>
						<th><?PHP echo $customer->father_name;?></th>
						<th><?PHP echo $customer->contact_no;?></th>
						<th><?PHP echo $customer->email_address;?></th>
						<th><?PHP echo $customer->address;?></th>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12" style="background-color: white;">
		<h4 class="text-success" style="font-size: 24px;">Property Info</h4>
	</div>
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-12">
				<table class="table text-center table-hover table-bordered table-responsive" style="margin-top: 4px;">
					<tr style="background: #65c97b;color: white">
						<th>Property Name</th>
						<th>Plot No#</th>
						<th>Plot Price</th>
						<th>Paid Price</th>
						<th>Remaining Price</th>
						<th>Location</th>
						<th>City</th>
						<th>District</th>
						<th>Province</th>
						<th>Buy Date</th>
						<th>Status</th>

					</tr>
					<tr>
						<th><?PHP echo $info->property_name;?></th>
						<th><?PHP echo $info->plot_no;?></th>
						<th><?PHP echo $info->plot_price;?></th>
						<th><?PHP echo $info->plot_paid_price;?></th>
						<th><?PHP echo $info->remaning_price;?></th>
						<th><?PHP echo $info->plot_location;?></th>
						<th><?PHP echo $info->city;?></th>
						<th><?PHP echo $info->district;?></th>
						<th><?PHP echo $info->province;?></th>
						<th><?PHP echo $info->buy_date;?></th>
						<th><?PHP echo $info->status;?></th>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12" style="background-color: white;">
		<h4 class="text-success" style="font-size: 24px;">Plot Payment Transaction</h4>
	</div>
	<div class="col-md-12">
		<div class="row">
			<?PHP
			$a=0;
			?>
				<div class="col-md-12">
					<table class="table text-center">
						<tr>
							<th>Transaction  No#</th>
							<th>Transaction Amount</th>
							<th>Transaction Date</th>
						</tr>
						
						<?php foreach ($transaction as $value){
							$a=$a+1;
							$trans_date = $value->transaction_date;
							$trans_id = $value->transaction_id;
							$amount =$value->debit_amount;
							?>
						
							
							<tr>
								<th><?PHP echo $a;?></th>
								
									<th><div class="form-group">
											<input type="text" name="debit_amount[]" id="amount"  id="amount" class="form-control a" value="<?php echo $amount;?>">
											<input type="text" class="b" id="transaction_id" style="display: none !Important;" name="transaction_id[]" value="<?= $trans_id;?>">
										</div></th>
									<th>
										<div class="form-group">
											<input type="date" class="c form-control" id="transaction_date[]" name="transaction_date[]" class="form-control" value="<?php echo $trans_date;?>">
										</div>
									</th>
								
							</tr>
							<?PHP
						}?>
					</table>
					<div class="row">
							<div class="col-md-12" id="error_msg">
							</div>
						</div>
						<input type="hidden" id="status" name="status" value="<?PHP echo $info->status;?>">
					<input type="hidden" name="nt" id="nt" value="<?PHP echo $info->plot_price;?>">
						<input type="hidden" name="paidamount" id="paid" value="<?PHP echo $info->plot_paid_price;?>">
						<input type="hidden" name="rema" id="rema" value="<?PHP echo $info->remaning_price;?>">
					
					<div>
		</div>
	</div>
</div>
</div>
</div>
</div>
<div class="row">
	<div class="col-md-12">
		<button class="btn btn-success" id="update"><i class="fa fa-refresh"></i> Update</button>
	</div>
</div>
<!-- hidden inputs to see amount paid check -->

<?PHP

$script = <<< JS
	$('document').ready(function()
	{
		var total1 = 0;
		var count1 = 0;
		var i=0;
		let pay1 = new Array();
		let pay = new Array();
		let pay2 = new Array();
		let pay3 = new Array();
		$('.a').on('input',function()
		{
			var nt = $('#nt').val();
			$('.a').each(function()
			{
				var rem1 = $(this).val();
				if(rem1 == '' || rem1 == 0)
				{
					$(this).css('border','1px solid red');
					return false;
				}
				else
				{
					$(this).css('border','1px solid green');
				}
				pay1.push(rem1);
				count1 = pay1.length;
			})
			for(i=0;i<count1;i++)
			{
				total1 = parseInt(total1) + parseInt(pay1[i]);
			}

			var remaning = parseInt(nt) - parseInt(total1);
			$('#rema').val(remaning);
			if(parseInt(total1) > parseInt(nt))
			{
				$('#error_msg').css('display','block');
				$('#error_msg').html('<h4 class="text-danger">Please Enter Amount Less than total</h4>');
				$('#update').addClass('disabled');
			}
			else
			{
				$('#error_msg').css('display','none');
				$('#update').removeClass('disabled');
				if(parseInt(total1) < parseInt(nt))
				{
					var status = 'Partially Paid';
					$('#status').val(status);
				}
				else
				if(parseInt(total1) == parseInt(nt))
				{
					var status = 'Paid';
					$('#status').val(status);
				}
			}
			$('#paid').val(total1);
			pay1 = [];
			total1 = 0;
		})

		$('#update').on('click',function()
		{
			var paid = $('#paid').val();
			var remanin = $('#rema').val(); 
			var id = $('#id').val();
			var status = $('#status').val();
			$('.a').each(function()
			{
				var rem1 = $(this).val();
				pay1.push(rem1);
			})

			$('.b').each(function()
			{
				var tran = $(this).val();
				pay2.push(tran);
			})

			$('.c').each(function()
			{
				var trandate = $(this).val();
				pay3.push(trandate);
			})
			$.ajax({
				url : 'update-data',
				method:'POST',
				data:{status:status,paid:paid,remaning:remanin,id:id,transaction_date:pay3,amount:pay1,transaction_id:pay2},
				success:function(data)
				{
					if(data == 'ok')
					{
						window.location.href = './plot-transactions?id=$id';
					}
				}

			});
		})
	})
JS;
$this->registerJs($script);
?>

<script>
function printContent(el){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
	window.location.reload();
}
</script>
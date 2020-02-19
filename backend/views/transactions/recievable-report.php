<?PHP
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use backend\models\AccountHead;
use backend\models\Transactions;
use yii\helpers\Json;
use backend\models\AccountRecievable;
use backend\models\Header;
use backend\models\Customer;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\AccountNature;
use common\models\AccountTitle;
$this->title = 'Recievable Report';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
	<div class="col-md-3">
		<label>Select Account Recievable</label>
		<select id="select" class="form-control">
				<option value="0">Select an Option</option>
		<?PHP 
		$nature = AccountNature::find()->where(['name' => 'Expense'])->One();
		$ap = AccountHead::find()->where(['nature_id' => $nature->id])->andwhere(['organization_id' => \Yii::$app->user->identity->organization_id])->all();
		foreach ($ap as $value) { 
			?>	
				<option value="<?PHP echo $value->id;?>"><?PHP echo $value->account_name;?></option>
		<?PHP
			}
		?>
		</select>
	</div>
	<div class="col-md-3">
		<label>Select Start Date</label>
		<input type="date" name="s_date" id="s_date" class="form-control">
	</div>
	<div class="col-md-3">
		<label>Select End Date</label>
		<input type="date" name="e_date" id="e_date" class="form-control">
	</div>
	<div class="col-md-2" style="margin-top: 24px;">
		<button id="submit" class="btn btn-success"><i class="fa fa-search"></i> Search</button>
	</div>
</div>
<div class="row" id="showrecord">
	<div class="col-md-12">
	</div>
</div>

<?PHP

$script = <<< JS
	$('document').ready(function()
	{
		$('#select').on('change',function()
		{
			var val = $(this).val();
			var val = $('#select').val();
			if(val == 0)
			{
				$('#select').css('border','1px solid red');
				$('#select').focus();
				return false;
			}
			else
			{
				$('#select').css('border','1px solid green');
				return true;
			}
		})
		$('#submit').on('click',function()
		{
			var val = $('#select').val();
			var s_date = $('#s_date').val();
			var e_date = $('#e_date').val();
			if(val == 0 || s_date=='' || e_date == '')
			{
				if(val == 0)
				{
					$('#select').css('border','1px solid red');
					$('#select').focus();
				}
				else
				if(s_date=='')
				{
					$('#s_date').css('border','1px solid red');
					$('#s_date').focus();
				}
				else
				if(e_date == '')
				{
					$('#e_date').css('border','1px solid red');
					$('#e_date').focus();
				}
				return false;
			}
			else
			{
				$('#select').css('border','1px solid green');
				$('#s_date').css('border','1px solid green');
				$('#e_date').css('border','1px solid green');
			// ajax request
			$.ajax(
			{
				method : 'POST',
				url  : 'account-payable-data',
				data : {account_payable_id:val,s_date:s_date,e_date:e_date},
				success:function(data)
				{
					$('#showrecord').html(data);
				}
			})
		}
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
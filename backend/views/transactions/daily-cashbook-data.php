<?php 

	use backend\models\Transactions;
	use backend\models\AccountNature;
	use yii\helpers\Json;
	use backend\models\AccountHead;
	use backend\models\Organization;
?>
<?PHP
$returndata = "";
$i=0;
$arr=[];
if(isset($_POST['sdate']) && isset($_POST['edate']))
{

		$start_date = $_POST['sdate'];
		$end_date =$_POST['edate'];
			$nature = AccountNature::find()->where(['name' => 'Expense'])->One();
		$head_query = AccountHead::find()->where(['nature_id'=>$nature->id])->all();
		if(isset($head_query))
		{
			// Organization dynamic

			$Organization = Organization::find()->where(['id' => \Yii::$app->user->identity->organization_id])->One();
			$returndata.='
						<div class="row">
							<div class="col-md-12"> <tr id="printrow"><td colspan="4" ><button style="float: right;" onclick="printContent(\'show-record1\')" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-print"></i> Print
								</button></td></tr> </div>
						</div>
						<div class="row" id="show-record1">
							<div class="row">
								<div class="col-md-2" style="margin-left:15px;">
									<img src="'. $Organization->logo .'" class="img img-fluid img-circle" height="90px" width="90px">
								</div>
								<div class="col-md-7 text-center">
									<h2 style="text-align:center;" class="float-left"><b style="color:#00A00A">'.$Organization->name.'</b></h2><h6 style="text-align:center;" class="float-left">'.$Organization->organization_address.' | '.$Organization->contact.'</h6>
								</div>
							</div>
							<div class="row">
							<div class="col-md-12">
								<div class="row text-center" style="margin-top:5px !important;margin-bottom:5px !important;"><div class="col-md-12 bg-success"><h4 class="text-info font-wight-bold">Showing Report Against Date: <b class="text-danger" id="si_date1"></b> to <b class="text-danger" id="ei_date1"></b></h4>
												<b>CashBook(Payments)</b></div></div>
							</div>
						</div>';

			$returndata.='<table style="margin-top:10px !important" class="table table-responsive tbale-bordered table-striped">';
			$returndata.='<tr>
							<th class="text-center text-dark bg-success">sr#</th>
							<th class="text-center text-dark bg-success">TransID</th>
							<th class="text-center text-dark bg-success">Date</th>
							<th class="text-center text-dark bg-success">Type</th>
							<th class="text-center text-dark bg-success">Account Name</th>
							<th class="text-center text-dark bg-success">Narration</th>
							<th class="text-center text-dark bg-success">Cash</th>
							<th class="text-center text-dark bg-success">Bank</th>
						</tr>';
			$sum=0;
			$sum1=0;
			foreach ($head_query as $value) {
			$debit_transactions = Transactions::find()->where(['between', 'transaction_date', "$start_date", "$end_date"])->andwhere(["debit_account" => $value->id])->andwhere(['organization_id' => \Yii::$app->user->identity->organization_id])->all();
			// $credit_transactions = Transactions::find()->where(['between', 'date', "$start_date", "$end_date"])->andwhere(["credit_account" => $id])->andwhere(['account_title_id' => $acc_title->id])->all();
			$a=0;
			foreach($debit_transactions as $val1)
			{
				$a=$a+1;
				$head_model_debit = AccountHead::find()->where(["id" => $val1->debit_account])->One();
				//$sum_debit = $sum_debit + $val1->amount;
		
				$returndata.='<tr class="text-center"><td>'.$a.'</td><td>'.$val1->transaction_id.'</td>
				<td>'.$val1->transaction_date.'</td><td>'.$val1->type.'</td>
					<td>'. $head_model_debit->account_name.'</td><td>'.$val1->narration.'</td>';
					if($val1->type == "Cash Payment")
					{
						$sum = $sum + $val1->credit_amount;
						$returndata.='<td>'.number_format($val1->credit_amount).'</td>
						<td>0</td>
						</tr>';
					}
					else if($val1->type == "Bank Payment")
					{
						$sum1 = $sum1 + $val1->credit_amount;
						$returndata.='<td>0</td>
						<td>'.number_format($val1->credit_amount).'</td>

						</tr>';
					}
			}
		}
			$returndata.='<tr class="text-primary"><th colspan="6" class="text-right">Total:</th><th class="text-center">'.number_format($sum).'</th><th class="text-center">'.number_format($sum1).'</th></tr>';
			$returndata.='<tr class="text-primary"><th colspan="6" class="text-right">Total Payment:</th><th class="text-center" colspan="2">'.number_format($sum + $sum1).'</th></tr></table></div>';
		}
	}
echo $returndata;
?>

<?PHP
use backend\models\Organization;
use backend\models\AccountHead;
use backend\models\Transactions;
use backend\models\AccountPayable;
if(isset($_POST['account_recievable_id']) && isset($_POST['s_date']) && isset($_POST['e_date']))
{
	$account_payable_id = $_POST['account_recievable_id'];
	$start_date = date('Y-m-d',strtotime($_POST['s_date']));
	$end_date = date('Y-m-d',strtotime($_POST['e_date']));
	$returndata = '';
	$mod = AccountHead::find()->where(['id' => $account_payable_id])->andwhere(['organization_id' => \Yii::$app->user->identity->organization_id])->One(); 
	$header = Organization::find()->where(['id' => \Yii::$app->user->identity->organization_id])->One();
			$returndata.='
						<div class="row">
							<div class="col-md-12"> <tr id="printrow"><td colspan="4" ><button style="float: right;" onclick="printContent(\'show-record1\')" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-print"></i> Print
								</button></td></tr> </div>
						</div>
						<div class="row" id="show-record1">
							<div class="row">
								<div class="col-md-2" style="margin-left:15px;">
									<img src="'. $header->logo .'" class="img img-fluid img-circle" height="90px" width="90px" style="margin-left:5px;">
								</div>
								<div class="col-md-8 text-center">
									<h2 style="text-align:center;" class="float-left"><b style="color:#00A00A">'.$header->name.'</b></h2><h6 style="text-align:center;" class="float-left">'.$header->organization_address.' | '.$header->contact.'</h6>
								</div>
							</div>
							<div class="row">
							<div class="col-md-12">
								<div class="row text-center" style="background:dodgerblue;margin-top:5px !important;margin-bottom:5px !important;"><div class="col-md-12"><h4 class="text-info font-wight-bold">Showing Report Against: <b class="text-danger" id="si_date1">'.$mod->account_name.'</b></h4>
												<b>Payable Report</b></div></div>
							</div>
						</div>';
					$returndata.='<div class="row" style="margin:0px;"><div class="col-md-12"><h4 style="margin-left:10px;">Transactions Info</h4></div></div><table style="margin-top:10px !important" class="table  table-responsive tbale-bordered table-striped">
						<tr>
							<th class="text-center text-dark bg-primary">sr#</th>
							<th class="text-center text-dark bg-primary">TransID</th>
							<th class="text-center text-dark bg-primary">D.A / A.p</th>
							<th class="text-center text-dark bg-primary">Credit Account</th>
							<th class="text-center text-dark bg-primary">Amount</th>
							<th class="text-center text-dark bg-primary">Transaction Date</th>
							<th class="text-center text-dark bg-primary">Narration</th>

							<th class="text-center text-dark bg-primary">Created At</th>
						</tr>';
						$sum1=0;
					$trans_value = Transactions::find()->where(['BETWEEN','transaction_date' , $start_date,$end_date])->andwhere(['credit_account' => $account_payable_id])->andwhere(['organization_id' => \Yii::$app->user->identity->organization_id])->all();
					if(empty($trans_value))
					{
						$returndata.= "<tr><th class='text-danger text-center' colspan='8'>Sorry! No Record Found From Transactions!</th></tr>";
					}
					else
					{
						$a=0;
						foreach ($trans_value as $val) {
							$mod1 = AccountHead::find()->where(['id' => $val->debit_account])->andwhere(['organization_id' => \Yii::$app->user->identity->organization_id])->One(); 
							$mod2 = AccountHead::find()->where(['id' => $val->credit_account])->andwhere(['organization_id' => \Yii::$app->user->identity->organization_id])->One(); 
							$a=$a+1;
						$returndata.='<tr>
										<th class="text-center">'.$a.'</th>
										<th class="text-center">'.$val->transaction_id.'</th>
										<th class="text-center">'.$mod1->account_name.'</th>
										<th class="text-center">'.$mod2->account_name.'</th>
										<th class="text-center">'.number_format($val->credit_amount).'</th>
										<th class="text-center">'.$val->transaction_date.'</th>
										<th class="text-center">'.$val->narration.'</th>
										<th class="text-center">'.$val->date.'</th>
									</tr>';
							$sum1 = $sum1 + $val->credit_amount;
						}
							$returndata.='<tr style="background:grey;color:white"><th colspan="4" class="text-center">Total Payable Paid</th><th class="text-center">'.number_format($sum1).'</th></tr></table>';
					}

		$returndata.='</div></div>';
	echo $returndata;
}
?>
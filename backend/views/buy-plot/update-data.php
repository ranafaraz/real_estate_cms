<?PHP
use backend\models\Transactions;
use backend\models\BuyPlot;
use yii\helpers\Json;
if(isset($_POST['status']) && isset($_POST['paid']) && isset($_POST['remaning']) && isset($_POST['id']) && isset($_POST['transaction_date']) && isset($_POST['amount']) && isset($_POST['transaction_id']))
{

	 $paid = $_POST['paid'];
	 $rem = $_POST['remaning'];
	 $buy_plot_id = $_POST['id'];
	 $transaction_id = $_POST['transaction_id'];
	 $transaction_date = $_POST['transaction_date'];
	 $amount = $_POST['amount'];
	 $status = $_POST['status'];

	$connection = \Yii::$app->db;

	$connection->createCommand()->update('buy_plot',
	[
		'plot_paid_price' => $paid,
		'remaning_price' => $rem,
		'status' => $status,
	],['buy_plot_id' => $buy_plot_id])->execute();
		$count = count($transaction_id);
		for($i=0;$i<$count;$i++)
		{
			$date = date('Y-m-d',strtotime($transaction_date[$i]));
			$check1[] = $connection->createCommand()->update('transactions',
			[
				'debit_amount' => $amount[$i],
				'credit_amount' => $amount[$i],
				'transaction_date' => $date,
			],['transaction_id' => $transaction_id[$i]])->execute();
		}
	echo  'ok';
}

?>
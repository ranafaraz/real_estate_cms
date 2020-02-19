<?PHP
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use backend\models\Customer;
use backend\models\AccountHead;
use backend\models\Transactions;
use yii\helpers\ArrayHelper;
use backend\models\CustomerType;
use backend\models\BuyPlot;
if(isset($_POST['buy_plot_id']) && isset($_POST['pay']) && isset($_POST['status']) && isset($_POST['remaning_price']) && isset($_POST['plot_paid_price']) && isset($_POST['narration']) && isset($_POST['transaction_date']))
	{
		$buy_plot_id = $_POST['buy_plot_id'];
		$pay = $_POST['pay'];
		$status = $_POST['status'];
		$remaning_price = $_POST['remaning_price'];
		$plot_paid_price = $_POST['plot_paid_price'];
		$narration = $_POST['narration'];
		$transaction_date = $_POST['transaction_date'];
		$connection = Yii::$app->db;
		$plot_paid_price = $plot_paid_price + $pay;
		$ok = $connection->createCommand()->update('buy_plot',
			[
				'remaning_price' => $remaning_price,
				'plot_paid_price' => $plot_paid_price,
				'status' => $status,
			],['buy_plot_id' => $buy_plot_id]
		)->execute();
		$trans_model= Transactions::find()->orderBy(['transaction_id' => SORT_DESC])->One();
                $cash_model = AccountHead::find()->where(['account_name' => 'Cash'])->One();
                $plot_model = AccountHead::find()->where(['account_name' => 'Account Payable'])->One();
                if($trans_model == "")
                {
                    $transaction_id = '1'; 
                }
                else
                {
                      $transaction_id = $trans_model->transaction_id + 1;  
                }

                if(empty($plot_model))
                {
                    echo "Sorry No Account Head Found Name 'Plot'";
                    die();
                }
                if(empty($cash_model))
                {
                    echo "Sorry No Account Head Found Name 'Cash'";
                    die();
                }
                $connection->createCommand()->insert('transactions',
                    [
                        'transaction_id' => $transaction_id,
                        'type' => 'Cash Payment',
                        'buy_plot_id' => $buy_plot_id,
                        'narration' => $narration,
                        'debit_account' => $plot_model->id,
                        'debit_amount' => $pay,
                        'credit_account' => $cash_model->id,
                        'credit_amount' => $pay,
                        'transaction_date' => $transaction_date,
                        'date' => date('Y-m-d'),
                        'created_by' => \Yii::$app->user->identity->id,
                        'organization_id' => \Yii::$app->user->identity->organization_id,
                    ]
                )->execute();
		echo 'Ok';
	}
	else
	{
		echo "no";
	}
?>
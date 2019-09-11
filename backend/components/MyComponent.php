<?php 
namespace backend\components;

use Yii;
use yii\base\Component;
use backend\models\Installment;
use backend\models\InstallmentStatus;


/**
  * 
  */
 class MyComponent extends Component
 {
 	
 	public function getinfo($property_id,$plot_no,$start_date,$customer_id)
 	{
 		$connection = Yii::$app->db;
 		$connection->createCommand()->insert('plot_owner_info',
                    [
                        'property_id' => $property_id,
                        'plot_no' => $plot_no,
                        'customer_id' => $customer_id,
                        'start_date'=>$start_date,
                        'organization_id'=>\Yii::$app->user->identity->organization_id,
                    ])->execute();
 	}

 	public function installment($property_id,$Installment_type,$Installment_remaning,$Installment_total,$customer_id,$no_installments,$plot_no)
 	{
 		$connection = Yii::$app->db;
 		$connection->createCommand()->insert('installment',
                    [
                        'property_id' => $property_id,
                        'installment_type' => $Installment_type,
                        'remaning_amount' => $Installment_remaning,
                        'total_amount'=>$Installment_total,
                        'no_of_installments' => $no_installments,
                        'customer_id' => $customer_id,
                        'plot_no'=> $plot_no,
                        'organization_id'=>\Yii::$app->user->identity->organization_id,
                    ])->execute();
 	}


 	public function sold($property_id,$plot_no)
 	{
 		$connection = Yii::$app->db;
 		$condition = ['property_id' => $property_id , 'plot_no' => $plot_no];
 		$connection->createCommand()->update('plot',
                    [
                        'status' => 'Sold',
                    ],$condition)->execute();

 	}

 	public function status($installment_id,$noinstallment,$amount,$totalamount,$remaningamount,$submitdate)
 	{
 		$connection = Yii::$app->db;
 		$paid_money = $totalamount-$remaningamount;
 		if($paid_money == 0)
 		{
	 		for($i = 1; $i <= $noinstallment ; $i++)
	 		{
	 			$connection->createCommand()->insert('installment_status',
	                    [
	                        'installment_id' => $installment_id,
	                        'installment_no' => $i,
	                        'installment_amount' => $amount,
	                        'status'=>'1',
	                        'date' => date('Y-m-d'),
	                        'paid_date' => $submitdate,
	                        'created_by'=>\Yii::$app->user->identity->id,
	                    ])->execute();
	 		}
	 	}else
	 	{
	 		$connection->createCommand()->insert('installment_status',
	                    [
	                        'installment_id' => $installment_id,
	                        'installment_no' => '1',
	                        'installment_amount' => $paid_money,
	                        'status'=>'0',
	                        'date' => date('Y-m-d'),
	                        'paid_date' => $submitdate,
	                        'created_by'=>\Yii::$app->user->identity->id,
	                    ])->execute();
			for($i = 2; $i <= $noinstallment + 1 ; $i++)
	 		{
	 			$connection->createCommand()->insert('installment_status',
	                    [
	                        'installment_id' => $installment_id,
	                        'installment_no' => $i,
	                        'installment_amount' => $amount,
	                        'status'=>'1',
	                        'date' => date('Y-m-d'),
	                        'paid_date' => $submitdate,
	                        'created_by'=>\Yii::$app->user->identity->id,
	                    ])->execute();
	 		}

	 	}
	}


	// for paymentsubmittion functions

	public function installmentpaymentinfo($paidamount,$customer_id,$property_id,$plot_no)
	{
		$connection = Yii::$app->db;
		$rem = Installment::find()->where(['customer_id' => $customer_id,'property_id' => $property_id])->andwhere(['plot_no'=>$plot_no])->andwhere(['organization_id' => \Yii::$app->user->identity->organization_id])->One();
		$amount = (int)$rem->remaning_amount;
		if($amount > 0)
		{
			$remaning_amount = $amount-(int)$paidamount;
			$condition = ['property_id' => $property_id , 'plot_no' => $plot_no , 'customer_id' => $customer_id];
	 		$connection->createCommand()->update('installment',
	                    [
	                    	'remaning_amount' => $remaning_amount,

	                    ],$condition)->execute();
 		}
	}

	public function installmentstatusupdate($installment_no,$property_id,$customer_id,$plot_no,$paid_amount)
	{
		$connection = Yii::$app->db;
		$rem = Installment::find()->where(['customer_id' => $customer_id,'property_id' => $property_id])->andwhere(['plot_no'=>$plot_no])->andwhere(['organization_id' => \Yii::$app->user->identity->organization_id])->One();
		$get_amount = InstallmentStatus::find()->where(['installment_id'=>$rem->installment_id , 'installment_no' => $installment_no])->One();
		$condition = ['installment_id' => $rem->installment_id , 'installment_no' => $installment_no];
		if($get_amount)
		{
			if($get_amount->installment_amount == $paid_amount){
				$connection->createCommand()->update('installment_status',
                    [
                    	'status' => '0',

                    ],$condition)->execute();
			}
		}
		else
		{
			die();
		}
	}


}

  ?>
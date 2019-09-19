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
                        'advance_amount' => 0,
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

 	public function status($installment_id,$noinstallment,$amount,$totalamount,$advanceamount,$installment_type)
 	{
 		$connection = Yii::$app->db;
 		
 		if($advanceamount == 0)
 		{
 			$final_date = strtotime(date('Y-m-d'));
	 		for($i = 1; $i <= $noinstallment ; $i++)
	 		{
	 			if($installment_type == "Monthly")
				 {
				    $final_date = date("Y-m-d", strtotime("+1 month", $final_date));
				 }else if($installment_type == "6 Months")
				 {
				    $final_date = date("Y-m-d", strtotime("+6 month", $final_date));

				 }else if($installment_type == "Yearly")
				 {
				    $final_date = date("Y-m-d", strtotime("+12 month", $final_date));
				 }
	 			$connection->createCommand()->insert('installment_status',
	                    [
	                        'installment_id' => $installment_id,
	                        'installment_no' => $i,
	                        'installment_amount' => $amount,
	                        'status'=>'1',
	                        'date' => date('Y-m-d'),
	                        'paid_date' => $final_date,
	                        'created_by'=>\Yii::$app->user->identity->id,
	                        'organization_id' => \Yii::$app->user->identity->organization_id,
	                    ])->execute();
	 			 $final_date = strtotime(date($final_date));
	 		}
	 	}else
	 	{
	 		$final_date = strtotime(date('Y-m-d'));
	 		if($installment_type == "Monthly")
			 {
			    $final_date = date("Y-m-d", strtotime("+1 month", $final_date));
			 }else if($installment_type == "6 Months")
			 {
			    $final_date = date("Y-m-d", strtotime("+6 month", $final_date));

			 }else if($installment_type == "Yearly")
			 {
			    $final_date = date("Y-m-d", strtotime("+12 month", $final_date));
			 }
	 		$connection->createCommand()->insert('installment_status',
	                    [
	                        'installment_id' => $installment_id,
	                        'installment_no' => '1',
	                        'installment_amount' => $advanceamount,
	                        'status'=>'0',
	                        'date' => date('Y-m-d'),
	                        'paid_date' => date('Y-m-d'),
	                        'created_by'=>\Yii::$app->user->identity->id,
	                        'organization_id' => \Yii::$app->user->identity->organization_id,
	                    ])->execute();
			for($i = 2; $i <= $noinstallment + 1 ; $i++)
	 		{
	 			$final_date = strtotime(date($final_date));
	 			if($installment_type == "Monthly")
				 {
				    $final_date = date("Y-m-d", strtotime("+1 month", $final_date));
				 }else if($installment_type == "6 Months")
				 {
				    $final_date = date("Y-m-d", strtotime("+6 month", $final_date));

				 }else if($installment_type == "Yearly")
				 {
				    $final_date = date("Y-m-d", strtotime("+12 month", $final_date));
				 }
	 			$connection->createCommand()->insert('installment_status',
	                    [
	                        'installment_id' => $installment_id,
	                        'installment_no' => $i,
	                        'installment_amount' => $amount,
	                        'status'=>'1',
	                        'date' => date('Y-m-d'),
	                        'paid_date' => $final_date,
	                        'created_by'=>\Yii::$app->user->identity->id,
	                        'organization_id' => \Yii::$app->user->identity->organization_id,p
	                    ])->execute();
	 			
	 		}

	 	}
	}


	// for paymentsubmittion functions


	public function installmentstatusupdate($installment_no,$property_id,$customer_id,$plot_no,$paid_amount,$remaning_to_paid,$previous_pay_amount,$installment_amount)
	{
		$rem = Installment::find()->where(['customer_id' => $customer_id,'property_id' => $property_id])->andwhere(['plot_no'=>$plot_no])->andwhere(['organization_id' => \Yii::$app->user->identity->organization_id])->One();
		$connection = Yii::$app->db;
		$condition = ['property_id' => $property_id,'customer_id'=> $customer_id,'plot_no' => $plot_no];
		$condition1 = ['installment_id'=>$rem->installment_id,'installment_no' => $installment_no];


		if($paid_amount == 0  && $previous_pay_amount>$installment_amount)
		{
			$previous_pay_amount = $previous_pay_amount - $installment_amount;

			$connection->createCommand()->update('installment',
	                    [
	                        'advance_amount' => $previous_pay_amount,
	                    ],$condition)->execute();
			$connection->createCommand()->update('installment_status',
	                    [
	                        'status' => '0',
	                    ],$condition1)->execute();
		}
		else
			if($paid_amount != 0 && $previous_pay_amount < $installment_amount)
			{
				$updated_amount = ($paid_amount + $previous_pay_amount) - $installment_amount;
				$connection->createCommand()->update('installment',
	                    [
	                        'advance_amount' => $updated_amount,
	                    ],$condition)->execute();
			$connection->createCommand()->update('installment_status',
	                    [
	                        'status' => '0',
	                    ],$condition1)->execute();


			}
			else
				if($paid_amount == 0 && $previous_pay_amount == $installment_amount )
				{
					$updated_amount = $previous_pay_amount - $installment_amount;
					$connection->createCommand()->update('installment',
	                    [
	                        'advance_amount' => $updated_amount,
	                    ],$condition)->execute();
					$connection->createCommand()->update('installment_status',
	                    [
	                        'status' => '0',
	                    ],$condition1)->execute();

				}
				else
					if($paid_amount != 0 && $previous_pay_amount == $installment_amount)
					{
						$updated_amount = ($paid_amount + $previous_pay_amount) - $installment_amount;
						$connection->createCommand()->update('installment',
	                   	 	[
	                    	    'advance_amount' => $updated_amount,
	                    	],$condition)->execute();
						$connection->createCommand()->update('installment_status',
	                    	[
	                        	'status' => '0',
	                    	],$condition1)->execute();
					}
					else
						if($paid_amount != 0 && $previous_pay_amount > $installment_amount)
						{
							$updated_amount = ($paid_amount + $previous_pay_amount) - $installment_amount;
							$connection->createCommand()->update('installment',
				                [
				                   	'advance_amount' => $updated_amount,
				                ],$condition)->execute();
							$connection->createCommand()->update('installment_status',
				                [
				                    'status' => '0',
				                ],$condition1)->execute();
						}
						else
						{
							echo "Sorry Soething Went Wrong <br> Or Wrong Information Passed!";
						}
		
	}




}

  ?>
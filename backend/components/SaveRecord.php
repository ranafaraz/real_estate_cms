<?php 
    namespace backend\components;
    use yii;
    use yii\base\Component;
    use backend\models\AccountPayable;
    /**
     * summary
     */
    class saverecord Extends Component
    {
        /**
         * summary
         */
        
     public function saverecord00($receiver_payer_id,$amount,$debit_account,$due_date)
    {
        $connection=yii::$app->db;
         $modelap = AccountPayable::find('transaction_id')->orderBy(['id' => SORT_DESC])->One();
            if($modelap == "")
            {
                $transaction_id = '1';
            }
            else
            {
                (int)$transap = (int)$modelap->transaction_id;
                $transaction_id = $trans + 1;
            }
            $connection->createCommand->Insert('account_payable',
                [
                    'transaction_id'=>$transaction_id,
                    'recipient_id'=>$receiver_payer_id,
                    'amount'=>$amount,
                    'account_payable'=>$debit_amount,
                    'due_date'=>$due_date,
                    'updated_at'=>date('Y-m-d h:m:s');,
                    'updated_by'=>\Yii::$app->user->identity->username,
                ]
            )->execute();
           
        

        
       }
       public function saverecord11($update_id)
        {
            $connection=yii::$app->db;
         
            $connection->createCommand->Insert('account_payable',
                [
                    'transaction_id'=>$transaction_id,
                    'recipient_id'=>$receiver_payer_id,
                    'amount'=>$amount,
                    'account_payable'=>$debit_amount,
                    'due_date'=>$due_date,
                    'updated_at'=>date('Y-m-d h:m:s');,
                    'updated_by'=>\Yii::$app->user->identity->username,
                ]
            )->execute();
            // print_r($model->updateid);
            // die();
            // exit;
            // $connection = Yii::$app->db;
            // $id=$model->updateid;
            // $command = $connection->createCommand('UPDATE account_payable SET status=1,amount=0 WHERE id={$id}');
            AccountPayable::update([]);
        }
        public function saverecord10($)
        {
             print_r($model->updateid);
            $id=$model->updateid;
            $updateamount= $modelupdate->amount-$model->credit_amount;
            $connection = Yii::$app->db;
            $command = $connection->createCommand('UPDATE account_payable SET status=1,amount={$updateamount} WHERE id={$id}');
            $command->execute();
        }
       
      }     
?>
<?php 
    namespace backend\components;
    use yii;
    use yii\base\Component;
    use backend\models\AccountPayable;
    /**
     * summary
     */
    class SaveRecord Extends Component
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
            $connection->createCommand()->Insert('account_payable',
                [
                    'transaction_id'=>$transaction_id,
                    'recipient_id'=>$receiver_payer_id,
                    'amount'=>$amount,
                    'account_payable'=>$debit_amount,
                    'due_date'=>$due_date,
                    'updated_at'=>date('Y-m-d h:m:s'),
                    'updated_by'=>\Yii::$app->user->identity->username,
                ]
            )->execute();        

        
       }
       // update id ==1 and check state =1
       public function saverecord11($update_id)
        {
            $connection=yii::$app->db;
            $connection->createCommand()->update('account_payable',
                [
                    
                    'amount'=>0,
                    'status'=>0,
                    'due_date'=>'0000-00-00 00-00-00',
                    'updated_at'=>date('Y-m-d h:m:s'),
                    'updated_by'=>\Yii::$app->user->identity->username,
                ],['id'=>$update_id]
            )->execute();
           
        }

        // update id ==1 and check state =0
        public function saverecord10($updateid,$amount)
        {
             $connection=yii::$app->db;
            $connection->createCommand()->update('account_payable',
                [
                    
                    'amount'=>$amount,
                    'status'=>1,
                    'updated_at'=>date('Y-m-d h:m:s'),
                    'updated_by'=>\Yii::$app->user->identity->username,
                ],['id'=>$updateid]
            )->execute();
         
        }
       
      }     
?>
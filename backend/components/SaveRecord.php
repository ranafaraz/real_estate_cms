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
        
     public function saverecord00($credit_account,$amount,$debit_account,$due_date,$transaction_id)
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
                    'recipient_id'=>$debit_account,
                    'amount'=>$amount,
                    'account_payable'=>$credit_account,
                    'due_date'=>$due_date,
                    'updated_at'=>date('Y-m-d'),
                    'identifier' => 'Expense',
                    'created_at' => date('Y-m-d'),
                    'updated_by'=>\Yii::$app->user->identity->username,
                    'status' => 'Active',
                    'organization_id' => \Yii::$app->user->identity->organization_id,
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
                    'due_date'=>'0000-00-00',
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
                    'updated_at'=>date('Y-m-d'),
                    'updated_by'=>\Yii::$app->user->identity->username,
                ],['id'=>$updateid]
            )->execute();
         
        }
       
      }     
?>
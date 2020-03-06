<?php
namespace backend\controllers;

use Yii;
use backend\models\BuyPlot;
use backend\models\BuyPlotSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use backend\models\Transactions;
use backend\models\Customer;
use backend\models\AccountHead;
use backend\models\AccountPayable;
use yii\web\ArrayHelper;

/**
 * BuyPlotController implements the CRUD actions for BuyPlot model.
 */
class BuyPlotController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'bulk-delete' => ['post'],
                ],
            ],
        ];
    }


    /**
     * Lists all BuyPlot models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new BuyPlotSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single BuyPlot model.
     * @param integer $id
     * @return mixed
     */
    public function actionSubmitData()
    {
        return $this->renderAjax('submit-data.php');
    }
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "BuyPlot #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    public function actionUpdateData()
    {   
        return $this->renderajax('update-data');
    }

    /**
     * Creates a new BuyPlot model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    { 
        $request = Yii::$app->request;
        $model = new BuyPlot();  
        $customer_model = new Customer();
        $transaction_model = new Transactions();
        $acc_pay = new AccountPayable();

 
        $model->created_at = date('Y-m-d');
        $model->created_by = \Yii::$app->user->identity->id;
        $model->organization_id = \Yii::$app->user->identity->organization_id;
        $connection = Yii::$app->db;
            /*
            *   Process for non-ajax request
            */
        if ($model->load($request->post()) && $customer_model->load(Yii::$app->request->post()) ) {

        if($model->remaning_price == 0)
        {
            $transaction = \Yii::$app->db->beginTransaction();
            try {
                if($customer_model->checkifexist == '1')
                {
                    $model->customer_id = $customer_model->customerid;
                    $query1=$model->save();
                }
                else
                {
                    $query1=$connection->createCommand()->insert('customer',
                        [
                            'customer_type_id' => $customer_model->customer_type_id,
                            'name' => $customer_model->name,
                            'father_name' => $customer_model->father_name,
                            'cnic_no' => $customer_model->cnic_no,
                            'contact_no' => $customer_model->contact_no,
                            'email_address' => $customer_model->email_address,
                            'address' => $customer_model->address,
                            'user_id' => \Yii::$app->user->identity->id,
                            'organization_id' => \Yii::$app->user->identity->organization_id,
                            'created_date' => date('Y-m-d'),
                        ]
                    )->execute();
                }
                    $trans_model= Transactions::find()->orderBy(['transaction_id' => SORT_DESC])->One();
                    $plot_model = AccountHead::find()->where(['account_name' => 'Plot'])->One();
                    $cash_model = AccountHead::find()->where(['account_name' => 'Cash'])->One();
                    print_r($trans_model);
                    if($trans_model == "")
                    {
                        $transaction_model->transaction_id = '1'; 
                    }
                    else
                    {
                          $transaction_model->transaction_id = $trans_model->transaction_id + 1;  
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
                    $query2=$connection->createCommand()->insert('transactions',
                        [
                            'transaction_id' => $transaction_model->transaction_id,
                            'type' => 'cash Payment',
                            'narration' => $model->narration,
                            'debit_account' => $plot_model->id,
                            'debit_amount' => $model->plot_price,
                            'credit_account' => $cash_model->id,
                            'credit_amount' => $model->plot_price,
                            'transaction_date' => $model->transaction_date,
                            'date' => date('Y-m-d'),
                            'created_by' => \Yii::$app->user->identity->id,
                            'organization_id' => \Yii::$app->user->identity->organization_id,
                        ]
                    )->execute();
                if ($query1 && $query2) {
                    $transaction->commit();
                    return $this->redirect('buy-plot');
                }else{
                    $transaction->rollback();
                }

                if(empty($cash_model))
                {
                    echo "Sorry No Account Head Found Name 'Cash'";
                    die();
                }
                $buy_plot = BuyPlot::find()->where(['organization_id' => \Yii::$app->user->identity->organization_id])->orderBy(['buy_plot_id' => SORT_DESC])->One();
                $connection->createCommand()->insert('transactions',
                    [
                        'buy_plot_id' => $buy_plot->buy_plot_id,
                        'transaction_id' => $transaction_model->transaction_id,
                        'type' => 'cash Payment',
                        'narration' => $model->narration,
                        'debit_account' => $plot_model->id,
                        'debit_amount' => $model->plot_price,
                        'credit_account' => $cash_model->id,
                        'credit_amount' => $model->plot_price,
                        'transaction_date' => $model->transaction_date,
                        'date' => date('Y-m-d'),
                        'created_by' => \Yii::$app->user->identity->id,
                        'organization_id' => \Yii::$app->user->identity->organization_id,
                    ]
                )->execute();

        }
        else
        {
            $transaction = \Yii::$app->db->beginTransaction();
            try {   
                if($customer_model->checkifexist == '1')
                {

                    $model->status = 'Partially Paid';
                }
                $model->save();
            }
            else
            {
                $connection->createCommand()->insert('customer',
                    [
                        'customer_type_id' => $customer_model->customer_type_id,
                        'name' => $customer_model->name,
                        'father_name' => $customer_model->father_name,
                        'cnic_no' => $customer_model->cnic_no,
                        'contact_no' => $customer_model->contact_no,
                        'email_address' => $customer_model->email_address,
                        'address' => $customer_model->address,
                        'user_id' => \Yii::$app->user->identity->id,
                        'organization_id' => \Yii::$app->user->identity->organization_id,
                        'created_date' => date('Y-m-d'),
                    ]
                )->execute();
            }
                $trans_model= Transactions::find()->orderBy(['transaction_id' => SORT_DESC])->One();
                $plot_model = AccountHead::find()->where(['account_name' => 'Plot'])->One();
                $cash_model = AccountHead::find()->where(['account_name' => 'Cash'])->One();
                $buy_plot = BuyPlot::find()->where(['organization_id' => \Yii::$app->user->identity->organization_id])->orderBy(['buy_plot_id' => SORT_DESC])->One();
                if($trans_model == "")
                {
                    $transaction_model->transaction_id = '1'; 

                }
                else
                {
                    $query1=$connection->createCommand()->insert('customer',
                        [
                            'customer_type_id' => $customer_model->customer_type_id,
                            'name' => $customer_model->name,
                            'father_name' => $customer_model->father_name,
                            'cnic_no' => $customer_model->cnic_no,
                            'contact_no' => $customer_model->contact_no,
                            'email_address' => $customer_model->email_address,
                            'address' => $customer_model->address,
                            'user_id' => \Yii::$app->user->identity->id,
                            'organization_id' => \Yii::$app->user->identity->organization_id,
                            'created_date' => date('Y-m-d'),
                        ]
                    )->execute();
                }
                    $trans_model= Transactions::find()->orderBy(['transaction_id' => SORT_DESC])->One();
                    $plot_model = AccountHead::find()->where(['account_name' => 'Plot'])->One();
                    $cash_model = AccountHead::find()->where(['account_name' => 'Cash'])->One();
                    if($trans_model == "")
                    {
                        $transaction_model->transaction_id = '1'; 
                    }
                    else
                    {
                          $transaction_model->transaction_id = $trans_model->transaction_id + 1;  
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
                    $query2=$connection->createCommand()->insert('transactions',
                        [
                            'transaction_id' => $transaction_model->transaction_id + 1,
                            'type' => 'cash Payment',
                            'account_payable_id' => $acc_pay->id,
                            'narration' => $model->narration,
                            'debit_account' => $plot_model->id,
                            'debit_amount' => $model->plot_paid_price,
                            'credit_account' => $cash_model->id,
                            'credit_amount' => $model->plot_paid_price,
                            'transaction_date' => $model->transaction_date,
                            'date' => date('Y-m-d'),
                            'created_by' => \Yii::$app->user->identity->id,
                            'organization_id' => \Yii::$app->user->identity->organization_id,
                        ]
                    )->execute();
                    if ($query1 && $query2) {
                        $transaction->commit();
                        return $this->redirect('buy-plot');
                    }else{
                        $transaction->rollback();
                    }
                }catch(Exception $e){
                    $transaction->rollback();
                }

                $connection->createCommand()->insert('transactions',
                    [
                        'transaction_id' => $transaction_model->transaction_id + 1,
                        'type' => 'cash Payment',
                        'buy_plot_id' => $buy_plot->buy_plot_id,
                        'narration' => $model->narration,
                        'debit_account' => $plot_model->id,
                        'debit_amount' => $model->plot_paid_price,
                        'credit_account' => $cash_model->id,
                        'credit_amount' => $model->plot_paid_price,
                        'transaction_date' => $model->transaction_date,
                        'date' => date('Y-m-d'),
                        'created_by' => \Yii::$app->user->identity->id,
                        'organization_id' => \Yii::$app->user->identity->organization_id,
                    ]
                )->execute();

        }
                 
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'customer_model' => $customer_model,
                ]);
            }
        
       
    }

    /**
     * Updates an existing BuyPlot model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
     public function actionBuyPlotPayment($id)
    {
        return $this->render('buy-plot-payment',['id' => $id]);
    }
    public function actionPlotTransactions($id)
    {
        return $this->render('Plot-transactions',['id' => $id]);
    }
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);      
        $customer_model = Customer::find()->where(['customer_id' => $model->customer_id])->One();
 

            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post())  && $customer_model->load(Yii::$app->request->post()) && $model->save() && $customer_model->save()) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($model->save() && $customer_model->save()) {
                        $transaction->commit();
                    }else{
                        $transaction->rollback();
                    }
                }catch(Exception $e){
                    $transaction->rollback();
                }
                return $this->redirect(['view', 'id' => $model->buy_plot_id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'customer_model' => $customer_model,
                ]);
            }
        
    }

    /**
     * Delete an existing BuyPlot model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $this->findModel($id)->delete();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }


    }


     /**
     * Delete multiple existing BuyPlot model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkDelete()
    {        
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
        foreach ( $pks as $pk ) {
            $model = $this->findModel($pk);
            $model->delete();
        }

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
       
    }

    /**
     * Finds the BuyPlot model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BuyPlot the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BuyPlot::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

<?php

namespace backend\controllers;

use Yii;
use backend\models\Customer;
use backend\models\CustomerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use backend\models\Property;
use backend\models\PlotOwnerInfo;
use backend\models\Installment;
use backend\models\InstallmentStatus;
use yii\helpers\Json;
use backend\models\CustomerType;
use backend\models\Transactions;
use backend\models\AccountHead;
use backend\models\ReceiverPayerInfo;
use backend\models\AccountRecievable;
use yii\web\ForbiddenHttpException;
use yii\web\UploadedFile;
/**
 * CustomerController implements the CRUD actions for Customer model.
 */
class CustomerController extends Controller
{
    /**
     * 
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
     * Lists all Customer models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new CustomerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Customer model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Customer #".$id,
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

    /**
     * Creates a new Customer model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Customer();  
        $plotinfo = new PlotOwnerInfo(); 
        $installmentinfo = new Installment();
        $installmentstatus = new InstallmentStatus();
        $transaction_model = new Transactions();
        $accounts = new AccountRecievable();


        
            /*
            *   Process for non-ajax request
            */
           $model->organization_id = \Yii::$app->user->identity->organization_id;
            $model->created_date = date('Y-m-d'); 
            $plotinfo->start_date = date('Y-m-d'); 
            $amount = $model->amount;
            $first_pay = $model->first_payment;
            $no_of_installment = $model->no_of_installment;
            $connection = Yii::$app->db;
            if ($model->load($request->post()) && $plotinfo->load(Yii::$app->request->post()) && $installmentinfo->load(Yii::$app->request->post())  && $installmentstatus->load(Yii::$app->request->post())) {

                ////////////////storing image in db
               $model->image = UploadedFile::getInstance($model,'image');
                    if(!empty($model->image)){
                        $imageName = $model->cnic_no; 
                        $model->image->saveAs('uploads/'.$imageName.'.'.$model->image->extension);
                        //save the path in the db column
                        $model->image = 'uploads/'.$imageName.'.'.$model->image->extension;
                    } else {
                       $model->image = '0'; 
                    }

                /////////////////////////////////////////
                if($model->checkifexist == '1')
            {
                $customerid = $model->customerid;
            }
            else
            {
                $connection->createCommand()->insert('customer',
                    [
                        'customer_type_id' => $model->customer_type_id,
                        'name' => $model->name,
                        'father_name' => $model->father_name,
                        'cnic_no' => $model->cnic_no,
                        'contact_no' => $model->contact_no,
                        'email_address' => $model->email_address,
                        'address' => $model->address,
                        'image' => $model->image,
                        'user_id' => \Yii::$app->user->identity->id,
                        'organization_id' => \Yii::$app->user->identity->organization_id,
                        'created_date' => date('Y-m-d'),
                    ]
                )->execute(); 
                if($model->only_create_customer == '1')
                {
                    return $this->redirect(['index']);
                }
                $model_id = Customer::find()->orderBy(['customer_id' => SORT_DESC])->One();
                $customerid=$model_id->customer_id;
            }
            Yii::$app->MyComponent->getinfo($plotinfo->property_id,$plotinfo->plot_no,$plotinfo->start_date,$customerid);
            if($installmentinfo->installment_type == 'Monthly')
            {
                $installmentinfo->no_of_installments = $installmentinfo->no_of_installments * 12;
            }else if($installmentinfo->installment_type == '6 Months'){
                $installmentinfo->no_of_installments = ($installmentinfo->no_of_installments / 6) * 12;
            }
            else if($installmentinfo->installment_type == 'Yearly')
            {
                $installmentinfo->no_of_installments = ceil(($installmentinfo->no_of_installments * 12)/12);
            }
            Yii::$app->MyComponent->installment($plotinfo->property_id,$installmentinfo->installment_type,$installmentinfo->advance_amount,$installmentinfo->total_amount,$customerid,$installmentinfo->no_of_installments,$plotinfo->plot_no);
           
            Yii::$app->MyComponent->sold($plotinfo->property_id,$plotinfo->plot_no);

             $installment_id = Installment::find('installment_id')->orderBy(['installment_id' => SORT_DESC])->One();

             

            Yii::$app->MyComponent->status($installment_id->installment_id,$installmentinfo->no_of_installments,$installmentstatus->installment_amount,$installmentinfo->total_amount,$installmentinfo->advance_amount,$installmentinfo->installment_type);

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
            $connection->createCommand()->insert('transactions',
                [
                    'transaction_id' => $transaction_model->transaction_id,
                    'type' => 'cash Payment',
                    'narration' => $model->narration,
                    'debit_account' => $cash_model->id,
                    'debit_amount' => $installmentinfo->advance_amount,
                    'credit_account' => $plot_model->id,
                    'credit_amount' => $installmentinfo->advance_amount,
                    'date' => date('Y-m-d'),
                    'created_by' => \Yii::$app->user->identity->id,
                    'organization_id' => \Yii::$app->user->identity->organization_id,
                ]
            )->execute();

            $trans_model= Transactions::find()->orderBy(['transaction_id' => SORT_DESC])->One();
            if($trans_model == "")
            {
                $transaction_model->transaction_id = '1'; 
            }
            else
            {
                  $transaction_model->transaction_id = $trans_model->transaction_id + 1;  
            }
            
            $connection->createCommand()->insert('transactions',
                [
                    'transaction_id' => $transaction_model->transaction_id,
                    'type' => 'cash Payment',
                    'narration' => $model->narration,
                    'debit_account' => $cash_model->id,
                    'debit_amount' => $installmentinfo->advance_amount,
                    'credit_account' => $plot_model->id,
                    'credit_amount' => $installmentinfo->advance_amount,
                    'date' => date('Y-m-d'),
                    'created_by' => \Yii::$app->user->identity->id,
                    'organization_id' => \Yii::$app->user->identity->organization_id,
                ]
            )->execute();

            if($installmentinfo->advance_amount < $installmentinfo->total_amount)
            {   
                $accounts->is_installment = '1';
                $Account_model= AccountRecievable::find()->orderBy(['transaction_id' => SORT_DESC])->One();
                if($Account_model == "")
                {
                    $accounts->transaction_id = '1'; 
                }
                else
                {
                      $accounts->transaction_id = $Account_model->transaction_id + 1;  
                }
                $connection->createCommand()->insert('account_recievable',
                    [
                        'transaction_id' => $accounts->transaction_id,
                        'payer_id' => $customerid,
                        'amount' => $installmentinfo->minus_amonut,
                        'property_id' => $plotinfo->property_id,
                        'plot_no' => $plotinfo->plot_no,
                        'is_installment' => $accounts->is_installment,
                        'due_date' => '0000-00-00',
                        'updated_by' => '0',
                        'updated_at' => '0',
                        'organization_id' => \Yii::$app->user->identity->organization_id,
                    ]
                )->execute();
                $trans_model= Transactions::find()->orderBy(['transaction_id' => SORT_DESC])->One();
                $Accounts_model= AccountHead::find()->where(['account_name' =>'Account Receivable'])->One();
                if($trans_model == "")
                {
                    $transaction_model->transaction_id = '1'; 
                }
                else
                {
                      $transaction_model->transaction_id = $trans_model->transaction_id + 1;  
                }
                if($Accounts_model == "")
                {
                    die(); 
                }
                $connection->createCommand()->insert('transactions',
                    [
                        'transaction_id' => $transaction_model->transaction_id,
                        'type' => 'cash Payment',
                        'narration' => $model->narration,
                         'debit_account' => $Accounts_model->id,
                        'debit_amount' => $installmentinfo->minus_amonut,
                        'credit_account' => $cash_model->id,
                        'credit_amount' => $installmentinfo->minus_amonut,
                        'date' => date('Y-m-d'),
                        'created_by' => \Yii::$app->user->identity->id,
                        'organization_id' => \Yii::$app->user->identity->organization_id,
                    ]
                )->execute();
            }
                return $this->redirect('customer');
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'plotinfo' => $plotinfo,
                    'installmentinfo' => $installmentinfo,
                    'installmentstatus' => $installmentstatus,
                ]);
            }
        
       
    }

    /**
     * Updates an existing Customer model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);       

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update Customer #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Customer #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Update Customer #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];        
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->customer_id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing Customer model.
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
     * Delete multiple existing Customer model.
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
     * Finds the Customer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Customer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Customer::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionCheckCustomer($customer_cnic,$customer_type)
    {
        $customer_type = CustomerType::find()->where(['customer_type' => $customer_type])->andwhere(['organization_id' => \Yii::$app->user->identity->organization_id ])->One();
        if(isset($customer_type))
        {
            $model  = Customer::find()->where(['cnic_no' => $customer_cnic , 'customer_type_id' => $customer_type->customer_type_id])->andwhere(['organization_id' => \Yii::$app->user->identity->organization_id])->One();

            if(empty($model))
            {
                $val = "empty";
                echo Json::encode($val);
            }
            else
            {
                echo Json::encode($model);
            }
        }
        else
        {
             echo  "Empty";
        }


    }
}

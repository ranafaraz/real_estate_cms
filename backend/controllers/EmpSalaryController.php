<?php

namespace backend\controllers;

use Yii;
use backend\models\EmpSalary;
use backend\models\EmpSalarySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\helpers\Json;
use backend\models\Transactions;
use backend\models\AccountHead;
use backend\models\AccountPayable;

/**
 * EmpSalaryController implements the CRUD actions for EmpSalary model.
 */
class EmpSalaryController extends Controller
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
     * Lists all EmpSalary models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new EmpSalarySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single EmpSalary model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "EmpSalary #".$id,
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
     * Creates a new EmpSalary model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new EmpSalary();  
        $trans = new Transactions();

        $model->created_at = date('Y-m-d');
        $model->created_by = \Yii::$app->user->identity->id;
        $model->updated_at = '0';
        $model->updated_by = '0';
        $model->organization_id = \Yii::$app->user->identity->organization_id; 
        $model->date = date('Y-m-d');

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Create new EmpSalary",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['id'=> 'submitbutton' , 'class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post())){
                $emp_id = $model->emp_id;
                $connection = Yii::$app->db;
                if($model->salary_month > date('Y-m'))
                {
                    $model->remaining = $get_emp->salary - $model->paid_amount;

                    $connection->createCommand()->insert('emp_salary',
                    [
                        'emp_id' => $model->emp_id,
                        'date' => $model->date,
                        'paid_amount'=>$model->paid_amount,
                        'remaining'=>$model->remaining,
                        'salary_month' => $model->salary_month,
                        'status'=>$model->status,
                        'created_by' =>Yii::$app->user->identity->id,
                        'organization_id' => Yii::$app->user->identity->organization_id,
                        'updated_by' => 0,
                        'updated_at'=> 0,
                    ])->execute();
                    $trans_model= Transactions::find()->orderBy(['transaction_id' => SORT_DESC])->One();
                    $payable_model= AccountPayable::find()->orderBy(['transaction_id' => SORT_DESC])->One();
                    if($trans_model == "")
                    {
                        $trans->transaction_id = '1'; 
                    }
                    else
                    {
                          $trans_model->transaction_id = $trans_model->transaction_id + 1;  
                    }
                    if($payable_model == "")
                    {
                        $payable_model->transaction_id = '1'; 
                    }
                    else
                    {
                          $payable_model->transaction_id = $payable_model->transaction_id + 1;  
                    }
                    $acc_model =AccountHead::find()->where(['account_name' => 'Salary'])->One();
                    if(empty($acc_model))
                    {
                        die();
                    }
                    $acc_model1 =AccountHead::find()->where(['account_name' => 'Cash'])->One();
                    $payable = AccountHead::find()->where(['account_name' => 'Account Payable'])->One();
                    if(empty($payable))
                    {
                        die();
                    }
                    if(empty($acc_model1))
                    {
                        die();
                    }
                    $model->remaining = $model->salary-$model->paid_amount;
                    $connection->createCommand()->insert('transactions',
                        [
                            'transaction_id' => $trans_model->transaction_id,
                            'type' => 'cash Payment',
                            'narration' => $model->narration,
                            'debit_account' => $acc_model->id,
                            'debit_amount' => $model->paid_amount,
                            'credit_account' => $acc_model1->id,
                            'credit_amount' => $model->paid_amount,
                            'date' => date('Y-m-d'),
                            'created_by' => \Yii::$app->user->identity->id,
                            'organization_id' => \Yii::$app->user->identity->organization_id,
                        ]
                    )->execute();
                }
                
                else if($model->remaining > $model->paid_amount)
                {
                    $model->remaining = $model->remaining - $model->paid_amount;
                    $get_rem = EmpSalary::find()->orderBy(['emp_salary_id' => SORT_DESC])->One();
                    $connection->createCommand()->insert('emp_salary',
                    [
                        'emp_id' => $model->emp_id,
                        'date' => $model->date,
                        'paid_amount'=>$model->paid_amount,
                        'remaining'=>$model->remaining,
                        'salary_month' => $model->salary_month,
                        'status'=>$model->status,
                        'created_by' =>Yii::$app->user->identity->id,
                        'organization_id' => Yii::$app->user->identity->organization_id,
                        'updated_by' => 0,
                        'updated_at'=> 0,
                    ])->execute();
                    $trans_model= Transactions::find()->orderBy(['transaction_id' => SORT_DESC])->One();
                    $pay = new AccountPayable();
                    $payable_model= AccountPayable::find()->orderBy(['transaction_id' => SORT_DESC])->One();

                    if($trans_model == "")
                    {
                        $trans->transaction_id = '1'; 
                    }
                    else
                    {
                          $trans_model->transaction_id = $trans_model->transaction_id + 1;  
                    }
                    if($payable_model == "")
                    {
                        $pay->transaction_id = '1'; 
                    }
                    else
                    {
                          $pay->transaction_id = $payable_model->transaction_id + 1;  
                    }
                    $acc_model =AccountHead::find()->where(['account_name' => 'Salaries'])->One();
                    
                    $acc_model1 =AccountHead::find()->where(['account_name' => 'Cash'])->One();
                    $payable = AccountHead::find()->where(['account_name' => 'Account Payable'])->One();
                    if(empty($acc_model))
                    {
                        die();
                    }
                    if(empty($payable))
                    {
                        die();
                    }
                    if(empty($acc_model1))
                    {
                        die();
                    }
                    $connection->createCommand()->insert('transactions',
                        [
                            'transaction_id' => $pay->transaction_id,
                            'type' => 'cash Payment',
                            'narration' => $model->narration,
                            'debit_account' => $acc_model->id,
                            'debit_amount' => $model->paid_amount,
                            'credit_account' => $acc_model1->id,
                            'credit_amount' => $model->paid_amount,
                            'date' => date('Y-m-d'),
                            'created_by' => \Yii::$app->user->identity->id,
                            'organization_id' => \Yii::$app->user->identity->organization_id,
                        ]
                    )->execute();
                }
                
                else if($model->remaining == $model->paid_amount)
                {
                    $get_rem = EmpSalary::find()->orderBy(['emp_salary_id' => SORT_DESC])->One();
                    $model->remaining = 0;
                    $connection->createCommand()->insert('emp_salary',
                    [
                        'emp_id' => $model->emp_id,
                        'date' => $model->date,
                        'paid_amount'=>$model->paid_amount,
                        'remaining'=>$model->remaining,
                        'salary_month' => $model->salary_month,
                        'status'=>$model->status,
                        'created_by' =>Yii::$app->user->identity->id,
                        'organization_id' => Yii::$app->user->identity->organization_id,
                        'updated_by' => 0,
                        'updated_at'=> 0,
                    ])->execute();
                    $trans_model= Transactions::find()->orderBy(['transaction_id' => SORT_DESC])->One();
                    if($trans_model == "")
                    {
                        $trans->transaction_id = '1'; 
                    }
                    else
                    {
                          $trans_model->transaction_id = $trans_model->transaction_id + 1;  
                    }
                    $acc_model1 =AccountHead::find()->where(['account_name' => 'Cash'])->One();
                    if(empty($acc_model1))
                    {
                        die();
                    }
                    $acc_model =AccountHead::find()->where(['account_name' => 'Salaries'])->One();
                    if(empty($acc_model))
                    {
                        die();
                    }
                    $connection->createCommand()->insert('transactions',
                        [
                            'transaction_id' => $trans_model->transaction_id,
                            'type' => 'cash Payment',
                            'narration' => $model->narration,
                            'debit_account' => $acc_model->id,
                            'debit_amount' => $model->paid_amount,
                            'credit_account' => $acc_model1->id,
                            'credit_amount' => $model->paid_amount,
                            'date' => date('Y-m-d'),
                            'created_by' => \Yii::$app->user->identity->id,
                            'organization_id' => \Yii::$app->user->identity->organization_id,
                        ]
                    )->execute();
                }
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Create new EmpSalary",
                    'content'=>'<span class="text-success">Create EmpSalary success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Create new EmpSalary",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['id' => 'submitbutton' , 'class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->emp_salary_id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
       
    }

    public function actionGetDataDate($emp_id,$month)
    {
        $model_date = EmpSalary::find()->where(['emp_id' => $emp_id,'salary_month' => $month])->orderBY(['emp_salary_id' => SORT_DESC])->One();

        if(empty($model_date))
        {
            echo "empty";
           
        }
        else
        {
            echo Json::encode($model_date);
        }
    }

    /**
     * Updates an existing EmpSalary model.
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
                    'title'=> "Update EmpSalary #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "EmpSalary #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Update EmpSalary #".$id,
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
                return $this->redirect(['view', 'id' => $model->emp_salary_id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing EmpSalary model.
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
     * Delete multiple existing EmpSalary model.
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
     * Finds the EmpSalary model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EmpSalary the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EmpSalary::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

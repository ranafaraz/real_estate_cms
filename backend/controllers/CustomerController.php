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


/**
 * CustomerController implements the CRUD actions for Customer model.
 */
class CustomerController extends Controller
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


        $model->organization_id = \Yii::$app->user->identity->organization_id;
        $model->created_date = date('Y-m-d'); 
        $plotinfo->start_date = date('Y-m-d'); 
         $amount = $model->amount;
                $first_pay = $model->first_payment;
                $no_of_installment = $model->no_of_installment;

        



       
        // $plotinfo->end_date = date('Y-m-d');

        
        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Create new Customer",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'plotinfo' => $plotinfo,
                        'installmentinfo' => $installmentinfo,
                        'installmentstatus' => $installmentstatus,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $plotinfo->load($request->post()) && $installmentinfo->load($request->post())  && $installmentstatus->load($request->post())){
                if($model->checkifexist == '1')
                {
                    $customerid = $model->customerid;
                }
                else
                {
                    $model->save(); 
                    $customerid=$model->customer_id;
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

                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Create new Customer",
                    'content'=>'<span class="text-success">Create Customer success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote']).
                            Html::a('Create More',['index.php?r=installment.php'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Create new Customer",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'plotinfo' => $plotinfo,
                        'installmentinfo' => $installmentinfo,
                        'installmentstatus' => $installmentstatus,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }
        }else{
            /*
            *   Process for non-ajax request
            */

            if ($model->load($request->post()) && $plotinfo->load($request->post()) && $installmentinfo->load($request->post()) && $installmentstatus->load($request->post())) {
                $model->save();
                Yii::$app->MyComponent->getinfo($plotinfo->property_id,$plotinfo->plot_no,$plotinfo->start_date,$customerid);

                Yii::$app->MyComponent->installment($plotinfo->property_id,$installmentinfo->installment_type,$installmentinfo->remaning_amount,$installmentinfo->total_amount,$customerid,$installmentinfo->no_of_installments,$plotinfo->plot_no);
               
                Yii::$app->MyComponent->sold($plotinfo->property_id,$plotinfo->plot_no);

                 $installment_id = Installment::find('installment_id')->orderBy(['installment_id' => SORT_DESC])->One();

                 if($installmentinfo->installment_type == "Monthly")
                 {
                    $time = strtotime(date('Y-m-d'));
                    $final_date = date("Y-m-d", strtotime("+1 month", $time));
                 }else if($installmentinfo->installment_type == "6 Months")
                 {
                    $time = strtotime(date('Y-m-d'));
                    $final_date = date("Y-m-d", strtotime("+6 month", $time));

                 }else if($installmentinfo->installment_type == "Yearly")
                 {
                    $time = strtotime(date('Y-m-d'));
                    $final_date = date("Y-m-d", strtotime("+12 month", $time));
                 }

                Yii::$app->MyComponent->status($installment_id->installment_id,$installmentinfo->no_of_installments,$installmentstatus->installment_amount,$installmentinfo->total_amount,$installmentinfo->remaning_amount,$final_date);

                
                
                return $this->redirect(['view', 'id' => $model->no_of_installment]);
                  

            } else {
                return $this->render('create', [
                    'model' => $model,
                    'plotinfo' => $plotinfo,
                    'installmentinfo' => $installmentinfo,
                    'installmentstatus' => $installmentstatus,
                ]);
            }
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
        $plotinfo =  PlotOwnerInfo::find()->where(['customer_id' => $model->customer_id]); 
        $installmentinfo = Installment::findModel($id);
        $installmentstatus = InstallmentStatus::findModel($id);  

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
                        'plotinfo' => $plotinfo,
                    'installmentinfo' => $installmentinfo,
                    'installmentstatus' => $installmentstatus,

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
                        'plotinfo' => $plotinfo,
                    'installmentinfo' => $installmentinfo,
                    'installmentstatus' => $installmentstatus,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Update Customer #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'plotinfo' => $plotinfo,
                    'installmentinfo' => $installmentinfo,
                    'installmentstatus' => $installmentstatus,
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
                    'plotinfo' => $plotinfo,
                    'installmentinfo' => $installmentinfo,
                    'installmentstatus' => $installmentstatus,
                ]);
            }
        }
    }




    public function actionCheckCustomer($customer_cnic)
    {
        $model  = Customer::find()->where(['cnic_no' => $customer_cnic])->andwhere(['organization_id' => \Yii::$app->user->identity->organization_id])->One();

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
}

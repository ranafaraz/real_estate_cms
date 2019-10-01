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

/**
 * CustomerController implements the CRUD actions for Customer model.
 */
class CustomerController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
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
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Customer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
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

        if ($model->load(Yii::$app->request->post()) && $plotinfo->load(Yii::$app->request->post()) && $installmentinfo->load(Yii::$app->request->post())  && $installmentstatus->load(Yii::$app->request->post())) {
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
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
            'plotinfo' => $plotinfo,
            'installmentinfo' => $installmentinfo,
            'installmentstatus' => $installmentstatus,
        ]);
    }

    /**
     * Updates an existing Customer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        // $plotinfo = PlotOwnerInfo::find()->where(['customer_id' => $model->customer_id])->andwhere(['organization_id' => \Yii::$app->user->identity->organization_id] ); 
        // $installmentinfo = new Installment();
        // $installmentstatus = new InstallmentStatus();

        if ($model->load(Yii::$app->request->post()) && $plotinfo->load(Yii::$app->request->post()) && $installmentinfo->load(Yii::$app->request->post())  && $installmentstatus->load(Yii::$app->request->post()) && $model->save() && $plotinfo->save() && $installmentinfo->save() && $installmentstatus->save()) {
            return $this->redirect(['view', 'id' => $model->customer_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'plotinfo' => $plotinfo,
            'installmentinfo' => $installmentinfo,
            'installmentstatus' => $installmentstatus,
        ]);
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

    /**
     * Deletes an existing Customer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

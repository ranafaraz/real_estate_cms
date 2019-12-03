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
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new BuyPlot model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    { 
        $model = new BuyPlot();
        $customer_model = new Customer();
        $transaction_model = new Transactions();
        $acc_pay = new AccountPayable();


        $model->created_at = date('Y-m-d');
        $model->created_by = \Yii::$app->user->identity->id;
        $model->organization_id = \Yii::$app->user->identity->organization_id;
        $connection = Yii::$app->db;

        if ($model->load(Yii::$app->request->post()) && $customer_model->load(Yii::$app->request->post())) {
        if($model->remaning_price == 0)
        {
            if($customer_model->checkifexist == '1')
            {
                $model->customer_id = $customer_model->customerid;
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
                $connection->createCommand()->insert('transactions',
                    [
                        'transaction_id' => $transaction_model->transaction_id,
                        'type' => 'cash Payment',
                        'narration' => $model->narration,
                        'debit_account' => $plot_model->id,
                        'debit_amount' => $model->plot_price,
                        'credit_account' => $cash_model->id,
                        'credit_amount' => $model->plot_price,
                        'date' => date('Y-m-d'),
                        'created_by' => \Yii::$app->user->identity->id,
                        'organization_id' => \Yii::$app->user->identity->organization_id,
                    ]
                )->execute();
        }
        else
        {
            if($customer_model->checkifexist == '1')
            {
                $model->customer_id = $customer_model->customerid;
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
                $account_payable_id = AccountHead::find()->where(['account_name' => 'Plot'])->One();
                $acc_trans_model = AccountPayable::find()->orderBy(['transaction_id' => SORT_DESC])->andwhere(['organization_id' =>  \Yii::$app->user->identity->organization_id])->One();
                if(empty($account_payable_id))
                {
                    die();
                }
                if($acc_trans_model == "")
                {
                    $acc_pay->transaction_id = '1';
                }
                else
                {
                    $acc_pay->transaction_id = (int)$acc_trans_model->transaction_id + 1;
                }
                $connection->createCommand()->insert('account_payable',
                    [
                        'transaction_id' => $acc_pay->transaction_id,
                        'recipient_id' => $customer_model->customerid,
                        'amount' => $model->remaning_price,
                        'account_payable' => $account_payable_id->id,
                        'property_name' => $model->property_name,
                        'plot_no' => $model->plot_no,
                        'due_date' => $model->due_date,
                        'identifier' => 'Customer',
                        'created_at' => date('Y-m-d'),
                        'updated_at' => '',
                        'updated_by' => '',
                        'status' => 'Active',
                        'organization_id' => \Yii::$app->user->identity->organization_id,
                    ]
                )->execute();
                $account_payable_id = AccountHead::find()->where(['account_name' => 'Account Payable'])->One();
                $connection->createCommand()->insert('transactions',
                    [
                        'transaction_id' => $transaction_model->transaction_id,
                        'type' => 'cash Payment',
                        'narration' => $model->narration,
                        'debit_account' => $plot_model->id,
                        'debit_amount' => $model->remaning_price,
                        'credit_account' => $account_payable_id->id,
                        'credit_amount' => $model->remaning_price,
                        'date' => date('Y-m-d'),
                        'created_by' => \Yii::$app->user->identity->id,
                        'organization_id' => \Yii::$app->user->identity->organization_id,
                    ]
                )->execute();
                $connection->createCommand()->insert('transactions',
                    [
                        'transaction_id' => $transaction_model->transaction_id + 1,
                        'type' => 'cash Payment',
                        'narration' => $model->narration,
                        'debit_account' => $plot_model->id,
                        'debit_amount' => $model->plot_price,
                        'credit_account' => $cash_model->id,
                        'credit_amount' => $model->plot_paid_price,
                        'date' => date('Y-m-d'),
                        'created_by' => \Yii::$app->user->identity->id,
                        'organization_id' => \Yii::$app->user->identity->organization_id,
                    ]
                )->execute();
        }
            
        return $this->redirect(['view', 'id' => $model->buy_plot_id]);
        }

        return $this->render('create', [
            'model' => $model,
            'customer_model' => $customer_model,
        ]);
    }

    /**
     * Updates an existing BuyPlot model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $customer_model = Customer::find()->where(['customer_id' => $model->customer_id])->One();

        if ($model->load(Yii::$app->request->post()) && $customer_model->load(Yii::$app->request->post()) && $model->save() && $customer_model->save()) {
            

            return $this->redirect(['view', 'id' => $model->buy_plot_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'customer_model' => $customer_model,
        ]);
    }

    /**
     * Deletes an existing BuyPlot model.
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
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

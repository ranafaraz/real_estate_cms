<?php

namespace backend\controllers;

use Yii;
use backend\models\BuyPlot;
use backend\models\BuyPlotSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Transactions;
use backend\models\Customer;

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


        $model->created_at = date('Y-m-d');
        $model->created_by = \Yii::$app->user->identity->id;
        $model->organization_id = \Yii::$app->user->identity->organization_id;
        $connection = Yii::$app->db;

        if ($model->load(Yii::$app->request->post()) && $customer_model->load(Yii::$app->request->post())) {
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

                $get_customer_id = Customer::find()->orderBy(['customer_id' => SORT_DESC])->One();
                if(isset($get_customer_id))
                {

                    $model->customer_id = $get_customer_id->customer_id;
                    $model->save();
                }else
                {
                    echo "somethinf Went Wrong ";
                    return false;
                }
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

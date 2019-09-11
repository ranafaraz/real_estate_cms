<?php

namespace backend\controllers;

use Yii;
use backend\models\InstallmentPayment;
use backend\models\InstallmentPaymentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use backend\models\Plot;
use backend\models\Property;
use backend\models\Customer;
use backend\models\InstallmentStatus;
use yii\helpers\Json;
use backend\models\PlotOwnerInfo;

/**
 * InstallmentPaymentController implements the CRUD actions for InstallmentPayment model.
 */
class InstallmentPaymentController extends Controller
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
     * Lists all InstallmentPayment models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new InstallmentPaymentSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single InstallmentPayment model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   

        $instal_model = InstallmentPayment::find()->where(['installment_id' => $id])->andWhere(['organization_id' => \Yii::$app->user->identity->organization_id])->One();

        $cus_model = Customer::find()->where(['customer_id' => $instal_model->customer_id])->andWhere(['organization_id' => \Yii::$app->user->identity->organization_id])->One();
        $install = InstallmentStatus::find()->where(['installment_id' => $id])->All();

        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "InstallmentPayment #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id),
                        'cus_model' => $cus_model,
                        'install' => $install,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
                'cus_model' => $cus_model,
                'install' => $install,
            ]);
        }
    }

    /**
     * Creates a new InstallmentPayment model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new InstallmentPayment();  
       

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Create new InstallmentPayment",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,


                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post())){

                 $numbercheck = Yii::$app->MyComponent->installmentpaymentinfo($model->paid,$model->customer_id,$model->property_id,$model->plot_no);
                    Yii::$app->MyComponent->installmentstatusupdate($model->installment_no,$model->property_id,$model->customer_id,$model->plot_no,$model->paid);
                 
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Create new InstallmentPayment",
                    'content'=>'<span class="text-success">Create InstallmentPayment success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Create new InstallmentPayment",
                    'content'=>$this->renderAjax('create', [
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
                return $this->redirect(['view', 'id' => $model->installment_id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing InstallmentPayment model.
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
                    'title'=> "Update InstallmentPayment #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "InstallmentPayment #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Update InstallmentPayment #".$id,
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
                return $this->redirect(['view', 'id' => $model->installment_id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    public function actionProperty($customer_id)
    {

         $countdata = InstallmentPayment::find()->where(['customer_id' => $customer_id])->andWhere(['organization_id' => \Yii::$app->user->identity->organization_id])->count();

        $mod = InstallmentPayment::find()->where(['customer_id' => $customer_id])->andWhere(['organization_id' => \Yii::$app->user->identity->organization_id])->all();
        foreach ($mod as  $value) {
              $property = Property::find()->where(['property_id'=> $value->property_id])->andwhere(['organization_id' => \Yii::$app->user->identity->organization_id])->all();  
            }

        if($countdata > 0)
        {
            echo "<option>SELECT A VALUE</option>";
            foreach ($property as  $value1) {
                echo "<option value='".$value1->property_id . "'>". $value1->property_name ."</option>";
            }

        }else
        {
            echo "<option></option>";
        }
    }

    public function actionPrice($property_id,$plot_no)
    {

        $id = InstallmentPayment::find()->where(['property_id' => $property_id])->andWhere(['plot_no' => $plot_no])->One();
        $count = InstallmentStatus::find()->where(['installment_id' => $id->installment_id])->count();
        
        if($count > 0)
        {
            $get_amount = InstallmentStatus::find()->where(['installment_id' => $id->installment_id])->all();
            $counting =0;
            foreach ($get_amount as $value) {
                if($value->status == 1)
                {
                    echo Json::encode($value);
                    break;   
                }else if($value->status == 0)
                {
                    $counting = $counting + 1;
                }
               
            }
             if($counting == $count)
                {
                    echo "empty";
                }
        }
            
    }
      

    /**
     * Delete an existing InstallmentPayment model.
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
     * Delete multiple existing InstallmentPayment model.
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
     * Finds the InstallmentPayment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return InstallmentPayment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = InstallmentPayment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

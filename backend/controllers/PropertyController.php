<?php

namespace backend\controllers;

use Yii;
use backend\models\Property;
use backend\models\PropertySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use backend\models\User;
use backend\models\Organization;
use yii\helpers\json;
use backend\models\Plot;

/**
 * PropertyController implements the CRUD actions for Property model.
 */
class PropertyController extends Controller
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

    public function actionSearch()
    {
        $propertymodel= new Property;
         if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'content'=>$this->renderAjax('index', [
                        'propertymodel' => $propertymodel,
                    ]),
                   
                ];         
            }else if($propertymodel->load($request->post()) ){

               
                
                $propertymodel->save();
                       
            }else{           
                return [
                    'title'=> "Create new Property",
                    'content'=>$this->renderAjax('index', [
                        'propertymodel' => $propertymodel,
                    ]),
                    
        
                ];         
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($propertymodel->load($request->post()) ) {
                
                $propertymodel->save();
               

                return $this->redirect(['index', 'id' => $propertymodel->property_id]);
            } else {
                return $this->render('index', [
                    'propertymodel' => $propertymodel,
                ]);
            }
        }
        echo $propertymodel->selected_id;
        die();
    
    }



    public function actionGetPropertyId($property_id)
    {
        $property_id=$property_id;
        $record=Property::findOne(['property_id'=>$property_id]);
        echo json::encode($record);
    }
    /**
     * Lists all Property models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new PropertySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if (yii::$app->request->post('hasEditable')) {
            $property_id = yii::$app->request->post('editableKey');
            $property = Property::findOne($property_id);

            $out = json::encode(['output' => '', 'message' => '']);
            $subpost = [];
            $posted = current($_POST['Property']);
            $subpost['Property'] = $posted;
            if ($property->load($subpost)) {
                // Plot::deleteAll(['property_id'=>$property_id]);
                // $ret=Yii::$app->InsertPlots->insertplots($property_id,$subpost);
                $property->save();
               
            }
            echo $out;
            return;
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Property model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Property #".$id,
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
     * Creates a new Property model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Property();  
        $model->created_at = date("Y-m-d");
        $model->created_by = \Yii::$app->user->identity->username;
        $user=User::findone(["username"=>\Yii::$app->user->identity->username]);

        $model->organization_id=yii::$app->user->identity->organization_id;
        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->validate()){
                
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($model->save()) {
                        Yii::$app->InsertPlots->insertplots($model->property_id,$model->no_of_plots);
                        $transaction->commit();
                        return [
                            'forceReload'=>'#crud-datatable-pjax',
                            'title'=> "",
                            'content'=>'<span class="text-success">Create Property success</span>',
                            'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                    Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
                
                        ];     
                           
                    }else{
                        $transaction->rollback();
                        return [
                            'forceReload'=>'#crud-datatable-pjax',
                            'title'=> "",
                            'content'=>'<span class="text-success">Create Property Failed! Please Try Again.</span>',
                            'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                    Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
                
                        ]; 
                    }
                }
                catch (Exception $e) {
                    // transaction rollback
                    $transaction->rollback();
                    return [
                            'forceReload'=>'#crud-datatable-pjax',
                            'title'=> "",
                            'content'=>'<span class="text-success">Create Property Failed! Please Try Again.</span>',
                            'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                    Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
                
                        ]; 
                } // closing of catch block
                // closing of transaction handling
                // 
               
                
                        
            }else{           
                return [
                    'title'=> "",
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
            if ($model->load($request->post()) ) {
                
                $model->save();
                $ret=Yii::$app->InsertPlots->insertplots($model->property_id,$model->no_of_plots);

                return $this->redirect(['view', 'id' => $model->property_id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
       
    }




    /**
     * Updates an existing Property model.
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
                    'title'=> "Update Property #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Property #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Update Property #".$id,
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
                return $this->redirect(['view', 'id' => $model->property_id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing Property model.
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
     * Delete multiple existing Property model.
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
     * Finds the Property model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Property the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Property::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

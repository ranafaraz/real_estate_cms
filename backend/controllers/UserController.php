<?php

namespace backend\controllers;

use Yii;
use backend\models\User;
use backend\models\UserSearch;
use backend\models\AuthItem;
use backend\models\AuthAssignment;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\web\UploadedFile;
/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $user = User::findOne(["username"=>\Yii::$app->user->identity->username]);
        $userID = $user->id;
        $auth_model = AuthAssignment::find()
        ->where(['user_id' => $userID])
        ->one();
        if ($auth_model->item_name == 'Admin'){
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }else {
            \Yii::$app->getSession()->setFlash('error', "<b>Access Denied!</b><h5>Sorry! You don't have permission to access this page.</h5>"); 
            return $this->redirect('http://localhost/account/advanced/backend/web/index.php');
            echo Yii::$app->session->getFlash('error');
        }
    }


    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $user = User::findOne(["username"=>\Yii::$app->user->identity->username]);
        $userID = $user->id;
        $auth_model = AuthAssignment::find()
        ->where(['user_id' => $userID])
        ->one();
        if ($auth_model->item_name == 'Admin'){
        $request = Yii::$app->request;
        $auth_model = AuthAssignment::find()
        ->where(['user_id' => $id])
        ->one();

        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "User #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id),
                        'auth_model' => $auth_model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
                'auth_model' => $auth_model,
            ]);
        }
        }else {
            \Yii::$app->getSession()->setFlash('error', "<b>Access Denied!</b><h5>Sorry! You don't have permission to access this page.</h5>"); 
            return $this->redirect('http://localhost/account/advanced/backend/web/index.php');
            echo Yii::$app->session->getFlash('error');
        }
    }

    /**
     * Creates a new User model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $user = User::findOne(["username"=>\Yii::$app->user->identity->username]);
        $userID = $user->id;
        $auth_model = AuthAssignment::find()
        ->where(['user_id' => $userID])
        ->one();
        if ($auth_model->item_name == 'Admin'){
        $request = Yii::$app->request;
        $model = new User();
         $user = User::findOne(["username"=>\Yii::$app->user->identity->username]);
        $authitems = AuthItem::find()->all(); 
        $auth_model = new AuthAssignment();
         

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Create new User",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'authitems' => $authitems,
                        'auth_model' => $auth_model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $auth_model->load(Yii::$app->request->post())){
                $model->setPassword($model->password_hash);
                $model->generateAuthKey();
                $model->generateEmailVerificationToken();            
                $model->created_at = date('Y-m-d h:m:s');
                $model->updated_at = date('Y-m-d h:m:s');
                $model->organization_id = $user->organization_id;
                $model->image_name = UploadedFile::GetInstance($model, 'image_name');   
                if (!empty($model->image_name)) {

                $im_name = $model->username;
                
                $model->image_name->SaveAs('uploads/' . $im_name . '.' . $model->image_name->extension);
                $model->image_name = 'uploads/' . $im_name . '.' . $model->image_name->extension;
                 $model->save();
            }else{
                 $model->image_name = 'uploads/usr.png';
                  $model->save();
            }
               
               

                $userid = $model->getPrimaryKey();
                $authID = AuthAssignment::find()->orderBy(['id'=>SORT_DESC])->One();
                $authid = ($authID->id)+1;
                
                    Yii::$app->db->createCommand()->insert('auth_assignment', ['id' => $authid, 'user_id' => $userid,
                        'item_name' => $auth_model->item_name,
                        'created_at' => date('Y-m-d h:m:s'),
                    ])->execute();
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Create new User",
                    'content'=>'<span class="text-success">Create User success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Create new User",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'authitems' => $authitems,
                        'auth_model' => $auth_model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $auth_model->load(Yii::$app->request->post())){
                $model->setPassword($model->password_hash);
                $model->generateAuthKey();
                $model->generateEmailVerificationToken();            
                $model->created_at = date('Y-m-d h:m:s');
                $model->updated_at = date('Y-m-d h:m:s');
                $model->organization_id = $user->organization_id;
                $model->save();

                $userid = $model->getPrimaryKey();
                $authID = AuthAssignment::find()->orderBy(['id'=>SORT_DESC])->One();
                $authid = ($authID->id)+1;
                
                    Yii::$app->db->createCommand()->insert('auth_assignment', ['id' => $authid, 'user_id' => $userid,
                        'item_name' => $auth_model->item_name,
                        'created_at' => date('Y-m-d h:m:s'),
                    ])->execute();
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'authitems' => $authitems,
                    'auth_model' => $auth_model,
                ]);
            }
        }
        }else {
            \Yii::$app->getSession()->setFlash('error', "<b>Access Denied!</b><h5>Sorry! You don't have permission to access this page.</h5>"); 
            return $this->redirect('http://localhost/account/advanced/backend/web/index.php');
            echo Yii::$app->session->getFlash('error');
        }
       
    }

    /**
     * Updates an existing User model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $user = User::findOne(["username"=>\Yii::$app->user->identity->username]);
        $userID = $user->id;
        $auth_model = AuthAssignment::find()
        ->where(['user_id' => $userID])
        ->one();
        if ($auth_model->item_name == 'Admin'){
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $authitems = AuthItem::find()->all(); 
        $auth_model = AuthAssignment::find()
        ->where(['user_id' => $id])
        ->one();       

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update User #".$model->username,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'authitems' => $authitems,
                        'auth_model' => $auth_model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $auth_model->load(Yii::$app->request->post())){
                $model->setPassword($model->password_hash);
                $model->generateAuthKey();
                $model->generateEmailVerificationToken();
                $model->updated_at = date('Y-m-d h:m:s');
                $model->save();

                $userid = $model->getPrimaryKey();
                $authID = AuthAssignment::find()->orderBy(['id'=>SORT_DESC])->One();
                $authid = ($authID->id)+1;

                Yii::$app->db->createCommand()
                            ->update('auth_assignment', ['id' => $authid, 'user_id' => $userid,
                        'item_name' => $auth_model->item_name,
                        'created_at' => date('Y-m-d h:m:s'),
                        ], ['user_id'=>$userid] )
                             ->execute();                
                   
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "User #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                        'authitems' => $authitems,
                        'auth_model' => $auth_model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Update User #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'authitems' => $authitems,
                        'auth_model' => $auth_model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];        
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $auth_model->load(Yii::$app->request->post())){
                $model->setPassword($model->password_hash);
                $model->generateAuthKey();
                $model->generateEmailVerificationToken();
                $model->updated_at = date('Y-m-d h:m:s');
                $model->save();

                $userid = $model->getPrimaryKey();
                $authID = AuthAssignment::find()->orderBy(['id'=>SORT_DESC])->One();
                $authid = ($authID->id)+1;
                
                    Yii::$app->db->createCommand()->insert('auth_assignment', ['id' => $authid,
                        'user_id' => $userid,
                        'item_name' => $auth_model->item_name,
                        'created_at' => date('Y-m-d h:m:s'),
                    ])->execute();
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'authitems' => $authitems,
                    'auth_model' => $auth_model,
                ]);
            }
        }
        }else {
            \Yii::$app->getSession()->setFlash('error', "<b>Access Denied!</b><h5>Sorry! You don't have permission to access this page.</h5>"); 
            return $this->redirect('http://localhost/account/advanced/backend/web/index.php');
            echo Yii::$app->session->getFlash('error');
        }
    }

    /**
     * Delete an existing User model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $user = User::findOne(["username"=>\Yii::$app->user->identity->username]);
        $userID = $user->id;
        $auth_model = AuthAssignment::find()
        ->where(['user_id' => $userID])
        ->one();
        if ($auth_model->item_name == 'Admin'){
        $request = Yii::$app->request;
        $model = AuthAssignment::findOne(['user_id'=>$id]);
        $model->delete();
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
        }else {
            \Yii::$app->getSession()->setFlash('error', "<b>Access Denied!</b><h5>Sorry! You don't have permission to access this page.</h5>"); 
            return $this->redirect('http://localhost/account/advanced/backend/web/index.php');
            echo Yii::$app->session->getFlash('error');
        }

    }

     /**
     * Delete multiple existing User model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkDelete()
    {        
        $user = User::findOne(["username"=>\Yii::$app->user->identity->username]);
        $userID = $user->id;
        $auth_model = AuthAssignment::find()
        ->where(['user_id' => $userID])
        ->one();
        if ($auth_model->item_name == 'Admin'){
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
        foreach ( $pks as $pk ) {
            $auth_model = AuthAssignment::find()->where(['user_id'=>$pk])->one();
            //$auth_model->isNewRecord = true;
            $auth_model->delete();
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
       }else {
            \Yii::$app->getSession()->setFlash('error', "<b>Access Denied!</b><h5>Sorry! You don't have permission to access this page.</h5>"); 
            return $this->redirect('http://localhost/account/advanced/backend/web/index.php');
            echo Yii::$app->session->getFlash('error');
        }
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

<?php

namespace frontend\controllers;

use Yii;
use frontend\models\User;
use frontend\models\UserSearch;
use frontend\models\AuthItem;
use frontend\models\AuthAssignment;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use yii\helpers\ArrayHelper;

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
            'access' => [
                    'class' => AccessControl::className(),                    
                    'rules' => [
                        [                            
                            'allow' => true,
                            'roles' => ['@'],
                        ],                
                    ],
                ],          
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
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
        $searchModel = new UserSearch();
        
        /* show only active users in main list view */
        $qParams = Yii::$app->request->queryParams;
        $qParams['UserSearch']['status'] = 'active';
        $dataProvider = $searchModel->search($qParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        /* get persently assigned roles */
        $authRolesAssigned = AuthAssignment::find()->where(['user_id' => $id])->all();            
        $authRolesAssigned = ArrayHelper::map($authRolesAssigned,'item_name','item_name');            
        $authRolesAssigned = implode(', ', $authRolesAssigned);

        /* authRolesAssigned model variable is used to supply string here, which otherwise supplies array in actionUpdate */
        $model->authRolesAssigned = $authRolesAssigned;

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        /* check authorization */
        if(!Yii::$app->user->can('user-create')) {        
            throw new ForbiddenHttpException;
        }
        
        $model = new User();

        /* Fetch and prepare authRolesAll and authRolesAssigned from auth_item and auth_assignment */
        /* 1.get all items (permissions + roles) from auth_item */
        $authRolesAll = null;
        $authRolesAll = AuthItem::find()->all();            
        $authRolesAll = ArrayHelper::map($authRolesAll,'name','name');

        /* 2.remove permission items, keep role items */
        foreach($authRolesAll as $key => $value) {
            if(strpos($value, '-') !== false){
                unset($authRolesAll[$key]);
            }
        }

        $model->authRolesAll = $authRolesAll;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        /* check authorization */
        if (! (Yii::$app->user->can('user-update') || (Yii::$app->user->getId() == $id))) {
            throw new ForbiddenHttpException;
        }

        $model = $this->findModel($id);

        /* Fetch and prepare authRolesAll and authRolesAssigned from auth_item and auth_assignment */
        /* 1.get all items (permissions + roles) from auth_item */
        $authRolesAll = null;
        $authRolesAll = AuthItem::find()->all();            
        $authRolesAll = ArrayHelper::map($authRolesAll,'name','name');

        /* 2.remove permission items, keep role items */
        foreach($authRolesAll as $key => $value) {
            if(strpos($value, '-') !== false){
                unset($authRolesAll[$key]);
            }
        }

        $model->authRolesAll = $authRolesAll;

        /* 3.get roles assigned to current user */
        $authRolesAssigned = AuthAssignment::find()->where(['user_id' => $id])->all();            
        $authRolesAssigned = ArrayHelper::map($authRolesAssigned,'item_name','item_name');            
        $model->authRolesAssigned = $authRolesAssigned;

        if ($model->load(Yii::$app->request->post())) {

            // tune it
            //date_default_timezone_set('Asia/Kolkata');
            //$model->updated_at = date('Y-m-d', time());  
                           
            $model->save();

            /* updating user's auth roles */
            /* 1.clearing old auth roles */                
            AuthAssignment::deleteAll('user_id = '.$id);                
                
            /* 2.adding new auth roles*/
            $newAuthRoles = Yii::$app->request->post()['User']['authRolesAssigned'];

            foreach ($newAuthRoles as $value){                                        
                $newAuthRole = new AuthAssignment;
                $newAuthRole->user_id = $id;
                $newAuthRole->item_name = $value;    
                $newAuthRole->save();                                    
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        /* check authorization */
        if(!Yii::$app->user->can('user-delete')) {        
            throw new ForbiddenHttpException;
        }

        /**$this->findModel($id)->delete();*/
        
        /** comment above line and uncomment this when switching from hard delete to soft delete.*/
        $model = $this->findModel($id);
        $username = $model->username;
        
        $model->status = "deleted";
        if(!$model->validate()) {            
                  $errors = $model->getErrors();
                  var_dump($errors); //or print_r($errors)
                  exit;
             }            
        $model->save();
        
        return $this->redirect(['index']);
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

    /**
     * Lists all User models. 
     * @return mixed
     */
    public function actionManage()
    {
        /* check authorization */        
        if (!(Yii::$app->user->can('user-manage'))) {
            throw new ForbiddenHttpException;
        }

        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('manage', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}

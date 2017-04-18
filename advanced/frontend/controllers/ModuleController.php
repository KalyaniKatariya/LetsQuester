<?php

namespace frontend\controllers;


use Yii;
use frontend\models\Module;
use frontend\models\ModuleSearch;
use frontend\models\ReviewComment;
use frontend\models\User;
use frontend\models\Learning;
use frontend\models\AuthAssignment;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;  //Added by kalyani


use yii\helpers\ArrayHelper;

/**
 * ModuleController implements the CRUD actions for Module model.
 */
class ModuleController extends Controller
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

    /* ALL USERTYPE MODULE LIST() ACTIONS STARTS ----------------------*/
    /**
     * Lists all published Module models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ModuleSearch();
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        /* show only modules whose with status = {published, archived} in list view */
        $qParams = Yii::$app->request->queryParams;
        $qParams['ModuleSearch']['statusList'] = ['published','archived'];
        $dataProvider = $searchModel->search($qParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Owner Module models.
     * @return mixed
     */
    public function actionOwner()
    {
        $searchModel = new ModuleSearch();
        
        /* show only modules owned by loggedin user list view */
        $qParams = Yii::$app->request->queryParams;
        $qParams['ModuleSearch']['owner_id'] = Yii::$app->user->getId();
        $dataProvider = $searchModel->search($qParams);

        return $this->render('owner', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Reviewer Module models.
     * @return mixed
     */
    public function actionReviewer()
    {
        $searchModel = new ModuleSearch();
        
        /* show only modules owned by loggedin user list view */
        $qParams = Yii::$app->request->queryParams;
        $qParams['ModuleSearch']['reviewer_id'] = Yii::$app->user->getId();
        $dataProvider = $searchModel->search($qParams);

        return $this->render('reviewer', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Learner Module models.
     * @return mixed
     */
    public function actionLearner()
    {
        $searchModel = new ModuleSearch();
        
        $learningModuleIdList = Learning::find()->where(['learner_id' => Yii::$app->user->getId()])->all();
        $learningModuleIdList = ArrayHelper::map($learningModuleIdList,'module_id','module_id');            
        //$learningModuleIdList = implode(', ', $learningModuleIdList);
        
        if(empty($learningModuleIdList)){            
            $learningModuleIdList['0'] = 0;
        }

        /* show only modules owned by loggedin user list view */
        $qParams = Yii::$app->request->queryParams;
        $qParams['ModuleSearch']['moduleIdList'] = $learningModuleIdList;
        $dataProvider = $searchModel->search($qParams);

        return $this->render('learner', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /* ALL USERTYPE MODULE LIST() ACTIONS ENDS ------------------------*/
    /* MASTER VIEW PAGE-ACTION STARTS ---------------------------------*/    

    /**
     * Displays a single Module model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $reviewComments = ReviewComment::find()->where(['module_id' => $id])->all();
        $model = $this->findModel($id);
        $model->reviewComments = $reviewComments;

        /* get learning status for loggedin user + viewing module combination */
        /*tune it. rewrite it altogether. */
        $learning = Learning::find()
            ->where(['learner_id' => Yii::$app->user->getId()])
            ->andWhere(['module_id' => $id])
            ->orderBy(['id' => SORT_DESC])
            ->one();                
        /*if(!empty($learning)){
            $model->learnerOne = $learning[0];
        } */
        $model->learnerOne = $learning;


        return $this->render('view', [
            'model' => $model,
        ]);
    }
    
    /* MASTER VIEW PAGE-ACTION ENDS -----------------------------------*/    
    /* OWNER ACTIONS STARTS -------------------------------------------*/

    /**
     * Creates a new Module model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Module();

        
        if ($model->load(Yii::$app->request->post())) {

            $createdBy = Yii::$app->user->getId();
            $model->owner_id = $createdBy;
            $model->status = 'in-making';
            $model->review_status = 'yet-to-review';

            if(!$model->validate()) {            
                  $errors = $model->getErrors();
                  var_dump($errors); //or print_r($errors)
                  exit;
            }
            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionCreateDag(){
        $model = new Module();

       return $this->render('createDag', [ 'model' => $model,]);
    }

    /**
     * Updates an existing Module model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $model->status = 'in-making';
            $model->save();            
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Sets module 'status' as completed for an existing Module model.
     * If completed status is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionComplete($id)
    {
        $model = $this->findModel($id);
        $model->status = 'completed';
        $model->save();

        return $this->redirect(['view', 'id' => $model->id]);
    }

    /**
     * Sets module 'status' as published for an existing Module model.
     * If completed status is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionPublish($id)
    {
        $model = $this->findModel($id);
        $model->status = 'published';
        $model->save();

        return $this->redirect(['view', 'id' => $model->id]);
    }

    /**
     * Deletes an existing Module model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /* OWNER ACTIONS ENDS ---------------------------------------------*/
    /* REVIEWER ACTIONS STARTS ----------------------------------------*/
    
    /**
     * Submits existing Module model for review by enquiry specialist.
     * If submit for review is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionReview($id)
    {
        $model = $this->findModel($id);

        if('in-review' == $model->status){
            /* no changing of reviewer permitted when module is in-review */
            $enquirySpecialistsList["$model->reviewer_id"] = User::findOne($model->reviewer_id)['name'];
        } else {        
            /* get (id,name) as (key,value) array/list of enquiry specialists */
            $subQuery = AuthAssignment::find()->where((['item_name' => 'enquiryspecialist']))->all();
            $subQuery = ArrayHelper::map($subQuery,'user_id','user_id');
            $mainQuery = User::find()->where(['in', 'id', $subQuery])->all();
            $enquirySpecialistsList = ArrayHelper::map($mainQuery, 'id', 'name' );                        
        }        
        $model->enquirySpecialistsList = $enquirySpecialistsList;       

        if ($model->load(Yii::$app->request->post())) {

            $model->status = 'in-review';
            if($model->owner_id == Yii::$app->user->getId()){
                /* meaning review is submitted by module owner. So review_status has to be 'in-review'*/
                $model->review_status = 'in-review';    
            }    

            if( ($model->reviewer_id == Yii::$app->user->getId()) and ('approved' == $model->review_status)){
                /* review is approved so ALSO change model status to approved (along with review status).*/
                $model->status = 'approved';
            }         

            /* adding review comment to review_comment model */
            $modelComment = new ReviewComment();
            $modelComment->commenter_id = Yii::$app->user->getId();
            $modelComment->module_id = $model->id;
            $modelComment->comment = $model->reviewComment;
            $modelComment->review_status_before = $model->review_status;
            $modelComment->review_status_after = $model->review_status;
            $modelComment->save();

            $model->save();            
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('review', [
                'model' => $model,
            ]);
        }
    }

    /* REVIEWER ACTIONS ENDS -------------------------------------------*/
    /* LEARNER ACTIONS STARTS ------------------------------------------*/

    /**
     * Sets module-learning status to 'shortlisted' Module model.
     * If completed status is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionShortlistlearning($id)
    {
        $model = new Learning();
        $model->learner_id = Yii::$app->user->getId();
        $model->module_id = $id;
        $model->status = 'shortlisted';
        $model->save();
        
        return $this->redirect(['view', 'id' => $model->module_id]);
    }

    /**
     * Sets module-learning status to 'on-going' Module model.
     * If completed status is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionStartlearning($id)
    {
        $model = Learning::find()->
            where(['module_id' => $id])->
            andwhere(['learner_id' => Yii::$app->user->getId()])->
            andwhere(['status' => 'shortlisted'])->
            one();
        $model->status = 'on-going';
        $model->save();
        
        return $this->redirect(['view', 'id' => $model->module_id]);
    }

    /**
     * 
     * If completed status is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionResumelearning($id)
    {
        /*$model = Learning::find()->
            where(['module_id' => $id])->
            andwhere(['learner_id' => Yii::$app->user->getId()])->
            andwhere(['status' => 'shortlisted'])->
            one();
        $model->status = 'on-going';
        $model->save();
        */
        
        return $this->redirect(['view', 'id' => $id]);
    }

    /**
     * Sets module-learning status to 'completed' Module model.
     * If completed status is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    
    public function actionCompletedlearning($id)
    {
        $model = Learning::find()->
            where(['module_id' => $id])->
            andwhere(['learner_id' => Yii::$app->user->getId()])->
            andwhere(['status' => 'on-going'])->
            one();
        $model->status = 'completed';
        $model->save();
        
        return $this->redirect(['view', 'id' => $model->module_id]);
    }

    /**
     * creates new learning model and sets status as 'on-going'.
     * If completed status is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionStartlearningagain($id)
    {
        $model = new Learning();
        $model->learner_id = Yii::$app->user->getId();
        $model->module_id = $id;
        $model->status = 'on-going';
        $model->save();
        
        return $this->redirect(['view', 'id' => $model->module_id]);
    }

    /* LEARNER ACTIONS ENDS -------------------------------------------*/

    /**
     * Finds the Module model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Module the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Module::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Lists all Module models.
     * @return mixed
     */
    public function actionManage()
    {
        $searchModel = new ModuleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}

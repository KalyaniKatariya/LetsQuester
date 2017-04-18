<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use frontend\models\User;


/* @var $this yii\web\View */
/* @var $model frontend\models\Module */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Modules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="module-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>                
        <!-- module owner actions -->
        <?php
            if ($model->owner_id == Yii::$app->user->getId()){
            ?>

            <!-- update module -->
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>        

            <!-- mark as completed -->
            <?php
                $completedButtonStyleClass = "btn btn-success";
                if('completed' == $model->status){
                    $completedButtonStyleClass = "btn btn-success disabled";
                }
                echo Html::a('Mark as Completed', ['complete', 'id' => $model->id], [
                    'class' => $completedButtonStyleClass,
                    'data' => [
                        'confirm' => 'Are you sure you want to mark this module as completed?',
                        'method' => 'post',
                    ],
                ]);
            ?>
            
            <!-- submit for review -->
            <?php
                if ('completed'==$model->status){
                    echo Html::a('Submit for Review', ['review', 'id' => $model->id], [
                        'class' => 'btn btn-primary',                
                    ]);
                }
            ?>

            <!-- publish module - make it available for learners -->
            <?php
                if ('approved'==$model->review_status){
                    echo Html::a('Publish Module', ['publish', 'id' => $model->id], [
                        'class' => 'btn btn-primary',       
                        'data' => [
                        'confirm' => 'Are you sure you want to publish this module?',
                        'method' => 'post',
                    ],         
                    ]);
                }
            ?>

            <?php
            }
        ?>

        <!-- module reviewer actions -->
        <?php
            if ($model->reviewer_id == Yii::$app->user->getId()){
                
                if('approved' == $model->review_status){
                    echo "<br><b>Module already reviewed and approved.</b>";
                }else{
                    echo Html::a('Review Module', ['review', 'id' => $model->id], [
                    'class' => 'btn btn-primary',]);
                }
            }
        ?>

        <!-- module learner actions -->
        <?php
        if(empty($model->learnerOne)){

            echo Html::a('Shortlist for learning', ['shortlistlearning', 'id' => $model->id], [
                        'class' => 'btn btn-primary',       
                        'data' => [
                        'confirm' => 'Are you sure you want to shortlist this module for learning?',
                        'method' => 'post',
                    ],         
                ]);

        } else {
            if("shortlisted" == $model->learnerOne->status){
                
                echo "Shortlisted. ";
                echo Html::a('Start learning', ['startlearning', 'id' => $model->id], [
                'class' => 'btn btn-primary',]);        

            } elseif ("on-going" == $model->learnerOne->status){

                echo "On-going module. ";
                echo Html::a('Resume learning', ['resumelearning', 'id' => $model->id], [
                'class' => 'btn btn-primary',]);        
                echo "&nbsp &nbsp or &nbsp &nbsp";
                echo Html::a('Learning completed', ['completedlearning', 'id' => $model->id], [
                'class' => 'btn btn-success',
                'data' => [
                        'confirm' => 'Are you sure you mark this module as completed?',
                        'method' => 'post',
                    ],
                ]);

            } else{

                echo "You have already completed this module. ";
                echo Html::a('Learn again.', ['startlearningagain', 'id' => $model->id], [
                'class' => 'btn btn-primary',]);        
            }
        }
        ?>

         <!--
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        -->
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'status',
            'id',
            'owner_id',
            'name',
            'description:ntext',            
            'review_status',
            'reviewer_id',
        ],
    ]) ?>


    <?php 
        if (isset($model->reviewComments)){
            ?>
            <hr>
            <h3>Review Comments</h3>
            <div class="row">        
                <div class="col-md-8">
                    <div class="row">    
                    <div class="col-md-8">
                        <table class="table table-striped">            
                        <?php 
                        foreach ($model->reviewComments as $comment) {
                            ?>
                            <tr><td style="border-bottom:1px solid #ddd;">
                            <!-- tune it. Do NOT use model in view directly -->
                            <br>
                            <small>Comment by: <?=User::findOne($comment->commenter_id)['name'];?></small>
                            <br>
                            <?=$comment->comment?>
                            <br>
                            <small>Module review status: <?=$comment->review_status_after?></small>
                            </td></tr>               
                        <?php
                        }            
                        ?>
                        </table>
                    </div>
                    <div class="col-md-4">
                    </div>
                    </div>
                </div>
            </div>
            <?php
        }
    ?>
</div>

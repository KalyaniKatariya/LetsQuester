<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\LearningCommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Learning Comments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="learning-comment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Learning Comment', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'commenter_id',
            'module_id',
            'comment:ntext',
            'learning_status_before',
            // 'learning_status_after',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

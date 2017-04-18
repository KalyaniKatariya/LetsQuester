<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\SearchReviewComment */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Review Comments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="review-comment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Review Comment', ['create'], ['class' => 'btn btn-success']) ?>
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
            'review_status_before',
            'review_status_after',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

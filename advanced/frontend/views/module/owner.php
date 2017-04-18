<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ModuleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'My Owner Modules';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Module', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'owner_id',
            'name',
            [
            'label' => 'Description',
                'attribute' => 'description',
                'format' => 'raw',
            'contentOptions'=>[ 
                    'style'=>'width:50%;max-width:400px; word-wrap: break-word; white-space:normal;',                    
                    ],
            ],            
            'status',
            // 'review_status',
            // 'reviewer_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

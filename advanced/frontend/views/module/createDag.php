<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

use kartik\tree\TreeView;
use frontend\models\createDag;
use kartik\tree\TreeViewInput;




echo TreeView::widget([
    // single query fetch to render the tree
    // use the Product model you have in the previous step
    'query' => createDag::find()->addOrderBy('root, lft'), 
    'headingOptions' => ['label' => 'Categories'],
    'rootOptions' => ['label'=>'<span class="text-primary">Root</span>'],
    'fontAwesome' => true,
    'isAdmin' => true,
    'displayValue' => 1,
    'iconEditSettings'=> [
        'show' => 'list',
        'listData' => [
            'folder' => 'Folder',
            'file' => 'File',
            'mobile' => 'Phone',
            'bell' => 'Bell',
        ]
    ],
    'softDelete' => true,
    'cacheSettings' => ['enableCache' => true]

]);

   <div>

        <?= Html::submitButton($model->isNewRecord ? 'Continue' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?> <br>  <br> <br>

             
    </div>


?>

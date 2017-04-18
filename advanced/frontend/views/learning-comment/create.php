<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\LearningComment */

$this->title = 'Create Learning Comment';
$this->params['breadcrumbs'][] = ['label' => 'Learning Comments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="learning-comment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

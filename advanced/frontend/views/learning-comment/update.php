<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\LearningComment */

$this->title = 'Update Learning Comment: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Learning Comments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="learning-comment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

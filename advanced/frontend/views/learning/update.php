<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Learning */

$this->title = 'Update Learning: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Learnings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="learning-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

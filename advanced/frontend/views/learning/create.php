<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Learning */

$this->title = 'Create Learning';
$this->params['breadcrumbs'][] = ['label' => 'Learnings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="learning-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

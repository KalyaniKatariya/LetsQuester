<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\ReviewComment */

$this->title = 'Create Review Comment';
$this->params['breadcrumbs'][] = ['label' => 'Review Comments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="review-comment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

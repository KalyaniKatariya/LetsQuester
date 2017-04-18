<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\SearchReviewComment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="review-comment-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'commenter_id') ?>

    <?= $form->field($model, 'module_id') ?>

    <?= $form->field($model, 'comment') ?>

    <?= $form->field($model, 'review_status_before') ?>

    <?php // echo $form->field($model, 'review_status_after') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

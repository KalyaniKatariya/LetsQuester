<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ReviewComment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="review-comment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'commenter_id')->textInput() ?>

    <?= $form->field($model, 'module_id')->textInput() ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'review_status_before')->dropDownList([ 'yet-to-review' => 'Yet-to-review', 'in-review' => 'In-review', 'suggestions' => 'Suggestions', 'approved' => 'Approved', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'review_status_after')->dropDownList([ 'yet-to-review' => 'Yet-to-review', 'in-review' => 'In-review', 'suggestions' => 'Suggestions', 'approved' => 'Approved', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Module */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="module-form">

    <?php $form = ActiveForm::begin(); ?>
        
    <?= $form->field($model, 'reviewer_id')->dropDownList($model->enquirySpecialistsList,['prompt'=>'Select Reviewer'])->label('Select Reviewer') ?> 

    <?php
    	if($model->owner_id == Yii::$app->user->getId()){
    		$label = "Module owner's comment";
    	} else {
    		$label = "Reviewer's comment";
    	}
    	echo $form->field($model, 'reviewComment')->textarea(['rows' => 6])->label($label); 

    	if($model->reviewer_id == Yii::$app->user->getId()){
    		echo $form->field($model, 'review_status')->dropDownList([ 'yet-to-review' => 'Yet-to-review', 'in-review' => 'In-review', 'suggestions' => 'Suggestions', 'approved' => 'Approved', ], ['prompt' => '']);
    	}
    ?>

    <div class="form-group">
        <?= Html::submitButton('Submit for Review', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

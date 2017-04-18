<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Module */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="module-form">

    <?php $form = ActiveForm::begin(); ?>

    <!--
    <?= $form->field($model, 'owner_id')->textInput() ?>
    -->

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

     <?= $form->field($model, 'outcome')->textInput(['maxlength' => true]) ?>//need to decide whether this will be drop down or textinput

      <?= $form->field($model, 'mode_of_inquiry')->dropDownList(['ethical' => 'Ethical Inquiry', 'scintific' => 'Scintific Inquiry', 'mathematical' => 'Mathematical Inquiry', 'history' => 'Historical Inquiry',]) ?>

     <?= $form->field($model, 'age_group')->textInput(['maxlength' => true]) ?>  //need to decide whether this will be drop down or textinput

     <?= $form->field($model, 'intro_txt')->textarea(['rows' => 7]) ?>

     <?= $form->field($model, 'add_vid_img')->textInput(['maxlength' => true]) ?>//this will textinput with browse button to upload newly created video or designed image.

    
    <!--
    <?= $form->field($model, 'status')->dropDownList([ 'in-making' => 'In-making', 'completed' => 'Completed', 'in-review' => 'In-review', 'approved' => 'Approved', 'published' => 'Published', 'archived' => 'Archived', 'deleted' => 'Deleted', ], ['prompt' => '']) ?>
    
    <?= $form->field($model, 'review_status')->dropDownList([ 'yet-to-review' => 'Yet-to-review', 'in-review' => 'In-review', 'suggestions' => 'Suggestions', 'approved' => 'Approved', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'reviewer_id')->textInput() ?>
    -->

    <div class="form-group">

        <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?> <br>  <br> <br>
        <!--Need to updae the section with only save action and after the dag structure gets saved it should redirect to those update buttons and nnext cycle. DAG strure must be stored with module id -->

       <?= Html::a('Continue to Create DAG Structure', ['/module/create-dag'], ['class'=>'btn btn-primary']) ?>

       
    </div>

    <?php ActiveForm::end(); ?>

</div>

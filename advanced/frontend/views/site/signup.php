<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
     <h1><?= Html::encode("Let's Quester - Platform for Inquiry Learners") ?></h1>
    <hr>
    <h3><?= Html::encode($this->title) ?></h3>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'purpose')->textInput(['maxlength' => true]) ?>
 
                 <?= $form->field($model, 'profession')->textInput(['maxlength' => true]) ?>

                
                 <div class=row>
                    <div class="col-md-3">
                        <div class="form-group">
                        <?= Html::submitButton('Signup', ['class' => 'btn btn-success', 'name' => 'signup-button']) ?>
                        </div>                    
                    </div>                    
                    <div class="col-md-7">
                    <?= Html::a('Already registered? Login', ['/site/login'], ['class' => 'btn btn-block btn-primary']) ?>                                            
                    </div>
                    <div class="col-md-2">
                    </div>
                </div>       

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode("Let's Quester - Platform for Inquiry Learners") ?></h1>
    <hr>
    <h3><?= Html::encode($this->title) ?></h3>

    <p>Please fill out the following fields to login:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <div style="color:#999;margin:1em 0">
                    If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
                </div>

                <div class=row>
                    <div class="col-md-3">
                    <div class="form-group">
                        <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>                     
                    </div>
                    </div>
                    <div class="col-md-5">                        
                         <?= Html::a('New user Sign up', ['/site/signup'], ['class' => 'btn btn-block btn-success']) ?>                                            
                    </div>
                    <div class="col-md-5">
                    </div>
                </div>                

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

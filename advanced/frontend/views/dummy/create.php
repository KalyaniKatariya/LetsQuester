<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Dummy */

$this->title = 'Create Dummy';
$this->params['breadcrumbs'][] = ['label' => 'Dummies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dummy-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

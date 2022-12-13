<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LanguageSetting */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="language-setting-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'short')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'tag')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'image')->fileInput() ?>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

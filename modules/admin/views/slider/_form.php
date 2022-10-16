<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SliderList */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="slider-list-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Добавить слайд',['/admin/slider-item/create', 'id' => $model->id], ['class' => 'btn btn-info'])?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SliderItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="slider-item-form">
  <div class="row">
    <div class="col-md-6">
      <?php $form = ActiveForm::begin(); ?>
      <div class="row">
        <?= $form->field($model, 'slider_id')->hiddenInput(['value' => $slider])->label(false) ?>
        <div class="col-md-6">
          <div class="example-1">
            <div class="form-gr">
              <label class="label">
                <i class="material-icons">attach_file</i>
                <span class="title">Добавить файл</span>
                <?= $form->field($model, 'image')->fileInput()->label(false) ?>
              </label>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-12">
          <?= $form->field($model, 'bottom')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-12">
          <?= $form->field($model, 'end_str')->textInput(['maxlength' => true]) ?>
        </div>
        
        <div class="col-md-12">
          <?= $form->field($model, 'sort')->textInput() ?>
        </div>
        <? if(!empty($tag)):?>
        <div class="col-md-12">
          <?= $form->field($model, 'tag')->hiddenInput(['value' => $tag])->label(false) ?>
        </div>
        <? endif?>
        <div class="col-md-12">
          <?= $form->field($model, 'active')->checkbox(['uncheck' => '0', 'value' => '1', 'label' => 'Активность']); ?>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
          </div>
        </div>
      </div>
      <?php ActiveForm::end(); ?>
    </div>
    <div class="col-md-6">
      <div class="wid-im img-slider-prev">
          <? if(!empty($model->img)):?>
            <img src="/slider/<?= $model->img?>" alt="">
          <? endif;?>
      </div>
    </div>
  </div>
</div>
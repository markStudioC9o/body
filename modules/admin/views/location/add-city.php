<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="row">
  <div class="col-md-7">
    <div class="authors-form">

      <?php $form = ActiveForm::begin(); ?>
      <div class="row">
        <div class="col-md-12">
        <?= $form->field($model, 'counries_id')->hiddenInput(['value'=>$id,'maxlength' => true])->label(false) ?>
          <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('Наименование по языку') ?>
        </div>
        <div class="col-md-12">
          <?= $form->field($model, 'postscript')->textInput(['maxlength' => true])->label('Приписка по языку') ?>
        </div>
        <div class="col-md-12">
        </div>
        <div class="col-md-12">
          <label for="">Переводы для других языков</label>
        </div>
        <? foreach ($lang as $item) : ?>
          <div class="col-md-12 mt-1">
            <label><?= $item->name ?></label>
            <?= Html::textInput('lang[' . $item->tag . '][name]', '', ['class' => 'lan-dispaly form-control']); ?>
          </div>
          <div class="col-md-12 mt-1">
            <label>Приписка</label>
            <?= Html::textInput('lang[' . $item->tag . '][postscript]', '', ['class' => 'lan-dispaly form-control']); ?>
          </div>
        <? endforeach; ?>
        <div class="col-md-12 mt-1">
          <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
          </div>
        </div>
      </div>
      <?php ActiveForm::end(); ?>
    </div>
  </div>
</div>
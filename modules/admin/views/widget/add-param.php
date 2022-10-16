<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm; 
      

?>
<div class="row">
  <div class="col-md-9">
    <div class="widget-form">
      <?php $form = ActiveForm::begin(); ?>
      <?= $form->field($model, 'parent_id')->hiddenInput(['value' => $id])->label(false) ?>
      <?= $form->field($model, 'link')->textInput() ?>
      <?= $form->field($model, 'image')->fileInput() ?>
      <div class="col-md-12 mt-5">
        <div class="form-group">
          <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>
      </div>
      <?php ActiveForm::end(); ?>
    </div>
  </div>
</div>

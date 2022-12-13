<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="row">
  <div class="col-md-7">
    <div class="authors-form">
      <?php $form = ActiveForm::begin(); ?>
      <div class="col-md-6 mt-3 mb-3">
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
      <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
      <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>
      <? if (!empty($lang)) : ?>
        <div class="form-group field-authors-name has-success">
          <label class="control-label" for="authors-name">Языковые настройки</label>
        </div>
        <? foreach ($lang as $item) : ?>
          <? $value = ""; ?>
          <? if (isset($langer) && !empty($langer)) : ?>
            <? foreach ($langer as $elem) : ?>
              <? if ($elem['tag'] == $item['tag']) : ?>
                <? if (!empty($elem["param"])) {
                  $value = json_decode($elem["param"], true);
                } ?>
              <? endif; ?>
            <? endforeach; ?>
          <? endif; ?>

          <div class="form-group field-authors-name has-success">
            <label class="control-label" for="authors-name"><?= $item["name"] ?> - Имя</label>
            <input type="text" id="name" class="form-control" name="Lang[<?= $item["tag"] ?>][name]" maxlength="255" aria-invalid="false" value="<?= (isset($value['name']) && !empty($value['name']) ? $value['name'] : '') ?>">
            <div class="help-block"></div>
          </div>


        <? endforeach; ?>
      <? endif; ?>
      <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
      </div>
      <?php ActiveForm::end(); ?>
    </div>
  </div>
  <div class="col-md-3">
    <div class="wid-im">
      <? if (!empty($model->photo)) : ?>
        <img src="/authors/<?= $model->photo ?>" alt="" style="width:100%">
      <? else : ?>
        <img src="/img/default-img.jpg" alt="" style="width:100%">
      <? endif; ?>
    </div>
  </div>
</div>


<? $this->registerJs('
$("#authors-image").change(function (e) {
  if (window.FormData === undefined) {
    alert("В вашем браузере FormData не поддерживается");
  } else {
    var f = document.getElementById("authors-image");
    var rd = new FileReader(); 
    var files = f.files[0]; 
    rd.readAsDataURL(files); 
    rd.onloadend = function (e) {
      var imges = \'<img src="\'+this.result+\'">\';
      $(".wid-im").html(imges);
    };
  }
});
') ?>
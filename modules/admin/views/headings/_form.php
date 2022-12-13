<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\imperavi\Widget;
?>
<div class="form">
  <?php $form = ActiveForm::begin(); ?>
  <?= $form->field($model, 'title')->textInput() ?>
  <?= $form->field($model, 'link')->textInput() ?>
  <?
  if (empty($list)) {
    $array = array(
      '0' => 'Без родительской'
    );
  } else {
    $array = ArrayHelper::map($list, 'id', 'title');
    $array[0] = 'Без родительской';
    asort($array);
  };
  ?>
  <?//= $form->field($model, 'parent_id')->dropDownList($array, ['class' => 'form-control',]) ?>

  <?= $form->field($model, 'descript') ?>
  <?= $form->field($model, 'key_meta') ?>
  <?
  $items = array(
    '1' => '1 колонкa',
    '2' => '2 колонки',
    '3' => '4 колонки'
  );
  ?>
  <?= $form->field($model, 'col')->dropDownList($items)?>
  <label for="">Описание рубрики</label>
  <?
  echo $form->field($model, 'text')->widget(Widget::className(), [
    'value' => $model->text,
    'settings' => [
      'lang' => 'ru',
      'minHeight' => 200,
    ],
  ])->label(false);
  ?>

  <div class="form-group">
    <?= Html::submitButton('Соханить', ['class' => 'btn btn-primary']) ?>
  </div>
  <?php ActiveForm::end(); ?>
</div>
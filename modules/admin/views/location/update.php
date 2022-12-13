<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="row">
  <div class="col-md-12">
    <?= Html::a('Сортировка', ['/admin/location/sort-soc', 'id' => $id])?>
  </div>
  <div class="col-md-7">
    <div class="authors-form">

      <?php $form = ActiveForm::begin(); ?>
      <div class="row">
        <div class="col-md-12">
        <?= $form->field($city, 'name')->textInput(['class' => 'form-control'])->label('Наименование')?>
        </div>
        <div class="col-md-12">
        <?= $form->field($city, 'postscript')->textInput(['class' => 'form-control'])->label('Подпись');?>
        </div>
        <div class="col-md-12">
        </div>
        <div class="col-md-12">
        </div>
        <? foreach ($social as $el => $item) : ?>
          <div class="col-md-12 mt-1">
            <label><?= $item ?></label>
            <?
            $vas = null;
            if (isset($socialData[$item])) {
              $vas = $socialData[$item];
            } ?>
            <?= Html::textInput('social[' . $item . ']', $vas, ['class' => 'lan-dispaly form-control']); ?>
          </div>
        <? endforeach; ?>
        <div class="col-md-12 mt-1">
          <?= $form->field($model, 'adress')->textarea(['class' => 'form-control']) ?>
        </div>
        <? if (!empty($cityLang)) : ?>
          <? foreach ($cityLang as $elem) : ?>
            <label><?= $elem->tag ?></label>
            <?= Html::textInput('lang[' . $elem->id . '][name]', $elem->name, ['class' => 'lan-dispaly form-control']); ?>
            <label for="">Подпись</label>
            <?= Html::textInput('lang[' . $elem->id . '][postscript]', $elem->postscript, ['class' => 'lan-dispaly form-control']); ?>
          <? endforeach; ?>
          <? if(!empty($langerNew)):?>

            <? foreach ($langerNew as $elemset) : ?>
            <label><?= $elemset->tag ?></label>
            <?= Html::textInput('langnew[' . $elemset->tag . '][name]', '', ['class' => 'lan-dispaly form-control']); ?>
            <label for="">Подпись</label>
            <?= Html::textInput('langnew[' . $elemset->tag . '][postscript]', '', ['class' => 'lan-dispaly form-control']); ?>

          <? endforeach; ?>
            <?endif;?>
        <? else : ?>
          <? foreach($langer as $elem):?>
            <label><?= $elem->tag ?></label>
            <?= Html::textInput('langer[' . $elem->tag . '][name]', '', ['class' => 'lan-dispaly form-control']); ?>
            <label>Подпись</label>
            <?= Html::textInput('langer[' . $elem->tag . '][postscript]', '', ['class' => 'lan-dispaly form-control']); ?>
          <? endforeach;?>
        <? endif; ?>
        <div class="col-md-12 mt-1">
          <?= $form->field($model, 'global')->checkbox(['value' => '1']) ?>
        </div>
        <div class="col-md-12 mt-1">
          <?= $form->field($model, 'main')->checkbox(['value' => '1']) ?>
        </div>
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
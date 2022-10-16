<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\imperavi\Widget;

/* @var $this yii\web\View */
/* @var $model app\models\Widget */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
  <div class="col-md-9">
    <div class="widget-form">

      <?php $form = ActiveForm::begin(); ?>
      <div class="row">
        <div class="col-md-12">
          <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
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
        <div class="col-md-12">
          <?= $form->field($model, 'content')->widget(Widget::className(), [
            //'selector' => 'widget-stad',
            'value' => $model->content,
            'settings' => [

              'lang' => 'ru',
              'minHeight' => 200,
            ],
          ]);
          ?>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <? if (!empty($lang)) : ?>
            <label for="">Языковый параметры</label>
            <div id="accordion">
              <? foreach ($lang as $item) : ?>
                <?
                $title = '';
                $content = '';
                if (isset($widgetLangContent) && !empty($widgetLangContent)) {
                  foreach ($widgetLangContent as $elem) {
                    if ($elem['tag'] == $item->tag) {
                      $param = json_decode($elem['param'], true);
                      $title = $param['title'];
                      $content = $param['content'];
                    }
                  }
                }
                ?>

                <h3 class="alert alert-light"><?= $item->name ?></h3>
                <div>
                  <div class="form-group field-widget-title">
                    <label class="control-label" for="widget-title">Заголовок</label>
                    <?= Html::input('text', 'Lang[' . $item->tag . '][title]', $title, ['class' => 'form-control']) ?>
                  </div>
                  <div class="form-group field-widget-title">
                    <label class="control-label" for="widget-title">Основной текст</label>
                    <?
                    echo \vova07\imperavi\Widget::widget([
                      'name' => 'Lang[' . $item->tag . '][content]',
                      'value' => $content,
                      'settings' => [
                        'lang' => 'ru',
                        'minHeight' => 200,
                      ],
                    ]);
                    ?>
                  </div>
                </div>
              <? endforeach; ?>
            </div>
          <? endif; ?>
        </div>
      </div>
      <div class="col-md-12 mt-5">

        <div class="form-group">
          <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>
      </div>
      <?php ActiveForm::end(); ?>
    </div>
  </div>
  <div class="col-md-3">
    <div class="block-view-widget">
      <div class="default-widget">
        <? if (!empty($model->title)) : ?>
          <div class="widget-header">
            <?= $model->title ?>
          </div>
        <? endif; ?>
        <div class="widget-body">
          <div class="img-widget">
            <div class="wid-im">
              <img src=<?= (!empty($model->img) ? "/widget/" . $model->img : "/img/default-img.jpg") ?> alt="">
            </div>
          </div>
        </div>
        <? if (!empty($model->content)) : ?>
          <div class="widget-footer">
            <?= $model->content ?>
          </div>
        <? endif; ?>
      </div>
    </div>
  </div>
</div>
<?
use kartik\color\ColorInput;
use kartik\editors\Summernote;
use yii\bootstrap4\Html;
?>
<div class="row">
      <div class="col-md-12 mb-4">
      <?echo ColorInput::widget([
              'name' => 'colorMenu',
              'id'=>'colorMenu',
              'value' => (!empty($model['color']) ? $model['color'] : '#759523'),
              'options' => ['readonly' => true]
          ]);
          ?>
      </div>
      <div class="col-md-8">
        <input type="text" class="form-control title-qut" placeholder="Заголовок">
      </div>
      <div class="col-md-4">
        <?//= Html::submitButton('Картинка', ['class' => 'btn btn-success img-quote'])?>
      
        <?= Html::submitButton('Иконка', ['class' => 'btn btn-success icon-quote'])?>
      </div>
      <div class="col-md-4 mt-1">
        <input type="text" readonly id="link-img" class="form-control">
      </div>
      <div class="col-md-4 mt-1">
        <input type="text" readonly id="link-icon" class="form-control">
      </div>
      <div class="col-md-6"></div>
      <div class="col-md-6">
      <sub>Изображение должно быть пропорциональным</sub>
      </div>
      <div class="col-md-12 mt-4">
        <?
        echo Summernote::widget([
          'name' => 'comments',
          'id' => 'quote-bodsy',
          'value' => '',
          // other widget settings
        ]);
        ?>
      </div>
      <div class="col-md-12 mt-4">
        <?= Html::submitButton('Получить', ['class' => 'btn btn-success asd-fert']) ?>
      </div>
    </div>
<?

use kartik\color\ColorInput;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

?>

  <? $form = ActiveForm::begin()?>
  <div class="row">
    <div class="col-md-12 mt-3">
       <label for="">Главный цвет</label>
       <? echo ColorInput::widget([
              'name' => 'mainColor',
              'id'=>'mainColor',
              'value' => (!empty($model['color']) ? $model['color'] : '#00a6ca'),
              'options' => ['readonly' => false]
          ]);
          ?>
    </div>
    <div class="col-md-12 mt-3">
       <label for="">Дополнительный цвет</label>
       <? echo ColorInput::widget([
              'name' => 'acsentColor',
              'id'=>'acsentColor',
              'value' => (!empty($model['color']) ? $model['color'] : '#dbf9ff'),
              'options' => ['readonly' => false]
          ]);
          ?>
    </div>
    <div class="col-md-12 mt-3">
      <?= Html::submitButton('Сохранить',['class' => 'btn btn-success'])?>
    </div>
  </div>
  <? ActiveForm::end();?>
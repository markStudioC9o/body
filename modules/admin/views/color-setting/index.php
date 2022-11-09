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
              'name' => 'SiteMainColor',
              'id'=>'SiteMainColor',
              'value' => (!empty($SiteMainColor['value']) ? $SiteMainColor['value'] : '#00a6ca'),
              'options' => ['readonly' => false]
          ]);
          ?>
    </div>
    <div class="col-md-12 mt-3">
       <label for="">Дополнительный цвет</label>
       <? echo ColorInput::widget([
              'name' => 'SiteAcsentColor',
              'id'=>'SiteAcsentColor',
              'value' => (!empty($SiteAcsentColor['value']) ? $SiteAcsentColor['value'] : '#dbf9ff'),
              'options' => ['readonly' => false]
          ]);
          ?>
    </div>

    <div class="col-md-12 mt-3">
       <label for="">Вторичный цвет</label>
       <? echo ColorInput::widget([
              'name' => 'SiteDopColor',
              'id'=>'SiteDopColor',
              'value' => (!empty($SiteDopColor['value']) ? $SiteDopColor['value'] : '#007d96'),
              'options' => ['readonly' => false]
          ]);
          ?>
    </div>
    
    <div class="col-md-12 mt-3">
      <?= Html::submitButton('Сохранить',['class' => 'btn btn-success'])?>
    </div>
  </div>
  <? ActiveForm::end();?>
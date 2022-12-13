<?

use app\widgets\OurVideo;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?
$form = ActiveForm::begin();
?>
<div class="row">
  <div class="col-md-12 mb-3 mt-3">
  <?= OurVideo::widget();?>
  </div>
  <div class="col-md-6">
    <label for="">https://youtu.be/</label>
    <input type="text" name="key_id" value="" id="key_id" class="form-control" placeholder="hpq0pE9YmzI">
      <p><small>Укажите ID видео</small></p>
  </div>
  <div class="col-md-6">
    <label for="">Отображение</label>
    <select id="type_pr" class="form-control">
      <option value="def" selected>На странице</option>
      <option value="mod">В сплывающем окне</option>
    </select>
    <p><small>Выберите метод отображения</small></p>
  </div>
  <div class="col-md-12 mt-3">
    <?= Html::submitButton('Добавить', ['class' => 'btn btn-info', 'id' => 'saveVideo']) ?>
  </div>
</div>
<?
ActiveForm::end();
?>
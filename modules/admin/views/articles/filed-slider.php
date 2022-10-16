<?

use yii\helpers\Html;

?>
<div class="form-group">
  <input type="text" name="name-<?= $res.$name ?>" data-name="<?= $res.$name ?>" class="form-control">
</div>
<div class="form-group">
  <label for="">
    Описание
  </label>
  <input type="text" name="desc-<?= $res.$name ?>" data-name="<?= $res.$name ?>" class="form-control">
</div>
<div class="form-group">
  <?= Html::submitButton('Выбрать изображение', ['class' => 'btn btn-info select-image-slider', 'data-name' => $res.$name]) ?>
</div>
<?

use yii\helpers\Html;
?>
<input type="hidden" value="<?= $id ?>" class="id-block-text-col">
<?= $this->render('../articles/param-padding', ['type' => 'text', 'id' => $id, 'output' => $output]) ?>
<div class="col-md-12 mt-2">
  <?= Html::submitButton((isset($data['glow']) && $data['glow'] == '1' ? 'Отключить авто размер колонки' : 'Включить авто размер колонки'), ['class' => (isset($data['glow']) && $data['glow'] == '1' ? 'texflowColum' : 'texflowAddColum') . ' posert btn btn-success', 'data-id' => $id]) ?>
</div>
<div class="col-md-12 mt-3 mb-3">
  <select name="paramauto" id="<?= $id ?>" class="form-control">
    <option value="default">Default</option>
    <option value="cross">Крест</option>
    <option value="cechek">Чекбокс</option>
    <option value="dots">Точка</option>
  </select>
</div>
<div class="col-md-12">
  <!-- <label for="">Ширина колонки</label> -->
  <input type="hidden" value="<?= round((int)$sizeVal) ?>" class="form-control widthColum">
</div>
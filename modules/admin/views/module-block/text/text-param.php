<?

use yii\helpers\Html;

?>
<div class="row">
  <div class="col-md-12">
  <button type="submit" class="texflowColum posert btn btn-success" data-id="<?= $data['id'] ?>">Отключить авто размер колонки</button>
  </div>
</div>
<div class="param-text">
  <input type="hidden" value="<?= $data['id'] ?>">

  <?
  $output = '';
  if (isset($data['output']) && !empty($data['output'])) {
    $output = $data['output'];
  } ?>
  <?= $this->render('/articles/param-padding', ['type' => 'col-text-padding', 'id' => $data['id'], 'output' => $output]) ?>
</div>

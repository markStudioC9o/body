<?

use yii\helpers\Html;

?>
<div class="param-text">
  <input type="hidden" value="<?= $data['id'] ?>">
  <?
  $output = '';
  if (isset($data['output']) && !empty($data['output'])) {
    $output = $data['output'];
  } ?>
  <?= $this->render('/articles/param-padding', ['type' => 'col-text-padding', 'id' => $data['id'], 'output' => $output]) ?>
</div>

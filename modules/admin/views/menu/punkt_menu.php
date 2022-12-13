<?

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<? $form = ActiveForm::begin() ?>
<input type="text" class="form-control seft">
<div class="block-strop">
  <ul class="funk-menu">
    <? foreach ($pages as $item) : ?>
      <li>
        <label for="param_<?= $item['id'] ?>">
          <input type="checkbox" id="param_<?= $item['id'] ?>" value="<?= $item['id'] ?>" name="param[<?= $item['id'] ?>][id]"><span data-id="<?= $item['id'] ?>" class="obedt"><?= $item['title'] ?></span>
          <input type="hidden" name="param[<?= $item['id'] ?>][type]" value="item">
        </label>
        <sub>Страницы</sub>
      </li>
    <? endforeach; ?>
    <? foreach ($articles as $item) : ?>
      <li>
        <label for="param_<?= $item['id'] ?>">
          <input type="checkbox" id="param_<?= $item['id'] ?>" value="<?= $item['id'] ?>" name="param[<?= $item['id'] ?>][id]"><span data-id="<?= $item['id'] ?>" class="obedt"><?= $item['text'] ?></span>
          <input type="hidden" name="param[<?= $item['id'] ?>][type]" value="artic">
        </label>
        <sub>Статьи</sub>
      </li>
    <? endforeach; ?>
    <? if (isset($heading) && !empty($heading)) : ?>
      <? foreach ($heading as $item) : ?>
      <li>
        <label for="param_<?= $item['id'] ?>">
          <input type="checkbox" id="param_<?= $item['id'] ?>" value="<?= $item['id'] ?>" name="param[<?= $item['id'] ?>][id]"><span data-id="<?= $item['id'] ?>" class="obedt"><?= $item['title'] ?></span>
          <input type="hidden" name="param[<?= $item['id'] ?>][type]" value="heading">
        </label>
        <sub>Рубрики</sub>
      </li>
    <? endforeach; ?>
    <? endif; ?>
  </ul>
</div>
<?= Html::submitButton('Применить', ['class' => 'btn btn-info']) ?>
<? ActiveForm::end() ?>
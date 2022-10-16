<?

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="row">

  <div class="col-md-12">
    <?= Html::a('Вернуться к статье', ['/admin/articles/articles-version', 'id' => $id, 'tag' => $tag, 'size' => '1680'], ['class' => 'btn btn-info']) ?>
  </div>
  <div class="col-md-6 mt-3">
    <? $form = ActiveForm::begin(); ?>
    <div class="example-1">
      <div class="form-gr">
        <label class="label">
          <i class="material-icons">attach_file</i>
          <span class="title">Изображение снипета</span>
          <?= $form->field($model, 'img')->fileInput()->label(false) ?>
        </label>
      </div>
    </div>

    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    <? ActiveForm::end(); ?>
  </div>
  <div class="col-md-6 mt-3">
    <label for="">Изображение снипета</label>
    <? if (!empty($shipet)) : ?>
      <img src="<?= (isset($shipet->value) && !empty($shipet->value) ? '/shipet/' . $shipet->value : '/icon/snippet-vk.jpg') ?>" alt="">
    <? else : ?>
      <img src="/icon/snippet-vk.jpg" alt="">
    <? endif; ?>
  </div>
</div>
<?

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<ul class="nav nav-pills">
  <? if (isset($lang) && !empty($lang)) : ?>
    <? foreach ($lang as $item) : ?>
      <li class="nav-item">
        <a class="nav-link <?= (isset($tag) && $tag == $item['tag']) ? 'active' : '' ?>" href="?tag=<?= $item['tag'] ?>"><?= $item['tag'] ?></a>
      </li>
    <? endforeach; ?>
  <? endif; ?>
</ul>
<? if(!empty($tag)):?>
<div class="row">
  <? $form = ActiveForm::begin([
    'id' => 'footer_if',
    'options' => [
      'id' => 'footer_link'
    ]
  ]) ?>
  <div class="row">
    <div class="col-md-12">
      <div class="row">
        <?= $this->render('form-link', [
          'link' => $link
        ]) ?>
        <div class="col-md-12">
          <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>
      </div>
    </div>
  </div>
  <? ActiveForm::end(); ?>
</div>
<? endif;?>
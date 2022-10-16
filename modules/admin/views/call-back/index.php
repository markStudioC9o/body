<?

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<? if (isset($lang) && !empty($lang)) : ?>
  <ul class="nav nav-pills">
    <? foreach ($lang as $item) : ?>
      <li class="nav-item"><a class="nav-link <?= ($tag == $item->tag) ? 'active' : '' ?>" href="/admin/call-back?tag=<?= $item->tag ?>"><?= $item->tag; ?></a></li>
    <? endforeach; ?>
  </ul>
<? endif; ?>
<? $form = ActiveForm::begin(); ?>
<div class="row">
  <div class="col-md-3">
    <ul id="listCon">
      <? if (isset($array) && !empty($array)) : ?>
        <? foreach ($array as $el => $it) : ?>
          <li>
            <div class="icon">
              <img src="<?= $it['img'] ?>" alt="">
              <input type="hidden" name="con[<?= $el ?>][img]" value="<?= $it['img'] ?>">
            </div>
            <div class="link_trof">
              <input type="text" name="con[<?= $el ?>][link]" value="<?= $it['link'] ?>">
            </div>
          </li>
        <? endforeach ?>
      <? endif; ?>
    </ul>
  </div>
  <div class="col-md-6">
    <div class="row">
      <div class="col-md-12 mb-2">
        <label>Первый заголовок</label>
        <?= Html::textInput('param[firTit]', $firTit, ['class' => 'form-control']) ?>
      </div>
      <div class="col-md-12 mb-2">
        <label>Второй заголовок</label>

        <?= Html::textInput('param[stepTit]', $stepTit, ['class' => 'form-control']) ?>
      </div>
      <div class="col-md-12 mb-2">
        <label>Потверждение</label>
        <?= Html::textInput('param[parls]', $parls, ['class' => 'form-control']) ?>
      </div>
      <div class="col-md-12 mb-2">
        <label>Текст перед ссылками</label>
        <?= Html::textInput('param[text]', $text['value'], ['class' => 'form-control', 'placeholder' => 'Текст']) ?>
      </div>
      <div class="col-md-12 mb-2">
        <label>Текст кнопки</label>
        <?= Html::textInput('param[button]', $button['value'], ['class' => 'form-control', 'placeholder' => 'Текст']) ?>
      </div>
      <div class="col-md-12 mb-2">
        <label>Наименование виджета</label>
        <?= Html::textInput('param[name]', $name->value, ['class' => 'form-control', 'placeholder' => 'Текст']) ?>
      </div>
    </div>
    <!-- 'link2'
      'link1' -->
  </div>
  <div class="col-md-12">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
  </div>
</div>
<? ActiveForm::end(); ?>
<?

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
?>
<?= $this->render('aside') ?>
<? if (isset($lang) && !empty($lang)) : ?>
  <ul class="nav nav-pills">
    <? foreach ($lang as $item) : ?>
      <li class="nav-item"><a class="nav-link <?= ($tag == $item->tag) ? 'active' : '' ?>" href="?tag=<?= $item->tag ?>"><?= $item->tag; ?></a></li>
    <? endforeach; ?>
  </ul>
<? endif; ?>
<? $form = ActiveForm::begin() ?>
<div class="row">
  <? foreach ($tells as $el => $em) : ?>
    <div class="col-md-12 mt-4">
      <label> Блок: <?= $el ?></label>
    </div>
    <? foreach ($em as $item => $val) : ?>
      <?
      if ($item == 'name') {
        $plase = 'Заголовок';
      } else {
        $plase = 'Текст';
      }
      ?>
      <div class="col-md-12 mt-1">
        <?= Html::textInput('tells[' . $el . '][' . $item . ']', $val, ['class' => 'form-control', 'placeholder' => $plase]) ?>
      </div>
    <? endforeach; ?>
  <? endforeach; ?>

  <div class="col-md-12 mt-1">
    <label> Авторский дисклаймер</label>
    <?= Html::textInput('atrouk', $athors, ['class' => 'form-control']) ?>
  </div>

  <div class="col-md-12 mt-1">
    <label>Заголовок подвала 1</label>
    <?= Html::textInput('footertitle[1]', $Ftitle[1], ['class' => 'form-control']) ?>
  </div>

  <div class="col-md-12 mt-1">
    <label>Заголовок подвала 2</label>
    <?= Html::textInput('footertitle[2]', $Ftitle[2], ['class' => 'form-control']) ?>
  </div>

  <div class="col-md-12 mt-1">
    <label>Модальное окно выбора города</label>
    <?= Html::textInput('modalTitle', $modalTitle, ['class' => 'form-control']) ?>
  </div>

  <div class="col-md-12 mt-1">
    <input type="checkbox" value="1" <?= (isset($modelActiveBannersTitle->value) && $modelActiveBannersTitle->value == '1' ? 'checked' : '')?>  name="activeBannersTitle">
    <label>Информационный баннер</label>
    <?= Html::textInput('bannersTitle', $bannersTitle, ['class' => 'form-control']) ?>
  </div>

  <div class="col-md-12 mt-1">
    <label>Написание главной в хлебных крошках</label>
    <?= Html::textInput('breadcrambs', $crambsTitle, ['class' => 'form-control']) ?>
  </div>

  <div class="col-md-12 mt-1">
    <label>Поиск</label>
    <?= Html::textInput('search', $search, ['class' => 'form-control']) ?>
  </div>

  

  <div class="col-md-12 mt-4">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
  </div>
</div>

<? ActiveForm::end() ?>
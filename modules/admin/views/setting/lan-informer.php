<?

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

 ?>
<ul class="nav nav-pills">
  <? if (isset($lang) && !empty($lang)) : ?>
    <? foreach ($lang as $item) : ?>
      <li class="nav-item">
        <a class="nav-link <?= ($tag == $item->tag) ? 'active' : '' ?>" href="?tag=<?= $item->tag ?>"><?= $item->tag ?></a>
      </li>
    <? endforeach; ?>
  <? endif; ?>
</ul>
<? if(isset($tag) && !empty($tag)):?>
<? $form = ActiveForm::begin([
  'id' => 'inform'
]) ?>
<label for="">Заголовок</label>
<?= Html::textInput('inform[title]', $arrayValue['title'], ['class' => 'form-control', 'plaсeholder' => 'Заголовок']) ?>
<br>
<label for="">Текст</label>
<?= Html::textarea('inform[text]', $arrayValue['text'], ['class' => 'form-control', 'plaсeholder' => 'Текст']) ?>
<br>
<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
<? ActiveForm::end(); ?>
<? endif;?>
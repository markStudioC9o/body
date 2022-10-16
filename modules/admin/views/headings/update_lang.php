<div id="tabrel" style="border:none;padding:0">
<ul>
  <? foreach ($lang as $elem) : ?>
    <li><a href="#tabs-<?= $elem->id ?>"><?= $elem->name ?></a></li>
  <? endforeach; ?>
  <li><a href="#tabs-param">Параметры</a></li>
</ul>
<?= $this->render('_form_lang', [
  'lang' => $lang,
  'model' => $model,
  'modelLang' => $modelLang,
  'list' => $list
]) ?>
</div>
<?
$this->registerJs("
$('#tabrel').tabs({
  active: 0
});
")
?>


<?

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
?>
<? if(isset($lang) && !empty($lang)):?>
    <ul class="nav nav-pills">
      <? foreach($lang as $item):?>
        <li class="nav-item"><a  class="nav-link <?= ($tag == $item->tag) ? 'active' : ''?>" href="/admin/call-back/widget-one?tag=<?= $item->tag?>&id=<?= $id?>"><?= $item->tag;?></a></li>
      <? endforeach;?>
    </ul>
    <? endif;?>
<?
$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']
]); ?>
<div class="row">
  <? if (!empty($widget)) : ?>
    <div class="col-md-5">
      <?= $form->field($widget, 'name')->textInput() ?>
    </div>
    <div class="col-md-5">
      <?= $form->field($widget, 'active')->dropdownList(['0' => 'Не активен', '1' => 'Активен']) ?>
    </div>
  <? endif; ?>
  <div class="col-md-12">
    <label for="">
      Картинка виджета
    <input type="file" name="callbackimg">
    </label>
  </div>
  <? if (!empty($field)) : ?>
    <div class="col-md-10">
      <div class="row">
        <? foreach ($field as $item) : ?>
          <? $idS = $item->id; ?>
          <? $cheh = false; ?>
          <? if ($item->reqared == '1') {
            $cheh = true;
          } ?>
          <? $active = false; ?>
          <? if ($item->active == '1') {
            $active = true;
          } ?>
          <div class="col-mb-12 mb-1 mt-1">
            <hr>
          </div>
          <div class="col-md-12 mt-1">
            <label>Наименование поля</label>
          </div>
          <div class="col-md-6 mb-3">
            <?= Html::textInput('callBackField[' . $idS . '][name]', $item->name, ['class' => 'form-control']) ?>
            <?= Html::hiddenInput('callBackField[' . $idS . '][value]', $item->value, ['class' => 'form-control']) ?>
          </div>
          <div class="col-md-2 mb-3">
            <label>
              <?= Html::checkbox('callBackField[' . $idS . '][active]', [
                'checked' => '1',
                'uncheck' => '0'
              ], [
                'data-pos' => 'callBackField[' . $idS . ']',
                'data-id' => $idS,
                'checked' => $active,
                'class' => 'actv_field'
              ]) ?>
              Активен
            </label>
          </div>
          <div class="col-md-2 mb-3">
            <label>
              <?= Html::checkbox('callBackField[' . $idS . '][reqared]', [
                'checked' => '1',
                'uncheck' => '0'
              ], [
                'data-pos' => 'callBackField[' . $idS . ']',
                'checked' => $cheh
              ]) ?>
              обязательное поле
            </label>
          </div>

        <? endforeach; ?>
      </div>
    </div>
  <? endif; ?>
  <div class="col-md-5 mt-5">
    <div class="col-md-12 mb-2">
      <label>Ссылка 1</label>
      <input type="text" class="form-control" name="param[link1][name]" value="<?= (isset($leg['link1']['name'])? $leg['link1']['name'] : '' )?>" placeholder="Текст">
      <br>
      <input type="text" class="form-control" name="param[link1][url]" value="<?= (isset($leg['link1']['url'])? $leg['link1']['url'] : '' )?>" placeholder="Сылка">
    </div>
    <div class="col-md-12 mb-2">
      <label>Ссылка 2</label>
      <input type="text" class="form-control" name="param[link2][name]" value="<?= (isset($leg['link2']['name'])? $leg['link2']['name'] : '' )?>" placeholder="Текст">
      <br>
      <input type="text" class="form-control" name="param[link2][url]" value="<?= (isset($leg['link2']['url'])? $leg['link2']['url'] : '' )?>" placeholder="Сылка">
    </div>
  </div>
  <div class="col-md-3 mt-5">
  <label>Раположение</label>
    <select name="pos_linker" id="posLink" class="pos form-control">
    </select>
  </div>
  <div class="col-md-12">
    <?= Html::submitButton('сохранить', ['class' => 'btn btn-success']) ?>
  </div>
</div>
<? ActiveForm::end(); ?>

<? if(!empty($posPos)){
$this->registerJs("
$(document).ready(function(e){
  $('#posLink option[value=\"".$posPos."\"]').attr('selected', 'true');
})
");
}?>
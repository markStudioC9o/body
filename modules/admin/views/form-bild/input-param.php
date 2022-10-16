<?
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<? $form = ActiveForm::begin([
  'id' => 'id-param'
])?>
<input type="hidden" id="id_ins" name="id_block" value="<?= $id?>" class="form-control">
<div class="form-group">
<label for="">Тип</label>
<select name="type_input" id="type_input" class="form-control">
  <option value="input">input</option>
  <option value="select">select</option>
  <option value="textarea">textarea</option>
  <option value="checkbox">checkbox</option>
  <option value="radio">radio</option>
  <option value="text">текст</option>
</select>
</div>

<div class="form-group obred" style="display:none">
<div class="list_param">

</div> 

  <span class="plus_param">Добавить параметр</span>
</div>

<div class="form-group offlow" style="display:none">
<div class="list_param-t">
  <textarea name="text-con" id="text-con" style="width:100%; height:111px"></textarea>
</div> 
</div>

<div class="form-group">
<label for="">Наименование</label>
<input type="text" name="name_input" id="name_input" class="form-control" required>
</div>

<div class="form-group">
<label for="">Под текст</label>
<input type="text" name="sub_input" id="sub_input" class="form-control" required>
</div>

<div class="form-group">
<label for="">Обязательное</label>
<?= Html::checkbox('reqerd', false)?>
</div>
<div class="form-group">
<?= Html::submitButton('Применить',['id' => 'saveParam', 'class' => 'btn btn-info'])?>
</div>
<? ActiveForm::end();?>
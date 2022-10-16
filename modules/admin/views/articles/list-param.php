<?
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div id="blockListParam"> 
<input type="hidden" value="<?= $id ?>" id="<?= $id ?>" class="id_ul_li">
<? $form = ActiveForm::begin([
  'id' => 'ulForm'
]) ?>
<? if (!empty($array)) : ?>
  <? foreach ($array as $key => $val) : ?>
    <div class="input_dev">
      <input type="text" class="inp-ul form-control" data-id="1" name="<?= $key ?>" value="<?= trim(Html::encode($val)); ?>"><span class="remove-ul-li fa fa-trash"></span><span class="dert fa fa-link" data-param="<?= $key ?>"></span>
    </div>
  <? endforeach; ?>
<? else : ?>
  <div class="input_dev">
    <input type="text" class="inp-ul form-control" data-id="1" name="param_1" value="lorem"><span class="remove-ul-li fa fa-trash"></span><span class="dert fa fa-link" data-param="param_1"></span>
  </div>
<? endif; ?>
<? ActiveForm::end(); ?>
<span class="asd-input-list"><i class="fa fa-plus"></i></span>

<select name="" id="icons_ul" class="form-control">
  <option value="">вид списка</option>
  <option value="chek">Чекбокс</option>
  <option value="dots">Точка</option>
  <option value="numb">Нумерованный</option>
  <option value="crest">Крест</option>
  <option value="default">default</option>
  <option value="custom">Собственная</option>
</select>

<input type="text" class="form-control" id="custom-icon" placeholder="Собственный пункт списка" style="display:none">

<label for="" style="margin-top: 10px; margin-bottom:0px">Левый отступ списка</label>
<input type="number" class="form-control padding-ul" value="15" min="0" max="50" step="1">
<label for="">Размер Шрифта</label>
<input type="number" class="form-control size-ul" value="<?= (isset($output['font-size']) && !empty($output['font-size']) ? round((int)$output['font-size']) : '')?>" min="0" max="50" step="1">
<a href="" class="opens_ul_li btn btn-info mt-3">Вставить</a>


<ul class="nav nav-pills" id="ul-col-align">
  <li class="lirt-left nav-item">
    <div class="nav-link" data-pos="left">
      <i class="fa fa-align-left" aria-hidden="true"></i>
    </div>
  </li>
  <li class="lirt-center nav-item">
    <div class="nav-link" data-pos="center">
      <i class="fa fa-align-center" aria-hidden="true"></i>
    </div>
  </li>
  <li class="lirt-right nav-item">
    <div class="nav-link" data-pos="right">
      <i class="fa fa-align-right" aria-hidden="true"></i>
    </div>
  </li>
  <li class="lirt-right nav-item">
    <div class="nav-link" data-pos="lite">
      lite
    </div>
  </li>
  <li class="lirt-right nav-item">
    <div class="nav-link" data-pos="strong">
      strong
    </div>
  </li>
</ul>
<a href="" class="delete-ul">Удалить список из колонки</a>
</div>
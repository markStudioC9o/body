<?
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\helpers\Html;

?>
<div class="form-group">
  <label class="control-label">Категории статей</label>

  <?= Html::DropDownList('type[Headings]', $id, ArrayHelper::map($model, 'id', 'title'), ['prompt' => 'Категории статей...', 'class' => 'form-control selecter23']) ?>
</div>
<?
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\helpers\Html;

?>
<div class="form-group">
  <label class="control-label">Статья</label>
  <?= Html::DropDownList('type[Articles]', $id, ArrayHelper::map($model, 'id', 'text'), ['prompt' => 'Статья...', 'class' => 'form-control selecter23']) ?>
</div>
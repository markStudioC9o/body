<?
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
?>
<? if(!empty($model)):?>
  <label for="">Главная рубрика</label>
<?= Html::dropDownList('select-headin', '', ArrayHelper::map($model, 'id', 'title'), ['class' => 'form-control select-main-heading'])?>

<? endif;?>
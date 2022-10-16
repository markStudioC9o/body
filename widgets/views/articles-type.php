<?

use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

?>
<div class="form-group">
  <?
  $name1 = null;
  $data1 = null;
  $name2 = null;
  $data2 = null;
  if (!empty($option)) {
    $arrayOption = ArrayHelper::map($option, 'option_param', 'value');
    if (isset($arrayOption['kb1_name']) && !empty($arrayOption['kb1_name'])) {
      $name1 = json_decode($arrayOption['kb1_name'], true);
    }
    if (isset($arrayOption['kb1_data']) && !empty($arrayOption['kb1_data'])) {
      $data1 = json_decode($arrayOption['kb1_data'], true);
    }
    if (isset($arrayOption['kb2_name']) && !empty($arrayOption['kb2_name'])) {
      $name2 = json_decode($arrayOption['kb2_name'], true);
    }
    if (isset($arrayOption['kb2_data']) && !empty($arrayOption['kb2_data'])) {
      $data2 = json_decode($arrayOption['kb2_data'], true);
    }
  } ?>
  <?= Html::textInput('ArticlesType[kb1_name]', $name1, ['class' => 'form-control']) ?>
</div>
<div class="form-group">
  <?
  echo Select2::widget([
    'name' => 'ArticlesType[kb1_data]',
    'data' => $array,
    'value' => $data1,
    'options' => [
      'placeholder' => 'Выберите 4 статьи',
      'multiple' => true,
      'class' => 'form-control selecter23 headingSelect'
    ],
  ]);
  ?>
</div>
<div class="form-group">
  <?= Html::textInput('ArticlesType[kb2_name]', $name2, ['class' => 'form-control']) ?>
</div>
<div class="form-group">
  <?
  echo Select2::widget([
    'name' => 'ArticlesType[kb2_data]',
    'data' => $array,
    'value' => $data2,
    'options' => [
      'placeholder' => 'Выберите 4 статьи',
      'multiple' => true,
      'class' => 'form-control selecter23 headingSelect'
    ],
  ]);
  ?>
</div>
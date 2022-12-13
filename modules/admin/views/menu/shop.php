<?

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<? $form = ActiveForm::begin(); ?>
<div class="row">
  <? if (!empty($lang)) : ?>
    <? foreach ($lang as $item) : ?>
      <div class="col-md-12 mt-2">
        <label><?= $item->tag ?></label>
        <? if(isset($listArra[$item->tag]) && !empty($listArra[$item->tag])){
          $value = $listArra[$item->tag];
        }else{
          $value = null;
        }?>
        <? if(isset($listLink[$item->tag]) && !empty($listLink[$item->tag])){
          $link = $listLink[$item->tag];
        }else{
          $link = null;
        }?>

        

        <?= Html::TextInput('form[' . $item->tag . '][name]', $value, ['class' => 'form-control']) ?>
        <br>
        <?= Html::TextInput('form[' . $item->tag . '][link]', $link, ['class' => 'form-control']) ?>
      </div>
    <? endforeach; ?>
  <? endif; ?>
  <!-- <div class="col-md-12 mt-2"> -->
    <!-- <label>Ссылка</label> -->
    <?//= Html::TextInput('link', $linkShop, ['class' => 'form-control']) ?>
  <!-- </div> -->
  <div class="col-md-12 mt-2">
    <?= Html::submitButton('Сохранить',['class' => 'btn btn-success'])?>
  </div>
</div>
<? ActiveForm::end(); ?>
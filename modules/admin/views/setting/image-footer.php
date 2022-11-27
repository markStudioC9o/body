<?

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

?>
<div class="row">
  <? $form = ActiveForm::begin()?>
  <div class="col-md-12">
    <?= Html::a('Выбрать картинку',['#'],['class' => 'btn btn-info new-image-footer mt-3 mb-3'])?>
    <input type="text" class="logo-image-form form-control" name="image-footer" value="<?= (isset($imageFooter->value) && !empty($imageFooter->value) ? $imageFooter->value : '')?>">
    
  </div>
  <div class="col-md-4">
    <div class="prev-image-logo">
      <? if(isset($imageFooter->value) && !empty($imageFooter->value)):?>
        <img src="<?= $imageFooter->value?>" alt="">
      <? endif;?>
    </div>
  </div>
  <div class="col-md-12 mt-5">
    <?= Html::submitButton('Сохранить',['class' => 'btn btn-success'])?>
    <?= Html::a('Удалить',['/admin/setting/delete-footer-image'],['class' => 'btn btn-warning'])?>
  </div>
  <? ActiveForm::end();?>
</div>
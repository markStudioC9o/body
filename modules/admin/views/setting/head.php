<?

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

?>


<? $form = ActiveForm::begin()?>
<div class="row">
  <div class="col-md-6">
    <label for="">Текстовое лого</label>
    <input type="text" class="form-control" name="text_logo" value="<?= (!empty($logo->value) ? $logo->value : '')?>">
  </div>
  <div class="col-md-6">
  
    <input type="hidden" class='logo-image-form' value="<?= (!empty($imageLogo->value) ? $imageLogo->value : '')?>" name="image_logo">
    <a href="#" id="logoImage" class="btn btn-success">Установить изображение</a>
    <a href="/admin/setting/delete-log" id="logoImageDelete" class="btn btn-info">Удалить</a>
    <div class="prev-image-logo">
      <? if(!empty($imageLogo->value)):?>
        <img src="<?= $imageLogo->value?>" alt="">
        <? endif;?>
    </div>
  </div>
  <div class="col-md-12 mb-5"></div>
  <div class="col-md-6">
    <label for="">Title default</label>
    <input type="text" class="form-control" name="title_default" value="<?= (!empty($titleDefault->value) ? $titleDefault->value : '')?>">
  </div>
  <div class="col-md-6">
    <label for="">Title custom</label>
    <input type="text" class="form-control" name="title_custom" value="<?= (!empty($titleCustom ->value) ? $titleCustom->value : '')?>">
  </div>
  <div class="col-md-12 mb-5"></div>
  <div class="col-md-6">
    <label for="">Список id для Telegram</label>
    <input type="text" class="form-control" name="id_telegram" value="<?= (!empty($idTelegram->value) ? $idTelegram->value : '')?>">
  </div>
  <div class="col-md-6">
    <label for="">Bot Telegram</label>
    <input type="text" class="form-control" name="bot_telegram" value="<?= (!empty($botTelegram->value) ? $botTelegram->value : '')?>">
  </div>
  <div class="col-md-12 mt-3">
    <?= Html::submitButton('Сохранить',['class' => 'btn btn-success'])?>
  </div>
  </div>
  <? ActiveForm::end();?>



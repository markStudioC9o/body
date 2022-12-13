<?

use yii\helpers\Html;

?>
<div class="poor-block">
  <div class="block-form-end btn-form_margin_tag">
    <div id="form-end-page">
      <?= Html::submitButton('Отправить', ['class' => 'send-form-page']) ?>
      <p>Нажимая на кнопку “отправить” Вы даете согласие на обработку ваших персональных данных и соглашаетесь с политикой конфиденциальности</p>
    </div>
  </div>
  <div class="step-block" style="opacity: 0;">
      <span class="up-bs">
        <i class="fa fa-arrow-up"></i>
      </span>
      <span class="down-bs">
        <i class="fa fa-arrow-down"></i>
      </span>
      <span class="del-bs">
        <i class="fa fa-trash"></i>
      </span>
    </div>
</div>
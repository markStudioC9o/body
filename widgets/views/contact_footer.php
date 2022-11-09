  <?

use app\widgets\ColorWidget;

?>
  <div class="tit_foot_con" style="background: <?= ColorWidget::widget(['type' => 'main'])?>">
    <? if (isset($titarray) && isset($titarray[1]) && !empty($titarray[1])) : ?>
      <?= $titarray[1] ?>
    <? else : ?>
      HEAD OFFICE:
    <? endif; ?>

  </div>
  <div class="block_foot_con">
    <div class="img_foot_con">
      <img src="/icon/image48.png" alt="">
    </div>
    <div class="text_foot_con">
      <? if (isset($data['adress']) && !empty($data['adress'])) : ?>
        <p>
          <?= $data['adress'] ?>
        </p>
      <? endif; ?>
    </div>
  </div>
  <div class="tit_foot_con aglas" style="background: <?= ColorWidget::widget(['type' => 'main'])?>">
    <? if (isset($titarray) && isset($titarray[2]) && !empty($titarray[2])) : ?>
      <?= $titarray[2]; ?>
    <? else : ?>
      СВЯЖИТЕСЬ С НАМИ:
    <? endif; ?>
  </div>
  <? if (isset($kontakty['phone']) && !empty($kontakty['phone'])) : ?>
    <div class="phone_foot_con">
    <a href="tel:<?= $kontakty['phone'] ?>"><?= $kontakty['phone'] ?></a>
      <ul class="seft-link">

        <? if (isset($kontakty['telegram']) && !empty($kontakty['telegram'])) : ?>
          <li>
            <a class="bb-arw-social__link" href="<?= $kontakty['telegram'] ?>" target="_blank">
              <img src="/vidget/iocn/tg.svg" alt="">
            </a>
          </li>
        <? endif; ?>
        <? if (isset($kontakty['viber']) && !empty($kontakty['viber'])) : ?>
          <li>
            <a class="bb-arw-social__link" href="<?= $kontakty['viber'] ?>" target="_blank">
              <img src="/vidget/iocn/vb.svg" alt="">
            </a>
          </li>
        <? endif; ?>
        <? if (isset($kontakty['whatsapp']) && !empty($kontakty['whatsapp'])) : ?>
          <li>
            <a class="bb-arw-social__link" href="<?= $kontakty['whatsapp'] ?>" target="_blank">
              <img src="/vidget/iocn/wh.svg" alt="">
            </a>
          </li>
        <? endif; ?>
      </ul>
    </div>

  <? endif; ?>
  <ul class="fb2_socials">
    <? if (isset($kontakty['instagram']) && !empty($kontakty['instagram'])) : ?>
      <li>
        <a class="icon icon-insta" target="_blank" href="<?= $kontakty['instagram'] ?>">
          <i class="fab fa-instagram"></i>
        </a>
        Find us on Instagram
      </li>
    <? endif; ?>
    <? if (isset($kontakty['youtube']) && !empty($kontakty['youtube'])) : ?>
      <li>
        <a class="icon icon-youtube" target="_blank" href="<?= $kontakty['youtube'] ?>">
          <i class="fab fa-youtube"></i>
        </a>
        Video testimonials upload
      </li>
    <? endif; ?>
  </ul>
<div class="item item_city">
  <a class="current" href="">
    <? if (isset($nameThisCity) && !empty($nameThisCity)) : ?>
      <?= $nameThisCity ?>
    <? endif; ?>
  </a>
</div>
<? if (isset($kontakty['phone']) && !empty($kontakty['phone'])) : ?>
  <div class="item item_phone">
    <a href="tel:<?= $kontakty['phone'] ?>" class="fil"><?= $kontakty['phone'] ?></a>
  </div>
<? endif; ?>

  <? if(isset($sort) && !empty($sort)):?>
    <? foreach($sort as $item):?>
      <?= $this->render('social-block', ['item' => $item])?>
      <? endforeach;?>
    <? else:?>
<div class="item social">
  <? if (isset($kontakty['whatsapp']) && !empty($kontakty['whatsapp'])) : ?>
    <a class="icon icon-vk sp-sd" target="_blank" href="<?= $kontakty['whatsapp'] ?>">
      <img src="/icon/what.svg" alt="">
      <img src="/vidget/iocn/wh.svg" alt="" class="hover">
    </a>
  <? endif; ?>

  <? if (isset($kontakty['telegram']) && !empty($kontakty['telegram'])) : ?>
    <a class="icon icon-vk sp-sd" target="_blank" href="<?= $kontakty['telegram'] ?>">
      <img src="/icon/tlg.svg" alt="">
      <img src="/vidget/iocn/tg.svg" alt="" class="hover">
    </a>
  <? endif; ?>
</div>
<div class="item social">
  <? if (isset($kontakty['youtube']) && !empty($kontakty['youtube'])) : ?>
    <a class="icon icon-youtube sp-sd" target="_blank" href="<?= $kontakty['youtube'] ?>">
      <img src="/icon/YoutubeMain.svg" alt="">
      <img src="/icon/hover/you.svg" alt="" class="hover">
    </a>
  <? endif; ?>
  <? if (isset($kontakty['instagram']) && !empty($kontakty['instagram'])) : ?>
    <a class="icon icon-insta sp-sd" target="_blank" href="<?= $kontakty['instagram'] ?>">
      <img src="/icon/instagramMain.svg" alt="">
      <img src="/icon/hover/insta.svg" alt="" class="hover">
    </a>
  <? endif; ?>

  <? if (isset($kontakty['vkontakte']) && !empty($kontakty['vkontakte'])) : ?>
    <a class="icon icon-vk sp-sd" target="_blank" href="<?= $kontakty['vkontakte'] ?>">
      <img src="/icon/vkicon.svg" alt="">
      <img src="/icon/vk.svg" alt="" class="hover">
    </a>
  <? endif; ?>
</div>


<div class="item  comcol">
  <? if (isset($kontakty['email']) && !empty($kontakty['email'])) : ?>
    <a class="icon icon-mail sp-sd" href="mailto:<?= $kontakty['email'] ?>">
      <img src="/icon/mailIconMain.svg" alt="">
      <img src="/icon/hover/mail.svg" alt="" class="hover">
    </a>
  <? endif; ?>
  <!-- <div class="item user"><a class="icon icon-user" href="https://body-balance.com/account/"><img src="/icon/lk.svg" alt=""></a></div> -->
</div>
<? endif?>

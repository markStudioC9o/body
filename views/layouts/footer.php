<?php

use app\widgets\BlockOneFooterWidget;
use app\widgets\FooterContact;
use app\widgets\FooterDisc;
use app\widgets\FooterInformer;
use app\widgets\FooterLink;
use app\widgets\FooterMenu;

?>
<footer>
  <?= BlockOneFooterWidget::widget(); ?>
  <div class="block_2">
    <div class="container">
      <div class="fb2_content">
        <div class="column">
          <div class="fb2_item">
            <?= FooterContact::widget(); ?>
          </div>
          <div class="divider"></div>
        </div>
        <?= FooterLink::widget(); ?>
        <div class="divider"></div>
        <div class="fb2_seotext">
          <?= FooterInformer::widget(); ?>
          <div class="divider"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="block_3">
    <div class="container">
      <div class="fb3_left">
        <p><i class="far fa-copyright"></i> Авторское право "Баланс Тела", 2020</p>
        <!-- <span>©</span> -->
        <?//= FooterDisc::widget();?>
      </div>
      <div class="fb3_right">
        <?= FooterMenu::widget()?>
      </div>
    </div>
  </div>
</footer>
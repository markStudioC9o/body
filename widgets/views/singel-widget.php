<?

use app\widgets\ColorWidget;

?>
<div class="card"  style="background: <?= ColorWidget::widget()?>">
  <? if (!empty($item['title'])) : ?>
    <div class="card-header asdasd" style="background: <?= ColorWidget::widget(['type' => 'main'])?>">
      <h5><?= $item['title']?></h5>
    </div>
  <? endif; ?>
  <div class="card__wrapper">
    <? if(isset($item['img']) && !empty($item['img'])):?>
    <div class="card-image">
      <img src="/widget/<?= $item['img'] ?>" alt="">
    </div>
    <? endif;?>
    <? if (!empty($item['content'])) : ?>
      <div class="card-descr">
        <?= $item['content'] ?>
      </div>
    <? endif; ?>
  </div>
</div>
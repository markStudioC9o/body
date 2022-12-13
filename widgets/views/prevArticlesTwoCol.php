<?
use yii\helpers\ArrayHelper;
?>

<div class="col-pod-s">
  <? $array = ArrayHelper::map($param, 'option_param', 'value') ?>
  <div class="block-shild-arcti set-er">
    <? if (isset($array['img_articles']) && !empty($array['img_articles'])) : ?>
      <div class="img_sh" style='background-image: url("/gallery/<?= $array['img_articles'] ?>")'>
      <? else : ?>
        <div class="img_sh" style="background-image: url(/img/default-img.jpg)">
        <? endif; ?>
        <div class="block_b in-image" style="background: <?= $color->color;  ?>">
          <span class="col_share">100K
          </span>
          <img src="/icon/share.svg" alt="">
        </div>
        </div>
        <div class="block-shild-title">
          <div class="share_block" style="background: <?= $color->color;  ?>">
            <div class="block_a">
              <ul>
                <li><a href="" class="soc vk"><img src="/icon/VectorVk.svg" alt=""></a></li>
                <li><a href="" class="soc fb"><img src="/icon/VectorFb.svg" alt=""></a></li>
                <li><a href="" class="soc ok"><img src="/icon/VectorOk.svg" alt=""></a></li>
              </ul>
            </div>
            <div class="block_b">
              <span class="col_share">100K
              </span>
              <img src="/icon/share.svg" alt="">
            </div>
          </div>
          <? if (isset($array['title']) && !empty($array['title'])) : ?>
            <p><a href="<?= (isset($lang) && !empty($lang) ? '/' . $lang : '/ru') ?>/<?= $model->link?>/<?= (isset($array['link']) && !empty($array['link']) ? $array['link'] : $id); ?>"><?= mb_strimwidth($array['title'], 0, 60, '...'); ?></a></p>
          <? endif; ?>
          <? if (isset($array['text']) && !empty($array['text'])) : ?>
            <p class="deck"><?= mb_strimwidth($array['text'], 0, 60, '...'); ?></p>
          <? endif; ?>
          <a href="<?= (isset($lang) && !empty($lang) ? '/' . $lang : '/ru') ?>/<?= $model->link?>/<?= (isset($array['link']) && !empty($array['link']) ? $array['link'] : $id); ?>" class="articLink" style="<?= (isset($color) && !empty($color->color) ? "color:" . $color->color : "") ?>">Читать далее</a>
        </div>
      </div>
  </div>
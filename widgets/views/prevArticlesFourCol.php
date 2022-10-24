<?

use yii\helpers\ArrayHelper;
?>

<div class="col-pod-s-four">
  <? $array = ArrayHelper::map($param, 'option_param', 'value') ?>
  <div class="block-shild-arcti">
    <? if (isset($array['img_articles']) && !empty($array['img_articles'])) : ?>
      <div class="prev_image" style='background-image: url("/articles/<?= $array['img_articles'] ?>")'>
      <? else : ?>
        
        <div class="prev_image" style='background-image: url("/img/default-img.jpg")'>
        <? endif; ?>
        <? if (isset($array['videoArticles']) && !empty($array['videoArticles']) && $array['videoArticles'] == "2") : ?>
          <img src="/icon/youtube.svg" alt="" class="videoArt">
          <div class="hover-block"></div>
        <? endif; ?>
        </div>
        <? if (isset($array['videoArticles']) && !empty($array['videoArticles']) && $array['videoArticles'] == "2") : ?>

          <div class="block-shild-title  arlet">
            <? if (isset($array['title']) && !empty($array['title'])) : ?>
              <p><a href="/articles/<?= $id; ?>"><?= mb_strimwidth($array['title'], 0, 60, '...'); ?></a></p>
            <? endif; ?>
          </div>

          <? else:?>
            <div class="block-shild-title">
          <div class="share_block" style="background: <?= $color;  ?>">
            <div class="block_a">
              <ul>
                <li><a href=""><img src="/icon/VectorVk.svg" alt=""></a></li>
                <li><a href=""><img src="/icon/VectorFb.svg" alt=""></a></li>
                <li><a href=""><img src="/icon/VectorOk.svg" alt=""></a></li>
              </ul>
            </div>
            <div class="block_b">
              <span class="col_share">100K
              </span>
              <img src="/icon/share.svg" alt="">
            </div>
          </div>
          <? if (isset($array['title']) && !empty($array['title'])) : ?>
            <p><?= mb_strimwidth($array['title'], 0, 60, '...'); ?></p>
          <? endif; ?>
          <? if (isset($array['text']) && !empty($array['text'])) : ?>
            <p class="rextDescript"><?= mb_strimwidth($array['text'], 0, 60, '...'); ?></p>
          <? endif; ?>
          <a href="/articles/<?= $id; ?>" class="linkArticles" style="color: <?= $color;  ?>">Читать далее</a>
        </div>
            <? endif; ?>
        
      </div>
  </div>
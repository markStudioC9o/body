<!-- <div class="ferty-shert"> -->
  <!-- <div class="img-shert"> -->
    <?// if (!empty($arraty['img_articles'])) : ?>
      <!-- <img src="/articles/<?//= $arraty['img_articles'] ?>" alt=""> -->
    <?// else : ?>
      <!-- <img src="/img/statistik_bg.jpg" alt=""> -->
    <?// endif; ?>
  <!-- </div> -->
  <!-- <div class="text-shert"> -->
    <!-- <?// if (!empty($arraty['title'])) : ?> -->
      <!-- <p><?//= mb_strimwidth($arraty['title'], 0, 60, "..."); ?></p> -->
    <?// else : ?>
      <!-- <p><?//= mb_strimwidth($arraty['text'], 0, 60, "..."); ?></p> -->
    <?// endif; ?>
  <!-- </div> -->
<!-- </div> -->

<!-- <pre>
  <?// print_r($arraty)?>
</pre> -->

<div class="col-pod-s">
  <div class="block-shild-arcti set-er">
    <? if (isset($arraty['img_articles']) && !empty($arraty['img_articles'])) : ?>
      <div class="img_sh" style='background-image: url("/gallery/<?= $arraty['img_articles'] ?>")'>
      <? else : ?>
        <div class="img_sh" style="background-image: url(/img/default-img.jpg)">
        <? endif; ?>
        <div class="block_b in-image" style="background: <?//= $color->color;  ?>">
          <span class="col_share">100K
          </span>
          <img src="/icon/share.svg" alt="">
        </div>
        </div>
        <div class="block-shild-title">
          <div class="share_block" style="background: <?= $color->color;  ?>">
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
          <? if (isset($arraty['title']) && !empty($arraty['title'])) : ?>
            <p><a href="<?= (isset($lang) && !empty($lang) ? '/' . $lang : '/ru') ?>/articles/<?= (isset($arraty['link']) && !empty($arraty['link']) ? $arraty['link'] : $id); ?>"><?= mb_strimwidth($arraty['title'], 0, 60, '...'); ?></a></p>
          <? endif; ?>
          <? if (isset($arraty['text']) && !empty($arraty['text'])) : ?>
            <p class="deck"><?= mb_strimwidth($arraty['text'], 0, 60, '...'); ?></p>
          <? endif; ?>
          <a href="<?= (isset($lang) && !empty($lang) ? '/' . $lang : '/ru') ?>/articles/<?= (isset($arraty['link']) && !empty($arraty['link']) ? $arraty['link'] : $id); ?>" class="articLink" style="<?= (isset($color) && !empty($color->color) ? "color:" . $color->color : "") ?>">Читать далее</a>
        </div>
      </div>
  </div>


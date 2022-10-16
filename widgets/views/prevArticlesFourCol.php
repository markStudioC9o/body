<?

use yii\helpers\ArrayHelper;
?>

<div class="col-pod-s-four">
  <? $array = ArrayHelper::map($param, 'option_param', 'value') ?>
  <div class="block-shild-arcti">
    <? if (isset($array['img_articles']) && !empty($array['img_articles'])) : ?>
      <div class="prev_image" style='background-image: url("/articles/<?= $array['img_articles'] ?>")'>
      <? else : ?>
        <div class="prev_image" style='background-image: url("/articles/IMG_7555 1.png")'>
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

      <!-- [heading] => 12
    [text] => На страницах этого сайта мы расскажем вам об одном фундаментальном открытии в области здоровья, которое перевернёт ваше представление о причинах возникновения сколиоза и остеохондроза. Родовая травма, оставаясь недиагностированной, имеется у 90% людей и приводит к множественным неврологическим симптомам и раннему биомеханическому развалу позвоночника. Устранив родовую травму вы избавите себя от многих неприятностей и трудностей со здоровьем, обретёте крепкое здоровье на долгие годы.. Атлант – это наш первый шейный позвонок, который является основной частью сустава головы. Благодаря ему она балансирует и совершает поворотные и наклонные движения. В результате различных травм шеи и, особенно, в процессе родов, работа сустава может быть частично заблокирована. А в мышцах которые им управляют, почти всегда возникает защитное усиление, вплоть до подвывиха. Такие неприятные жизненные ситуации как падения и удары головой, хлыстовые травмы, дтп, рывки и хрусты шеей – могут усугубить ситуацию и привести к ещё большему усилению мышц и полному обездвиживанию сустава, вплоть до вывиха.
    [title] => 
    [img_articles] => 205atlasbalance-640x550.png
    $array['widget_articles'] =>  -->
      <? //= print_r($id) 
      ?>
  </div>
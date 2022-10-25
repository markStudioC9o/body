<?
use app\models\ArticlesOption;
use app\models\ArticlesOptionLang;
use yii\helpers\ArrayHelper;
$items = ArrayHelper::map($param, 'option_param', 'value');
$image = ArticlesOption::find()->where(['option_param'=>'img_articles'])->andWhere(['articles_id' => $id])->asArray()->one();
?>
<?if($lang !='ru'):?>
<? $ilert = ArticlesOptionLang::find()->where(['articles_id' => $id])->andWhere(['tag' => $lang])->all();
$items = ArrayHelper::map($ilert, 'option_param', 'value');
?>
<?if(!empty($ilert)):?>  
<div class="item_wrap vid_2">
  <div class="item">
      <? if (isset($image['value']) && !empty($image['value'])) : ?>
        <div class="img" style="background-image: url(/gallery/<?= $image['value'] ?>)">
        <? else:?>
          <div class="img" style="background-image: url(/img/default-img.jpg)">
        <? endif; ?>
        <div class="socials_wrap" data-post-id="">
          <div class="socials" style="<?= (isset($color) && !empty($color->color) ? "background-color:".$color->color : "background-color: #39a9f9;") ?>">
            <!-- <div class="items">
              <a onclick="toShare('http://vk.com/share.php?url=https%3A%2F%2Fbody-balance.com%2Fmetod-v-evrope%2F');return false;" class="vk"></a>
              <a onclick="toShare('http://www.facebook.com/share.php?u=https%3A%2F%2Fbody-balance.com%2Fmetod-v-evrope%2F&amp;title=%D0%9C%D0%B5%D1%82%D0%BE%D0%B4+%26%238220%3B%D0%9A%D0%BE%D1%80%D1%80%D0%B5%D0%BA%D1%86%D0%B8%D1%8F+%D1%81%D1%83%D1%81%D1%82%D0%B0%D0%B2%D0%B0+%D0%B3%D0%BE%D0%BB%D0%BE%D0%B2%D1%8B%26%238221%3B+%D0%BF%D0%BE%D0%B4%D1%82%D0%B2%D0%B5%D1%80%D0%B6%D0%B4%D1%91%D0%BD+%D0%B2+%D0%95%D0%B2%D1%80%D0%BE%D0%BF%D0%B5');return false;" class="fb"></a>
              <a onclick="toShare('http://www.odnoklassniki.ru/dk?st.cmd=addShare&amp;st.s=1&amp;st._surl=https%3A%2F%2Fbody-balance.com%2Fmetod-v-evrope%2F');return false;" class="ok"></a>
            </div> -->
            <!-- <div class="counter">579</div> -->
            <div class="divider"></div>
          </div>
        </div>
      </div>
    
    <div class="info">
      <? if (isset($items['title']) && !empty($items['title'])) : ?>
        <a href="/articles/<?= (isset($items['link'])?  $items['link'] : $id);?>" class="title">
          <?= mb_strimwidth($items['title'], 0, 65, "...");?>
        </a>
      <? endif; ?>
      <? if (isset($items['text']) && !empty($items['text'])) : ?>
        <p class="desc">
          <?= mb_strimwidth($items['text'], 0, 190, "...");?>
        </p>
      <? endif; ?>
      
      <a href="/articles/<?= (isset($items['link'])?  $items['link'] : $id);?>" class="link" style="<?= (isset($color) && !empty($color->color) ? "color:".$color->color : "color: #39a9f9;") ?>">Read more</a>
    </div>
  </div>
</div>
<?endif;?>
<?else:?>
<div class="item_wrap vid_2">
  <div class="item">
      <? if (isset($items['img_articles']) && !empty($items['img_articles'])) : ?>
        <div class="img" style="background-image: url(/gallery/<?= $items['img_articles'] ?>)">
        <? else:?>
          <div class="img" style="background-image: url(/img/default-img.jpg)">
        <? endif; ?>
        <div class="socials_wrap" data-post-id="">
          <div class="socials" style="<?= (isset($color) && !empty($color->color) ? "background-color:".$color->color : "background-color: #39a9f9;") ?>">
            <!-- <div class="items">
              <a onclick="toShare('http://vk.com/share.php?url=https%3A%2F%2Fbody-balance.com%2Fmetod-v-evrope%2F');return false;" class="vk"></a>
              <a onclick="toShare('http://www.facebook.com/share.php?u=https%3A%2F%2Fbody-balance.com%2Fmetod-v-evrope%2F&amp;title=%D0%9C%D0%B5%D1%82%D0%BE%D0%B4+%26%238220%3B%D0%9A%D0%BE%D1%80%D1%80%D0%B5%D0%BA%D1%86%D0%B8%D1%8F+%D1%81%D1%83%D1%81%D1%82%D0%B0%D0%B2%D0%B0+%D0%B3%D0%BE%D0%BB%D0%BE%D0%B2%D1%8B%26%238221%3B+%D0%BF%D0%BE%D0%B4%D1%82%D0%B2%D0%B5%D1%80%D0%B6%D0%B4%D1%91%D0%BD+%D0%B2+%D0%95%D0%B2%D1%80%D0%BE%D0%BF%D0%B5');return false;" class="fb"></a>
              <a onclick="toShare('http://www.odnoklassniki.ru/dk?st.cmd=addShare&amp;st.s=1&amp;st._surl=https%3A%2F%2Fbody-balance.com%2Fmetod-v-evrope%2F');return false;" class="ok"></a>
            </div> -->
            <!-- <div class="counter">579</div> -->
            <div class="divider"></div>
          </div>
        </div>
      </div>
    
    <div class="info">
      <? if (isset($items['title']) && !empty($items['title'])) : ?>
        <a href="/articles/<?= (isset($items['link'])?  $items['link'] : $id);?>" class="title">
          <?= mb_strimwidth($items['title'], 0, 65, "...");?>
        </a>
      <? endif; ?>
      <? if (isset($items['text']) && !empty($items['text'])) : ?>
        <p class="desc">
          <?= mb_strimwidth($items['text'], 0, 190, "...");?>
        </p>
      <? endif; ?>
      <a href="/articles/<?= (isset($items['link'])?  $items['link'] : $id);?>" class="link" style="<?= (isset($color) && !empty($color->color) ? "color:".$color->color : "color: #39a9f9;") ?>">Читать далее</a>
    </div>
  </div>
</div>

<? endif;?>

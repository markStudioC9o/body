<?

use app\widgets\CitiesWidget;
use app\widgets\Language;
?>

<?
function sendLink($elem, $lang)
{
  if (isset($elem['ex_link']) && !empty($elem['ex_link'])) {
    return $elem['ex_link'];
  } else {
    if (isset($elem['link']) && !empty($elem['link'])) {
      return (isset($lang) && !empty($lang) ? "/" . $lang . "/" : "/") . "pages/" . $elem['link'];
    } else {
      return null;
    }
  }
}



?>
<? $lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : null;
//print_r($lang);
?>
<div id="mob_top_header">
  <div class="item mob-logo">
    <a class="logo" href="/<?= (isset($lang) && !empty($lang) ? $lang : "") ?>">
      <img src="/img/logo_ab.svg" alt="">
    </a>
  </div>
  <div class="lang-mob ff">
    <!-- <div class="item user"><a class="icon icon-user" href="https://body-balance.com/account/"><img src="/icon/lkmob.svg" alt=""></a></div> -->
    <ul>
      <?= Language::widget(); ?>
    </ul>
  </div>
  <div class="burger_menu">
    <span class="ps-1"></span>
    <span class="ps-2"></span>
    <span class="ps-3"></span>
    <span class="tlt">MENU</span>
  </div>
</div>
<div id="mob_bottom_header">
<?$citesVal =  CitiesWidget::widget(['city' => $city, 'cosial' => $cosial, 'type' => 'mob', 'cityHide' => $cityHide]); ?>
<? if(!empty($citesVal)):?>
  <div class="item item_city">
      <a class="current" href=""><?= $citesVal?></a>
  </div>
  <? endif;?>
  <div class="item item_phone">
    <a href="tel:<?= CitiesWidget::widget(['city' => $city, 'cosial' => $cosial, 'type' => 'phone']); ?>" class="fil"><?= CitiesWidget::widget(['city' => $city, 'cosial' => $cosial, 'type' => 'phone']); ?></a>
  </div>
</div>


<div id="top_header">
  <div class="item logo">
    <a class="logo" href="/<?= (isset($lang) && !empty($lang) ? $lang : "") ?>">
    <?= (!empty($logoTExt->value)?$logoTExt->value:'body balance clinic')?>
    </a>
  </div>
  <?= CitiesWidget::widget(['city' => $city, 'cosial' => $cosial, 'cityHide' => $cityHide]); ?>
  <div class="item search">
    <a class="search_icon"><img src="/icon/serty.svg" alt=""></a>
    <div class="search_form_header">
      <form class="search_footer search_header" id="pc_s" action="/">
        <input type="text" name="s" placeholder="<?if(!empty($search) && isset($search['value'])){echo $search['value'];}?>" class="field-search" />
        <button type="submit" class="searchButton"></button>
      </form>
    </div>
  </div>
  <div class="item lan-curent">
    <ul>
      <?= Language::widget(); ?>
    </ul>
  </div>
</div>

<div id="bottom_header">
  <ul id="menu-menyu-v-shapke-ru" class="pc_menu">
    <? if (!empty($menuArr)) : ?>
      <? foreach ($menuArr['data'] as $item) : ?>
        <? if (isset($item['children'])) : ?>
            <?= $this->render('punktMenutoChild',[
              'item' => $item,
              'pages' => $pages,
              'lang' => $lang,
              'menuParam' => $menuParam
            ])?>
        <? else : ?>
          <?= $this->render('punktMenu', [
            'item' => $item,
            'pages' => $pages,
            'lang' => $lang,
            'menuParam' => $menuParam
          ])?>
        <? endif; ?>
      <? endforeach; ?>
    <? endif; ?>

    <? if (!empty($textLink)) : ?>
      <li class="main-menu-item menu-item link-shop" data-color="#759523">
        <a href="<?= (isset($hrefShop['value']) && !empty($hrefShop['value']) ? $hrefShop['value'] : "") ?>" class="menu-link main-menu-link" data-color="#759523">
          <?= $textLink ?>
        </a>
      </li>
    <? endif; ?>

  </ul>
  <!-- <div class="change_lang_mob">
    <select>
      <option value="https://body-balance.com/" selected>Русский (ru)</option>
    </select>
  </div> -->

  <!-- <div class="divider"></div> -->
</div>
<div id="mob_menu">
  <ul class="mob_list">
    <? if (!empty($menuArr)) : ?>
      <? foreach ($menuArr['data'] as $item) : ?>
        <? if (isset($item['children'])) : ?>
          <? $elem = $pages->findId(str_replace("item_", "", $item['id'])) ?>
          <? $imgB = $pages->findImg($item['id']); ?>
          <?= $this->render('mob-menu-child',[
            'lang' => $lang,
            'elem' => $elem,
            'item' => $item,
            'imgB' => $imgB,
            'pages' => $pages,
            'menuParam' => $menuParam
          ])?>
        <? else : ?>
          <? $elem = $pages->findId(str_replace("item_", "", $item['id'])) ?>
          <? $imgB = $pages->findImg($item['id']); ?>
          <? $baseLink = $pages->findLang(str_replace("item_", "", $item['id'])) ?>
          <?= $this->render('mob-menu-not-child',[
            'item' => $item,
            'baseLink' => $baseLink,
            'elem' => $elem,
            'lang' => $lang,
            'pages' => $pages,
            'imgB' => $imgB,
            'menuParam' => $menuParam
          ])?>
        <? endif; ?>
      <? endforeach; ?>
    <? endif; ?>
    <? if (!empty($textLink)) : ?>
      <li class="main-menu-item menu-item link-shop" data-color="#759523">
        <a href="<?= (isset($hrefShop['value']) && !empty($hrefShop['value']) ? $hrefShop['value'] : "") ?>" class="menu-link main-menu-link" data-color="#759523">
          <?= $textLink ?>
        </a>
      </li>
    <? endif; ?>

    <li>
      <?$citesVal =  CitiesWidget::widget(['city' => $city, 'cosial' => $cosial, 'type' => 'mob', 'cityHide' => $cityHide]); ?>
      <? if(!empty($citesVal)):?>
      <a class="current" href=""><?= $citesVal?></a>
      <? endif;?>
    </li>
  </ul>

  <div class="mob_in_bottom">

    <div class="icons fer-tt">
      <div class="item item_phone">
        <ul>
          <li><a href="tel:<?= CitiesWidget::widget(['city' => $city, 'cosial' => $cosial, 'type' => 'phone']); ?>" class="fil"><?= CitiesWidget::widget(['city' => $city, 'cosial' => $cosial, 'type' => 'phone']); ?></a></li>
        </ul>
      </div>
      <div class="item lsd">
        <ul class="fgu">
          <li><a class="icon icon-mail" href="mailto:info@body-balance.com">
              <img src="/icon/mailIconMain.svg" alt="">
              <img src="/icon/hover/mail.svg" alt="" class="hover">
            </a>
          </li>
          <li>
            <!-- <div class="item user"><a class="icon icon-user" href="https://body-balance.com/account/"><img src="/icon/lkmob.svg" alt=""></a></div> -->
          </li>
          <!-- <li><a class="icon icon-user" href="https://body-balance.com/account/"><i class="far fa-user"></i></a></li> -->
        </ul>
      </div>
    </div>
    <div class="icons ogt" style="display: flex;">
      <div class="item">
        <ul>
          <li><a class="icon icon-youtube" target="_blank" href="https://www.youtube.com/channel/UCLrLW_tq5xANk8Pkxj3rUTg"><img src="/icon/YoutubeMain.svg" alt=""></a></li>
          <li><a class="icon icon-insta" target="_blank" href="https://www.instagram.com/andrei_popravka/"><img src="/icon/instagramMain.svg" alt=""></a></li>
        </ul>
      </div>
      <div class="item ser-mob">
        <ul>
          <li class="search_icon search_icon_mob"><img src="/img/search.svg" alt=""></li>
          <li class="search_form_header1 search_form_header_mob">
            <form class="search_footer search_header" id="mob_s" action="/">
              <input type="text" name="s" placeholder="Поиск" class="field-search" />
              <button type="submit" id="searchButton"></button>
            </form>
          </li>
        </ul>
      </div>
      <div class="item">
        <div class="lang-mob mm">
          <ul>
            <?= Language::widget(); ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
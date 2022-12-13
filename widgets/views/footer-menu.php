<!-- <ul id="menu-niz-podvala-ru" class="fb3_menu menu">
          <li id="menu-item-3259" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3259"><a href="https://body-balance.com/kontakty/">Контакты</a></li>
          <li id="menu-item-3260" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3260"><a href="https://body-balance.com/shop/">Магазин</a></li>
          <li id="menu-item-3257" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3257"><a href="https://body-balance.com/account/partner/">Партнер</a></li>
          <li id="menu-item-3256" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3256"><a href="https://body-balance.com/account/">ЛК</a></li>
        </ul> -->



<? $lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : null;
//print_r($lang);
?>
<ul id="menu-niz-podvala-ru" class="fb3_menu menu">
  <? if (!empty($menuArr)) : ?>
    <? foreach ($menuArr['data'] as $item) : ?>
      <? if (stristr($item['id'], '_', true) == 'item') : ?>
        <? $elem = $pages->findId(str_replace("item_", "", $item['id'])) ?>
        <? if (isset($elem['title']) && !empty($elem['title'])) : ?>
          <li class="menu-item menu-item-type-post_type menu-item-object-page">
            <a href="/pages/<?= (isset($elem['link']) ? $elem['link'] : '') ?>">
              <?php echo $elem['title']; ?>
            </a>
          </li>
        <? endif; ?>
      <? endif; ?>
      <? if (stristr($item['id'], '_', true) == 'artic') : ?>
        <li class="menu-item menu-item-type-post_type menu-item-object-page">
          <? $elem = $pages->findArticFromId($item['id']) ?>
            <?// print_r($elem)?>
          <? // $promp = $menuParam->Proms($item['id'], $lang); 
          ?>
          <a href="<?= sendLink($elem['option'], $lang); ?>">
            <?= isset($promp['value']) && !empty($promp['value']) ? $promp['value'] : (isset($elem['artic']['text']) ? $elem['artic']['text'] : '') ?>
          </a>
        </li>
      <? endif; ?>

      <? if (stristr($item['id'], '_', true) == 'heading') : ?>
  <? $elem = $pages->findHeadingId($item['id']) ?>
  
  <li class="menu-item menu-item-type-post_type menu-item-object-page">
    <a href="/<?= (isset($lang) && !empty($lang) ? $lang . '/heading/' : 'heading/') ?><?= (isset($elem['link']) && ($elem['link']) ? $elem['link'] : '') ?>">
      
      <?= (isset($promp['value']) && !empty($promp['value']) ? $promp['value'] : $elem['title']) ?>
    </a>
  </li>
<? endif; ?>

    <? endforeach; ?>
  <? endif; ?>
</ul>


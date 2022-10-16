<!-- <ul id="menu-niz-podvala-ru" class="fb3_menu menu">
          <li id="menu-item-3259" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3259"><a href="https://body-balance.com/kontakty/">Контакты</a></li>
          <li id="menu-item-3260" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3260"><a href="https://body-balance.com/shop/">Магазин</a></li>
          <li id="menu-item-3257" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3257"><a href="https://body-balance.com/account/partner/">Партнер</a></li>
          <li id="menu-item-3256" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3256"><a href="https://body-balance.com/account/">ЛК</a></li>
        </ul> -->

<ul id="menu-niz-podvala-ru" class="fb3_menu menu">
  <? if (!empty($menuArr)) : ?>
    <? foreach ($menuArr['data'] as $item) : ?>
      <? $elem = $pages->findId(str_replace("item_", "", $item['id'])) ?>
      <? if(isset($elem['title']) && !empty($elem['title'])):?>
      <li class="menu-item menu-item-type-post_type menu-item-object-page">
        <a href="/pages/<?= (isset($elem['link']) ? $elem['link'] : '') ?>">
          <?php echo $elem['title']; ?>
        </a>
      </li>
        <? endif;?>
    <? endforeach; ?>
  <? endif; ?>
</ul>
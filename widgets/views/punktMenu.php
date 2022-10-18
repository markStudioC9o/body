<? $imgB = $pages->findImg($item['id']); ?>
<? if(isset($imgB['active_lang']) && !empty($imgB['active_lang'])){
  $gmog = json_decode($imgB['active_lang'], true);
}else{
  $gmog = null;
}?>
<? if($gmog[$lang] != '1'):?>

<? if (stristr($item['id'], '_', true) == 'item') : ?>
  <? $elem = $pages->findId(str_replace("item_", "", $item['id'])) ?>
  <? $baseLink = $pages->findLang(str_replace("item_", "", $item['id'])) ?>
  <? if (!empty($baseLink)) : ?>
    <? if ($baseLink != '300' && !empty($baseLink['title'])) : ?>
      <li class="main-menu-item menu-item" data-color="<?= (isset($imgB) && !empty($imgB['color']) ? $imgB['color'] : '#759523') ?>">
        <a href="<?= sendLink($baseLink, $lang); ?>" class="menu-link main-menu-link" data-color="<?= (isset($imgB) && !empty($imgB['color']) ? $imgB['color'] : '#759523') ?>">
          <? if (!empty($imgB)) : ?>
            <img src="/icon/<?= $imgB['link'] ?>" alt="" class="menu-icon">
          <? endif; ?>
          <?php echo $baseLink['title']; ?>
        </a>
      </li>
    <? endif; ?>
  <? else : ?>
    <li class="main-menu-item menu-item" data-color="<?= (isset($imgB) && !empty($imgB['color']) ? $imgB['color'] : '#759523') ?>">
      <a href="<?= sendLink($elem, $lang); ?>" class="menu-link main-menu-link" data-color="<?= (isset($imgB) && !empty($imgB['color']) ? $imgB['color'] : '#759523') ?>">
        <? if (isset($imgB['link']) && !empty($imgB['link'])) : ?>
          <img src="/icon/<?= $imgB['link'] ?>" alt="" class="menu-icon">
        <? endif; ?>
        <? $promp = $menuParam->Proms($item['id'], $lang); ?>
        <?= (isset($promp['value']) && !empty($promp['value']) ? $promp['value'] : $elem['title']) ?>
      </a>
    </li>
  <? endif; ?>
<? endif; ?>

<? if (stristr($item['id'], '_', true) == 'artic') : ?>
  <? $elem = $pages->findArticId(str_replace("item_", "", $item['id'])) ?>
  <?//= ?>
  <li class="main-menu-item menu-item" data-color="<?= (isset($imgB) && !empty($imgB['color']) ? $imgB['color'] : '#759523') ?>">
    <a href="/<?= (isset($lang) && !empty($lang) ? $lang . '/articles/' : 'articles/') ?><?= (isset($elem['option']['link']) && ($elem['option']['link']) ? $elem['option']['link'] : '') ?>" class="menu-link main-menu-link" data-color="<?= (isset($imgB) && !empty($imgB['color']) ? $imgB['color'] : '#759523') ?>">
      <? if (isset($imgB['link']) && !empty($imgB['link'])) : ?>
        <img src="/icon/<?= $imgB['link'] ?>" alt="" class="menu-icon">
      <? endif; ?>
      <? $promp = $menuParam->Proms($item['id'], $lang); ?>
      <?= (isset($promp['value']) && !empty($promp['value']) ? $promp['value'] : $elem['artic']['text']) ?>
    </a>
  </li>
<? endif; ?>

<? if (stristr($item['id'], '_', true) == 'heading') : ?>
  <? $elem = $pages->findHeadingId($item['id']) ?>
  <li class="main-menu-item menu-item" data-color="<?= (isset($imgB) && !empty($imgB['color']) ? $imgB['color'] : '#759523') ?>">
    <a href="/<?= (isset($lang) && !empty($lang) ? $lang . '/pages/' : 'pages/') ?><?= (isset($elem['option']['link']) && ($elem['option']['link']) ? $elem['option']['link'] : '') ?>" class="menu-link main-menu-link" data-color="<?= (isset($imgB) && !empty($imgB['color']) ? $imgB['color'] : '#759523') ?>">
      <? if (isset($imgB['link']) && !empty($imgB['link'])) : ?>
        <img src="/icon/<?= $imgB['link'] ?>" alt="" class="menu-icon">
      <? endif; ?>
      <? $promp = $menuParam->Proms($item['id'], $lang); ?>
      <?= (isset($promp['value']) && !empty($promp['value']) ? $promp['value'] : $elem['title']) ?>
    </a>
  </li>
<? endif; ?>
<? endif;?>
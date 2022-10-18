<? $imgB = $pages->findImg($item['id']); ?>
<? if(isset($imgB['active_lang']) && !empty($imgB['active_lang'])){
  $gmog = json_decode($imgB['active_lang'], true);
}else{
  $gmog = null;
}?>
<? if($gmog[$lang] != '1'):?>

<? if (stristr($item['id'], '_', true) == 'item') : ?>
  <? $elem = $pages->findNameFromId($item['id']) ?>
  <? $imgB = $pages->findImg($item['id']); ?>
  <? if (isset($elem['title']) && !empty($elem['title'])) : ?>
    <li class="main-menu-item menu-item menu-item-has-children" data-color="<?= (isset($imgB) && !empty($imgB['color']) ? $imgB['color'] : '#759523') ?>">
      <a data-id="<?= $item['id']?>" href="<?= sendLink($elem, $lang); ?>" class="menu-link main-menu-link" data-color="<?= (isset($imgB) && !empty($imgB['color']) ? $imgB['color'] : '#759523') ?>">
        <? if (isset($imgB['link']) && !empty($imgB['link'])) : ?>
          <img src="/icon/<?= $imgB['link'] ?>" alt="" class="menu-icon">
        <? endif; ?>
        <?= (isset($elem['title']) ? $elem['title'] : '') ?>
      </a>
    <? endif; ?>
  <? endif; ?>



  <? if (stristr($item['id'], '_', true) == 'artic') : ?>
    <? $elem = $pages->findArticFromId($item['id']) ?>
    <? $imgB = $pages->findImg($item['id']); ?>
    <? if (isset($elem['artic']['text']) && !empty($elem['artic']['text'])) : ?>
    <li class="main-menu-item menu-item menu-item-has-children" data-color="<?= (isset($imgB) && !empty($imgB['color']) ? $imgB['color'] : '#759523') ?>">
      <a href="<?= sendLink($elem, $lang); ?>" class="menu-link main-menu-link" data-color="<?= (isset($imgB) && !empty($imgB['color']) ? $imgB['color'] : '#759523') ?>">
        <? if (isset($imgB['link']) && !empty($imgB['link'])) : ?>
          <img src="/icon/<?= $imgB['link'] ?>" alt="" class="menu-icon">
        <? endif; ?>
        <? $promp = $menuParam->Proms($item['id'], $lang); ?>
        <?= isset($promp['value']) && !empty($promp['value']) ? $promp['value'] : (isset($elem['artic']['text']) ? $elem['artic']['text'] : '') ?>
      </a>
    <? endif; ?>
  <? endif; ?>


  <? if (stristr($item['id'], '_', true) == 'heading') : ?>
  <? $elem = $pages->findHeadingId($item['id']) ?>
  <? $imgB = $pages->findImg($item['id']); ?>
  <li class="main-menu-item menu-item menu-item-has-children" data-color="<?= (isset($imgB) && !empty($imgB['color']) ? $imgB['color'] : '#759523') ?>">
    <a href="/<?= (isset($lang) && !empty($lang) ? $lang . '/pages/' : 'pages/') ?><?= (isset($elem['link']) && ($elem['link']) ? $elem['link'] : '') ?>" class="menu-link main-menu-link" data-color="<?= (isset($imgB) && !empty($imgB['color']) ? $imgB['color'] : '#759523') ?>">
      <? if (isset($imgB['link']) && !empty($imgB['link'])) : ?>
        <img src="/icon/<?= $imgB['link'] ?>" alt="" class="menu-icon">
      <? endif; ?>
      <? $promp = $menuParam->Proms($item['id'], $lang); ?>
      <?= (isset($promp['value']) && !empty($promp['value']) ? $promp['value'] : $elem['title']) ?>
    </a>
<? endif; ?>



  <ul class="sub-menu">
    <? foreach ($item['children'] as $val) : ?>
      <? if (stristr($val['id'], '_', true) == 'item') : ?>
        <? $elemChild = $pages->findId(str_replace("item_", "", $val['id'])) ?>
        <? $imgB = $pages->findImg($val['id']); ?>
        <? if (isset($elemChild['title']) && !empty($elemChild['title'])) : ?>
          <li class="sub-menu-item menu-item" data-color="<?= (isset($imgB) && !empty($imgB['color']) ? $imgB['color'] : '#759523') ?>">
            <a href="<?= sendLink($elemChild, $lang); ?>" class="menu-link sub-menu-link" data-color="<?= (isset($imgB) && !empty($imgB['color']) ? $imgB['color'] : '#759523') ?>">
              <? if (!empty($imgB) && !empty($imgB['link'])) : ?>
                <img src="/icon/<?= $imgB['link'] ?>" alt="" class="menu-icon">
              <? endif; ?>
              <?= (isset($elemChild['title']) ? $elemChild['title'] : '') ?>
            </a>
          </li>
        <? endif; ?>
      <? endif; ?>

      <? if (stristr($val['id'], '_', true) == 'artic') : ?>
        <? $elemChild = $pages->findArticId(str_replace("item_", "", $val['id'])) ?>
        <? if (isset($elemChild['artic']['text']) && !empty($elemChild['artic']['text'])) : ?>
          <? $imgB = $pages->findImg($val['id']); ?>
          <li class="sub-menu-item menu-item" data-color="<?= (isset($imgB) && !empty($imgB['color']) ? $imgB['color'] : '#759523') ?>">
            <a href="/<?= (isset($lang) && !empty($lang) ? $lang . '/articles/' : 'articles/') ?><?= (isset($elemChild['option']['link']) && ($elemChild['option']['link']) ? $elemChild['option']['link'] : '') ?>" class="menu-link sub-menu-link" data-color="<?= (isset($imgB) && !empty($imgB['color']) ? $imgB['color'] : '#759523') ?>">
              <? if (!empty($imgB) && !empty($imgB['link'])) : ?>
                <div class="menu-icon" style="background-image: url(/icon/<?= $imgB['link'] ?>)"></div>
              <? endif; ?>
              <? $promp = $menuParam->Proms($val['id'], $lang); ?>
              <?= isset($promp['value']) && !empty($promp['value']) ? $promp['value'] : (isset($elemChild['artic']['text']) ? $elemChild['artic']['text'] : '') ?>
            </a>
          </li>
        <? endif; ?>
      <? endif; ?>

      <? if (stristr($val['id'], '_', true) == 'heading') : ?>
        <? $elemChild = $pages->findHeadingId($val['id']) ?>
        
        <? if (isset($elemChild['title']) && !empty($elemChild['title'])) : ?>
          <? $imgB = $pages->findImg($val['id']); ?>
          <li class="sub-menu-item menu-item" data-color="<?= (isset($imgB) && !empty($imgB['color']) ? $imgB['color'] : '#759523') ?>">
            <a href="/<?= (isset($lang) && !empty($lang) ? $lang . '/pages/' : 'pages/') ?><?= (isset($elemChild['link']) && ($elemChild['link']) ? $elemChild['link'] : '') ?>" class="menu-link sub-menu-link" data-color="<?= (isset($imgB) && !empty($imgB['color']) ? $imgB['color'] : '#759523') ?>">
              <? if (!empty($imgB) && !empty($imgB['link'])) : ?>
                <div class="menu-icon" style="background-image: url(/icon/<?= $imgB['link'] ?>)"></div>
              <? endif; ?>
              <? $promp = $menuParam->Proms($val['id'], $lang); ?>
              <?= (isset($promp['value']) && !empty($promp['value']) ? $promp['value'] : $elemChild['title']) ?>
            </a>
          </li>
        <? endif; ?>
      <? endif; ?>
    <? endforeach; ?>
  </ul>
    </li>
    <? endif;?>
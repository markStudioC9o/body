
<? if(!empty($model) && isset($model['value']) && !empty($model['value'])):?>
<div class="banner">
    <div class="container">
      <div class="banner__inner">
        <img src="/icon/banner-icon.svg" class="banner__img" alt="important icon">
        <p> <?= $model['value']?></p>
      </div>
    </div>
  </div>
  <? endif;?>
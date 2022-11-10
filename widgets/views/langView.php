<? // print_r($model) 

use app\widgets\ColorWidget;

?>
<li class="change_lang">
  <div class="current" onclick="$(this).parent().toggleClass('opened');" style="background-color: <?= ColorWidget::widget(['type' => 'main'])?>">
    <span class="flag-wrap" data-toogel="<?= $active['tag'] ?>">
      <?= $active['tag'] ?>
      
      <!-- <span class="flag" style="background-image: url('/lang/<?//= $active['icon'] ?>');"></span> -->
      <? if(isset($active['icon']) && !empty($active['icon'])):?>
        <span class="flag" style="background-image: url('/lang/<?= $active['icon']?>');"></span>
        <? else:?>
          <span class="flag" style="background-image: url('/icon/rus.svg');"></span>
          <? endif;?>
      
    </span>
    <span class="toggle"></span>
  </div>
  <div class="others">
    <? foreach ($model as $item) : ?>
      <? if($item['tag'] != $active['tag']):?>
      <a href="/param/lang?tag=<?= $item['tag']?>">
        <span class="flag-wrap" data-toogel="<?= $item['tag'] ?>"><?= $item['tag'] ?><span class="flag" style="background-image: url('/lang/<?= $item['icon'] ?>');"></span>
        </span>
      </a>
      <? endif;?>
    <? endforeach; ?>
    
  </div>
  <select name="" id="rigfd">
  <option value="<?= $active['tag']?>" selected="selected"><?= $active['name'] ?> (<?= $active['tag'] ?>)</option>
    <? foreach ($model as $item) : ?>
      <? if($item['tag'] != $active['tag']):?>
      <option value="<?= $item['tag'] ?>"><?= $item['name'] ?> (<?= $item['tag'] ?>)</option>
      <? endif;?>
      <? endforeach?>
    </select>
</li>
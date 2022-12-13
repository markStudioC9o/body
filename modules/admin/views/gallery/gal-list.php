<ul class="gal_list_item">
  <? foreach($model as $item):?>
    <li data-id="<?= $item['id']?>" class="app-gelser"> # <?= (isset($item['name']) && !empty($item['name']) ? $item['name'] : $item['id'])?></li>
  <? endforeach;?>
</ul>
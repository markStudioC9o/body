<? $i=1;?>
<?//= $data['size']; ?>
<ul>
  <? if (!empty($map)) : ?>
    <? foreach ($map as $name => $value) : ?>
      <? if (isset($data['icon']) && !empty($data['icon'])) : ?>
        <li>
          <span style="margin-right: <?= $data['padding'] ?>px"><?= $data['icon'] ?></span>
          <?= $value ?>
        </li>
      <? else : ?>
        <? if ($data['type'] == "numb") : ?>
          <li style="padding: 0px">
          <span style="margin-right: <?= $data['padding'] ?>px"><?= $i;?></span>
            <?= $value ?>
          </li>
          <? $i++;?>
        <? else : ?>
          <li style="padding-left: <?= $data['padding'] ?>px">
            <?= $value ?>
          </li>
        <? endif; ?>
      <? endif; ?>
    <? endforeach; ?>
  <? endif; ?>
</ul>
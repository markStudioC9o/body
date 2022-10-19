<div class="row">
  <div class="col-md-6">
    <? if (!empty($data->kontakty)) : ?>
      <? $sortis = json_decode($data->kontakty, true);
      unset($sortis['phone']);
      ?>
      <ul id="treeSortSoc">
        <? foreach ($sortis as $key => $item) : ?>
          <? if (!empty($item)) : ?>
            <li id="<?= $key ?>" value="<?= $item?>"><div><?= $key ?></div><sub><?= $item ?></sub> <span class="addTab">Добавить отступ</span></li>
          <? endif; ?>
        <? endforeach; ?>
      </ul>
    <? endif; ?>
    <a href="#" id="saveSort">Сохранить</a>
  </div>

</div>
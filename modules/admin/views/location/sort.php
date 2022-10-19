<div class="row">
  <div class="col-md-6">
    <ul id="treeSortSoc">
      <? if (!empty($array)) : ?>
        <? foreach ($array as $key => $val) : ?>
          <li <?= (isset($val['value']) && !empty($val['value']) ? "class=\"prytir\" data-value=\"promt\"" : "") ?> id="<?= $val['id'] ?>" data-resurs="<?= $val['data'] ?>">
            <div><?= $val['id'] ?></div><sub><?= $val['data'] ?></sub>
            <div class="arrbuf">
              <span class="addTab">Добавить отступ</span>
              <span class="removeTab">Удалить отступ</span>
            </div>
          </li>
        <? endforeach; ?>
      <? endif; ?>
      <? if (!empty($sortis)) : ?>
        <? foreach ($sortis as $key => $item) : ?>
          <? if (!empty($item)) : ?>
            <li id="<?= $key ?>" data-resurs="<?= $item ?>">
              <div><?= $key ?></div><sub><?= $item ?></sub>
              <div class="arrbuf">
                <span class="addTab">Добавить отступ</span>
                <span class="removeTab">Удалить отступ</span>
              </div>
            </li>
          <? endif; ?>
        <? endforeach; ?>
      <? endif; ?>
    </ul>
    <a href="#" id="saveSort" data-id="<?= $id ?>">Сохранить</a>
  </div>
</div>
<? if (!empty($lang)) : ?>
  </ul>
  <? foreach ($lang as $item) : ?>
    <li class="nav-item">
      <a class="nav-link" href="#"><?= $item->name ?></a>
    </li>
  <? endforeach; ?>
  <ul class="nav nav-pills">
  <? endif; ?>
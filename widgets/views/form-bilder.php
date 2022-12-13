<? if (!empty($model)) : ?>
  <div class="abbred-form">
    <ul class="form_list_item">
      <? foreach ($model as $item) : ?>
        <li data-id="<?= $item->id ?>" class="app-form"><?= $item->name ?></li>
      <? endforeach; ?>
      <li class="end-form app-form">
        Закрыть форму
      </li>
    </ul>
  </div>
<? endif; ?>
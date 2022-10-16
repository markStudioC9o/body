<div class="row bor">
  <? $type = rand(0, 999); ?>
  <input type="hidden" class="rand-s" value="<?= $type ?>">
  <div class="col-md-8 mt-1">
    <input type="text" name="footer[<?= $pos; ?>][<?= $type; ?>][head][text]" class="form-control" placeholder="Текст ссылки заголовка" required>
  </div>
  <div class="col-md-1 mt-1">
    <span>
      <i class="fa fa-trash" aria-hidden="true"></i>
    </span>
  </div>
  <div class="col-md-8 mt-1">
    <input type="text" name="footer[<?= $pos; ?>][<?= $type; ?>][head][link]" class="form-control" placeholder="Адресс ссылки заголовка" required>
  </div>
  <div class="col-md-4 mt-1">
  </div>
  <div class="col-md-2 mt-1">
    <input type="color" value="#00a6ca" name="footer[<?= $pos; ?>][<?= $type; ?>][head][color]">
  </div>
  <div class="col-md-3 mt-1">
    <input type="number" class="form-control" value="18" steep="1" min="1" max="40" name="footer[<?= $pos; ?>][<?= $type; ?>][head][size]">
  </div>
  <div class="col-md-4 mt-1">
    <select name="footer[<?= $pos; ?>][<?= $type; ?>][head][weight]" class="form-control">
      <option value="400">400</option>
      <option value="500">500</option>
      <option value="600">600</option>
      <option value="700" selected>700</option>
    </select>
  </div>
</div>
<span class="add-link-block" data-pos="<?= $pos; ?>" data-type="<?= $type ?>">
  <i class="fa fa-plus" aria-hidden="true"></i> Простая ссылка 
</span>
</div>
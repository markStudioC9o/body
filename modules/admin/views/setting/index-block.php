<div class="row">
  <? $add = rand(0, 999); ?>
  <div class="col-md-8 mt-1">
    <input type="text" name="footer[<?= $data['pos'] ?>][<?= $type; ?>][block][<?= $add; ?>][text]" class="form-control" placeholder="Текст ссылки" required>
  </div>
  <div class="col-md-1 mt-1">
    <span>
      <i class="fa fa-trash" aria-hidden="true"></i>
    </span>
  </div>
  <div class="col-md-8 mt-1">
    <input type="text" name="footer[<?= $data['pos'] ?>][<?= $type; ?>][block][<?= $add; ?>][link]" class="form-control" placeholder="Адресс ссылки" required>
  </div>
  <div class="col-md-4 mt-1">
    <span>
      <i class="fa fa-trash" aria-hidden="true"></i>
    </span>
  </div>
  <div class="col-md-2 mt-1">
    <input type="color" value="#000" name="footer[<?= $data['pos'] ?>][<?= $type; ?>][block][<?= $add; ?>][color]">
  </div>
  <div class="col-md-3 mt-1">
    <input type="number" class="form-control" value="14" steep="1" min="1" max="40" name="footer[<?= $data['pos'] ?>][<?= $type; ?>][block][<?= $add; ?>][size]">
  </div>
  <div class="col-md-4 mt-1">
    <select name="footer[<?= $data['pos'] ?>][<?= $type; ?>][block][<?= $add; ?>][weight]" class="form-control">
      <option value="400">400</option>
      <option value="500">500</option>
      <option value="600">600</option>
      <option value="700">700</option>
    </select>
  </div>
</div>





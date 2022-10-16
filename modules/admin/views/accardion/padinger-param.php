<div class="row">
  <div class="col-md-12 mt-5 mb-5">
    <input type="hidden" value="<?= $data['id']?>" class="paddingerIdtype">
    <label>Отступ</label>
    <input type="number" class="paddingerToper form-control" value="<?= (isset($data['height']) && !empty($data['height'])? $data['height']: '0')?>" min="10" max="999" step="1">
  </div>
</div>
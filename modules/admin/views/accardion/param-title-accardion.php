<div class="row">
  <div class="col-md-12">
    <label for=""> Цвет</label>
    <input type="color" class="inp-title-accardion" data-id="<?= $data['id']?>" data-type="color">  
  </div>
  <div class="col-md-12 mt-2">
    <label for="">Шрифт</label>
    <input type="number" class="form-control inp-title-accardion"
      data-id="<?= $data['id']?>"
      data-type="size"
      value="15"
      step="1"
      min="10"
      max="50"
      >
  </div>
  <div class="col-md-12 mt-2">
  <label for="">Насыщеность</label>
    <select class="form-control inp-title-accardion" data-id="<?= $data['id']?>" data-type="weight">
      <option value="400">400</option>
      <option value="500">500</option>
      <option value="600">600</option>
    </select>
  </div>
</div>
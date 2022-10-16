<div class="row">
  <div class="col-md-12">
    <input type="text" value="<?= $data['id'] ?>" id="idBootm">
  </div>
  <div class="col-md-12">
    <label for="">
      Текст
    </label>
    <input type="text" class="form-control param-boot-text-er text-boot" value="<?= trim($data['text']) ?>" data-type="text">
  </div>
  <div class="col-md-12 mt-3 mb-3">
    <label for="">
      Ссылка
    </label>
    <input type="text" class="form-control param-boot-text-er link-boot" value="<?= trim($data['link']) ?>" data-type="link">
  </div>
  <div class="col-md-12 mt-3 mb-3">
    <label for="">
    <input type="checkbox" class="new-open" data-type="link" <?= (isset($data['checked']) && $data['checked'] == "checked" ? "checked" : "")?>>
     Открывать в новом окне
    </label>
  </div>
  <div class="col-md-4">
    <label for="">
      Цвет фона
    </label>
    <br>
    <input type="color" value="#12c0cc" class="color-boot color-text-boot" data-type="background-color">
  </div>

  <div class="col-md-4">
    <label for="">
      Цвет текста
    </label>
    <br>
    <input type="color" value="#ffffff" class="color-text-boot" data-type="color">
  </div>

  <div class="col-md-4">
    <label for="">
      Цвет обводки
    </label>
    <br>
    <input type="color" value="#ffffff" class="border-color color-text-boot" data-type="border-color">
  </div>

  <div class="col-md-4 mt-3">
    <label for="">
      Размер шрифта
    </label>
    <input type="number"  data-type="font-size" class="form-control font-boot text-boot" value="<?= (isset($data['output']['font-size']) && !empty($data['output']['font-size']) ? preg_replace('~\D+~', '', $data['output']['font-size']) : '18') ?>" max="50" min="5" step="1">
  </div>
  <div class="col-md-4 mt-3">
    <label for="">
      Толщина обводки
    </label>
    <input type="number" data-type="border" class="form-control font-boot text-boot" value="<?= (isset($data['output']['border-width']) && !empty($data['output']['border-width']) ? preg_replace('~\D+~', '', $data['output']['border-width']) : '0') ?>" max="50" min="0" step="1">
  </div>
  <div class="col-md-4 mt-3">
    <label for="">
      Радиус
    </label>
    <input type="number" data-type="border-radius" class="form-control font-boot text-redius" value="<?= (isset($data['output']['border-radius']) && !empty($data['output']['border-radius']) ? preg_replace('~\D+~', '', $data['output']['border-radius']) : '0') ?>" max="50" min="0" step="1">
  </div>

  <div class="col-md-12">
    <?= $this->render('../articles/param-padding', ['type' => 'bottn', 'id' =>$data['id'], 'output' => $data['output']]) ?>
  </div>

  <div class="col-md-12">
    <label for="">
      Позиционирование
    </label>
    <ul class="nav nav-pills boot-position">
      <li class="lirt-left nav-item">
        <div class="nav-link" data-pos="left">
          <i class="fa fa-align-left" aria-hidden="true"></i>
        </div>
      </li>
      <li class="lirt-center nav-item">
        <div class="nav-link" data-pos="center">
          <i class="fa fa-align-center" aria-hidden="true"></i>
        </div>
      </li>
      <li class="lirt-right nav-item">
        <div class="nav-link" data-pos="right">
          <i class="fa fa-align-right" aria-hidden="true"></i>
        </div>
      </li>
    </ul>
  </div>
  <div class="col-md-12">
    <label for="">Насыщеность</label>
    <select class="form-control text-boot font-weight">
      <option value="400" <?= (isset($data['output']['font-weight']) && !empty($data['output']['font-weight']) && $data['output']['font-weight'] == '400' ? 'selected' : '') ?>>400</option>
      <option value="500" <?= (isset($data['output']['font-weight']) && !empty($data['output']['font-weight']) && $data['output']['font-weight'] == '500' ? 'selected' : '') ?>>500</option>
      <option value="600" <?= (isset($data['output']['font-weight']) && !empty($data['output']['font-weight']) && $data['output']['font-weight'] == '600' ? 'selected' : '') ?>>600</option>
    </select>
  </div>
</div>
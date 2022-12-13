<ul class="tool-sf" id="tool-sf-<?= $id ?>" role="toolbar">
  <li><a href="#" class="re-icon lac re-bold" rel="bold" role="button" aria-label="Полужирный" data-reb="<?= $id ?>"></a></li>
  <li><a href="#" class="re-icon lac re-italic" rel="italic" role="button" aria-label="Наклонный" data-reb="<?= $id ?>"></a></li>
  <li><a href="#" class="re-icon lac re-deleted" rel="deleted" role="button" aria-label="Зачеркнутый" data-reb="<?= $id ?>"></a></li>
  <li><a href="#" class="re-icon lac re-underline" rel="underline" role="button" aria-label="Подчеркнутый" data-reb="<?= $id ?>"></a></li>
  <li><a href="#" class="re-icon lac re-link" rel="link" role="button" aria-label="ссылка" data-reb="<?= $id ?>"></a></li>
  <li><a href="#" class="re-icon lac fa fa-unlink" rel="unlink" role="button" aria-label="ссылка" data-reb="<?= $id ?>"></a></li>
  <li style="position: relative;"><a href="#" class="re-icon lac re-alignment" rel="alignment" role="button" aria-label="Выравнивание" tabindex="-1" aria-haspopup="true" data-reb="<?= $id ?>"></a>
    <div class="redactor-dropdown custom-redactor edactor-dropdown-box-alignment" style="display:none">
      <a href="#" class="" role="button" data-type="left" data-reb="<?= $id ?>">По левому краю</a>
      <a href="#" class="" role="button" data-type="center" data-reb="<?= $id ?>">По центру</a>
      <a href="#" class="" role="button" data-type="right" data-reb="<?= $id ?>">По правому краю</a>
      <a href="#" class="" role="button" data-type="justify" data-reb="<?= $id ?>">Выровнять текст по ширине</a>
    </div>
  </li>
  <!-- //toolbar-unlink fas fa-unlink -->
  <!-- <li class="input-srif">
  <input type="text" class="form-link" data-reb="<? //= $id
                                                  ?>">
  </li> -->
  <li class="input-srif">
    <!-- <span>Fs</span> <input type="number" value="18" step="1" min="0" max="99" class="form-tip" data-reb="<? //= $id 
                                                                                                              ?>"> -->
    <select class="toolbar-size form-tip" data-reb="<?= $id?>">
      <option selected="selected" disabled="disabled">Размер</option>
      <option value="10">10px</option>
      <option value="12">12px</option>
      <option value="14">14px</option>
      <option value="16">16px</option>
      <option value="18">18px</option>
      <option value="20">20px</option>
      <option value="22">22px</option>
      <option value="24">24px</option>
      <option value="26">26px</option>
      <option value="26">26px</option>
      <option value="30">30px</option>
      <option value="45">45px</option>
    </select>
  </li>


  <li class="input-srif">
    <span>Lh</span> <input type="number" value="18" step="1" min="0" max="99" class="lh-tip" data-reb="<?= $id ?>">
  </li>
  <li class="input-srif">
    <select id="wight-param" data-reb="<?= $id ?>">
      <option value="300">300</option>
      <option value="400">400</option>
      <option value="500">500</option>
      <option value="600">600</option>
      <option value="700">700</option>
      <option value="800">800</option>
    </select>
  </li>
  <li class="input-srif">
    <span>Цвет</span>
    <input class="toolbar-color" type="color" value="#ff0000">
  </li>
  <li class="input-srif">
    <span>Фон</span> <input class="toolbar-bg" type="color" value="#ffff00">
  </li>
  <li class="input-srif">
    <input type="number" value="10" step="1" min="0" max="99" class="lh-gap" data-reb="<?= $id ?>">
  </li>
</ul>
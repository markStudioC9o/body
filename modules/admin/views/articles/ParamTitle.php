<div class="row">
  <? if (isset($data['output']) && !empty($data['output'])) {
    $output = $data['output'];
  } else {
    $output = '';
  } ?>
  <!-- 

margin-bottom
margin-left
margin-right
margin-top -->
  <input type="hidden" id="paramIdOp" value="<?= $id ?>">
  <div class="col-md-12 mt-2">
    <label for="">Тип шаблона</label>
    <select id="templateTitle" class="form-control">
      <option value="inliner">С полосой</option>
      <option value="notliner">Без полосы</option>
    </select>
  </div>
  <div class="col-md-12 mt-2">
    <label for="">Межстрочный интервал (px)</label>
    <input type="number" class="form-control" value="<?= (isset($output['line-height']) && !empty($output['line-height']) ? preg_replace('~\D+~','', trim((int) $output['line-height'])) : '46') ?>" min="0" step="1" max="999" id="line-height-param">
  </div>
  <div class="col-md-12 mt-2">
    <label for="">Размер Шрифта (px)</label>
    <input type="number" class="form-control" value="<?= (isset($output['font-size']) && !empty($output['font-size']) ? preg_replace('~\D+~', '', trim($output['font-size'])) : '38') ?>" min="0" step="1" max="999" id="title-fonts-param">
  </div>
  <div class="col-md-3 mt-2">
    <label for=""> Цвет</label>
    <?
    if (isset($output['color']) && !empty($output['color'])) {
      preg_match('#\((.*?)\)#', $output['color'], $match);
      if (isset($match) && isset($match[1]) && !empty($match[1])) {
        $color = $match[1];
        $colArray = explode(",", $color);
        if (isset($colArray[3]) && !empty($colArray[3])) {
          $alpha = $colArray[3];
        } else {
          $alpha = null;
        }
        function rgbToHex($red, $green, $blue, $alpha = null)
        {
          $result = '#';
          foreach (array($red, $green, $blue) as $row) {
            $result .= str_pad(dechex($row), 2, '0', STR_PAD_LEFT);
          }
          if (!is_null($alpha)) {
            $alpha = floor(255 - (255 * ($alpha / 127)));
            $result .= str_pad(dechex($alpha), 2, '0', STR_PAD_LEFT);
          }
          return $result;
        }
        $valColor = rgbToHex($colArray[0], $colArray[1], $colArray[2], $alpha);
      } else {
        $valColor = '#00a6ca';
      }
    } else {
      $valColor = '#00a6ca';
    }
    ?>
    <input type="color" value="<?= $valColor ?>" id="colorTitH1">
  </div>
  <div class="col-md-6 mt-2">
    <ul class="nav nav-pills" id="ul-title-align">
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
  <div class="col-md-12 mt-2">
    <label for="">Насыщеность</label>
    <? $arrayWeght = array('200', '400', '500', '600') ?>
    <select id="fontWeightTitle" class="form-control">
      <? foreach ($arrayWeght as $item => $letr) : ?>
        <option value="<?= $letr ?>" <?= (isset($output['font-weight']) && !empty($output['font-weight']) && $output['font-weight'] == $letr ? 'selected' : '') ?>><?= $letr ?></option>
      <? endforeach; ?>
    </select>
  </div>
  <div class="col-md-12 mt-2">
    <label for=""> Отступы внешние (px)</label>
    <div class="margin-param-title">
      <input type="number" id="mTop" min="0" step="1" max="999" value="<?= (isset($output['margin-top']) && !empty($output['margin-top']) ? preg_replace('/[^0-9]/', '', $output['margin-top']) : '20') ?>" class="varibleMar" data-type="margin-top">
      <input type="number" id="mRight" min="0" step="1" max="999" value="<?= (isset($output['margin-right']) && !empty($output['margin-right']) ? preg_replace('/[^0-9]/', '', $output['margin-right']) : '0') ?>" class="varibleMar" data-type="margin-right">
      <input type="number" id="mBottom" min="0" step="1" max="999" value="<?= (isset($output['margin-bottom']) && !empty($output['margin-bottom']) ? preg_replace('/[^0-9]/', '', $output['margin-bottom']) : '20') ?>" class="varibleMar" data-type="margin-bottom">
      <input type="number" id="mLeft" min="0" step="1" max="999" value="<?= (isset($output['margin-left']) && !empty($output['margin-left']) ? preg_replace('/[^0-9]/', '', $output['margin-left']) : '0') ?>" class="varibleMar" data-type="margin-left">
      <div class="arr" style="position: absolute;top: 0;right: 0;left: 0;bottom: 0;margin: auto;width: 16px;height: 16px;">
        <i class="fa fa-arrows" aria-hidden="true"></i>
      </div>
    </div>
  </div>
</div>
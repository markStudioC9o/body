<?

use yii\helpers\Html;


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
?>

<?
if (isset($data['output']['background-color']) && !empty($data['output']['background-color'])) {
  preg_match('#\((.*?)\)#', $data['output']['background-color'], $match);
  if (isset($match) && isset($match[1]) && !empty($match[1])) {
    $color = $match[1];
    $colArray = explode(",", $color);
    if (isset($colArray[3]) && !empty($colArray[3])) {
      $alpha = $colArray[3];
    } else {
      $alpha = null;
    }
    $valBackground = rgbToHex($colArray[0], $colArray[1], $colArray[2], $alpha);
  } else {
    $valBackground = '#00a6ca';
  }
} else {
  $valBackground = '#00a6ca';
}
if (isset($data['output']['color']) && !empty($data['output']['color'])) {
  preg_match('#\((.*?)\)#', $data['output']['color'], $match);
  if (isset($match) && isset($match[1]) && !empty($match[1])) {
    $color = $match[1];
    $colArray = explode(",", $color);
    if (isset($colArray[3]) && !empty($colArray[3])) {
      $alpha = $colArray[3];
    } else {
      $alpha = null;
    }
    $valColor = rgbToHex($colArray[0], $colArray[1], $colArray[2], $alpha);
  } else {
    $valColor = '#00a6ca';
  }
} else {
  $valColor = '#00a6ca';
}
?>

<? function RadsSetter($data)
{
  if (isset($data['output']['border-radius']) && !empty($data['output']['border-radius'])) {
    $param = (int)round((preg_replace('~\D+~', '', trim($data['output']['border-radius']))));
    return $param;
  } else {
    return "0";
  }
} ?>
<div class="text-block-parametrs">
  <div class="row">
    <!-- <div class="col-md-12 mt-2"> -->
    <!-- <ul class="redactor-toolbar" id="redactor-toolbar-<? //= $id 
                                                            ?>" role="toolbar" style="position: relative; width: auto; top: 0px; left: 0px; visibility: visible;">
        <li><a href="#" class="re-icon lac re-bold" rel="bold" role="button" aria-label="Полужирный" data-reb="<? //= $id 
                                                                                                                ?>"></a></li>
        <li><a href="#" class="re-icon lac re-italic" rel="italic" role="button" aria-label="Наклонный" data-reb="<? //= $id 
                                                                                                                  ?>"></a></li>
        <li><a href="#" class="re-icon lac re-deleted" rel="deleted" role="button" aria-label="Зачеркнутый" data-reb="<? //= $id 
                                                                                                                      ?>"></a></li>
        <li><a href="#" class="re-icon lac re-underline" rel="underline" role="button" aria-label="Подчеркнутый" data-reb="<? //= $id 
                                                                                                                            ?>"></a></li>
        <li><a href="#" class="re-icon lac re-link" rel="link" role="button" aria-label="ссылка" data-reb="<? //= $id 
                                                                                                            ?>"></a></li> -->
    <!-- <li class="input-srif">
          <span>Цвет</span> <input class="toolbar-color" type="color" value="#ff0000">
        </li> -->
    <!-- <li class="input-srif">
          <span>Фон</span> <input class="toolbar-bg" type="color" value="#ffff00">
        </li> -->
    <!-- </ul> -->
    <!-- </div> -->
    <!-- <div class="col-md-12 mt-3">
      <input type="text" class="link-text form-control" placeholder="url">
    </div> -->
    <!-- <div class="col-md-12 mt-3">
      <label for="">
        <input type="checkbox" id="openNewWindow" checked>
        Открывать в новом окне
      </label>
    </div> -->
    <!-- <div class="col-md-4 mt-3">
      <label for="">Шрифта</label>
      <input type="number" class="form-control sizen-text" data-tag="<? //= $id 
                                                                      ?>" value="<? //= (isset($data['output']['font-size']) && !empty($data['output']['font-size']) ? preg_replace('~\D+~', '', $data['output']['font-size']) : '18') 
                                                                                  ?>" max="50" min="5" step="1">
    </div> -->
    <!-- <div class="col-md-4 mt-3">
      <label for="">Интервал</label>

      <input type="number" class="form-control line-height-text-block" data-tag="<? //= $id 
                                                                                  ?>" value="<? //= (isset($data['output']['line-height']) && !empty($data['output']['line-height']) ? preg_replace('~\D+~', '', (int)$data['output']['line-height']) : '25') 
                                                                                              ?>" max="50" min="5" step="1">
    </div> -->
    <!-- <div class="col-md-4 mt-3">
      <label for="">Насыщеность</label>
      <select class="form-control widght-text" data-tag="<?= $id ?>">
        <option value="300" <? //= (isset($data['output']['font-weight']) && !empty($data['output']['font-weight']) && $data['output']['font-weight'] == '300' ? 'selected' : '') 
                            ?>>300</option>
        <option value="400" <? //= (isset($data['output']['font-weight']) && !empty($data['output']['font-weight']) && $data['output']['font-weight'] == '400' ? 'selected' : '') 
                            ?>>400</option>
        <option value="500" <? //= (isset($data['output']['font-weight']) && !empty($data['output']['font-weight']) && $data['output']['font-weight'] == '500' ? 'selected' : '') 
                            ?>>500</option>
        <option value="600" <? //= (isset($data['output']['font-weight']) && !empty($data['output']['font-weight']) && $data['output']['font-weight'] == '600' ? 'selected' : '') 
                            ?>>600</option>
      </select>
    </div> -->
    <div class="col-md-12 mt-3">
      <label for="">Параметры оформления</label>
      <select id="paramSelectText" class="form-control" data-id="<?= $id ?>">
        <option value="default">По умолчанию</option>
        <option value="border">Рамка</option>
        <option value="color">Цвет</option>
        <option value="colorBorder">Цвет + Рамка</option>
      </select>
    </div>
    <div class="col-md-12 quote" style="display:none">
      <div class="row">
        <div class="col-md-12">
          <label for="">Заголовок</label>
          <input type="text" class="form-control">
        </div>
        <div class="col-md-12">
          <label for="">Цвет</label>
          <input type="color" value="" id="" class="" data-id="">
        </div>
        <div class="col-md-12">
          <?= Html::submitButton('Иконка', ['class' => 'btn btn-success']) ?>
        </div>
        <div class="col-md-12">
          <label for="">Положение</label>
        </div>
      </div>
    </div>
    <div class="col-md-12 mt-2 mb-5 color_sizes prm_off" style="display:none">
      <div class="row">
        <div class="col-md-12 mt-4">
          <label for=""> Цвет Фона</label>
          <input type="color" value="<?= $valBackground ?>" id="colorText_<?= $id ?>" class="color-param bg" data-id="<?= $id ?>">
        </div>
        <div class="col-md-12 mt-4">
          <label for=""> Цвет Текста</label>
          <input type="color" value="<?= $valColor ?>" id="colorMainText_<?= $id ?>" class="color-param tx" data-id="<?= $id ?>">
        </div>
      </div>
    </div>
    <div class="col-md-12 mt-2 mb-5 border_sizes prm_off" style="display:none">
      <div class="row">
        <div class="col-md-12 mt-4">
          <label for=""> Цвет Рамки</label>
          <?
          if (isset($data['output']['border-color']) && !empty($data['output']['border-color'])) {
            preg_match('#\((.*?)\)#', $data['output']['border-color'], $match);
            if (isset($match) && isset($match[1]) && !empty($match[1])) {
              $color = $match[1];
              $colArray = explode(",", $color);
              if (isset($colArray[3]) && !empty($colArray[3])) {
                $alpha = $colArray[3];
              } else {
                $alpha = null;
              }
              $valColorBorder = rgbToHex($colArray[0], $colArray[1], $colArray[2], $alpha);
            } else {
              $valColorBorder = '#00a6ca';
            }
          } else {
            $valColorBorder = '#00a6ca';
          }
          ?>
          <input type="color" value="<?= $valColorBorder ?>" id="colorBorder_<?= $id ?>" class="border-param color-param-text" data-id="<?= $id ?>">
        </div>
        <div class="col-md-12 mt-4">
          <label for="">Радиус</label>
          <input type="number" value="<?= RadsSetter($data) ?>" id="radiusMainText_<?= $id ?>" class="set-border-rad rudius-param form-control" data-id="<?= $id ?>" data-type="border-radius">
        </div>
        <div class="col-md-12 mt-4">
          <label for="">Толщина рамки (px):</label>
          <? function Setter($data, $pos)
          {
            if (isset($data['output']['border-' . $pos . '-width']) && !empty($data['output']['border-' . $pos . '-width'])) {
              $param = (int)round((preg_replace('~\D+~', '', trim($data['output']['border-' . $pos . '-width']))));
              return $param;
            } else {
              return "3";
            }
          } ?>
          <div class="row">
            <div class="offset-md-4 col-md-4">
              <input type="number" id="sizeBorder_top_<?= $id ?>" class="border-param def-et form-control" data-id="<?= $id ?>" data-pos="top" value="<?= Setter($data, "top") ?>" max="15" min="0" step="1">
            </div>
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
              <input type="number" id="sizeBorder_left_<?= $id ?>" class="border-param def-et form-control" data-id="<?= $id ?>" data-pos="left" value="<?= Setter($data, "left") ?>" max="15" min="0" step="1">
            </div>
            <div class="offset-md-4 col-md-4">
              <input type="number" id="sizeBorder_right_<?= $id ?>" class="border-param def-et form-control" data-id="<?= $id ?>" data-pos="right" value="<?= Setter($data, "right") ?>" max="15" min="0" step="1">
            </div>
            <div class="offset-md-4 col-md-4">
              <input type="number" id="sizeBorder_bottom_<?= $id ?>" class="border-param def-et form-control" data-id="<?= $id ?>" data-pos="bottom" value="<?= Setter($data, "bottom") ?>" max="15" min="0" step="1">
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-12 mt-2 mb-5 colorBorder_sizes prm_off" style="display:none">
      <div class="row">
        <div class="col-md-12 mt-4">
          <label for=""> Цвет Рамки</label>
          <input type="color" value="<?= $valColorBorder ?>" id="colorSetBorder_<?= $id ?>" class="set-border-color border-param" data-id="<?= $id ?>" data-type="border-color">
        </div>
        <div class="col-md-12 mt-4">
          <label for="">Толщина</label>
          <input type="number" value="<?= Setter($data, "top") ?>" id="sizeSetBorder_<?= $id ?>" class="set-border-color border-param form-control" data-id="<?= $id ?>" data-type="border-width">
        </div>
        <div class="col-md-12 mt-4">
          <label for=""> Цвет Фона</label>
          <input type="color" value="<?= $valBackground ?>" id="colorSetText_<?= $id ?>" class="set-border-color color-param" data-id="<?= $id ?>" data-type="background-color">
        </div>
        <div class="col-md-12 mt-4">
          <label for=""> Цвет Текста</label>
          <input type="color" value="<?= $valColor ?>" id="colorSetMainText_<?= $id ?>" class="set-border-color color-param" data-id="<?= $id ?>" data-type="color">
        </div>
        <div class="col-md-12 mt-4">
          <label for="">Радиус</label>
          <input type="number" value="<?= RadsSetter($data) ?>" id="radiusMainText_<?= $id ?>" class="set-border-rad rudius-param form-control" data-id="<?= $id ?>" data-type="border-radius">
        </div>
      </div>
    </div>
    <? if (isset($data['output']) && !empty($data['output'])) {
      $output = $data['output'];
    } else {
      $output = '';
    } ?>
    <?= $this->render('../articles/param-margin', ['type' => 'text', 'id' => $id, 'output' => $output]) ?>
    <?= $this->render('../articles/param-padding', ['type' => 'text', 'id' => $id, 'output' => $output]) ?>
  </div>
</div>
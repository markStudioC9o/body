<div class="row">
  <div class="col-md-12">
    <input type="text" value="<?= $data['id']?>" id="idLine">
  </div>
  <div class="col-md-12">
    <label for="">Цвет полосы</label>
    <br>
    <?
    if (isset($data["output"]['background-color']) && !empty($data["output"]['background-color'])) {
      preg_match('#\((.*?)\)#', $data["output"]['background-color'], $match);
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
    <input type="color" class="color-liner" value="<?= $valColor?>">
  </div>
</div>
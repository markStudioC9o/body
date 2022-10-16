<? if (isset($id)) {
    $tarId = $id;
  } else {
    $tarId = '';
  } ?>
  <label style="width: 100%;text-align: center;">Внешние</label>
  <div class="margin-param-title" id="list-margin-input">
    <? $array = array(
      [
        "inputMsT",
        "margin-top",
      ],
      [
        "inputMsR",
        "margin-right"
      ],
      [
        "inputMsB",
        "margin-bottom"
      ],
      [
        "inputMsL", "margin-left"
      ]
    ); ?>
    <? foreach ($array as $item => $value) : ?>
      <?
      if (isset($output) && !empty($output)) {
        $val = round((int)$output[$value[1]]);
      } else {
        if (isset($def)) {
          $val = $def;
        } else {
          $val = 0;
        }
      }
      ?>
      <input type="number" min="0" step="1" max="999" value="<?= $val ?>" class="<?= $value['0'] ?>" data-type="<?= $value['1'] ?>" data-param="<?= $type ?>" data-id=<?= $tarId ?>>
    <? endforeach; ?>
    <div class="arr" style="position: absolute;top: 0;right: 0;left: 0;bottom: 0;margin: auto;width: 16px;height: 16px;">
      <i class="fa fa-arrows" aria-hidden="true"></i>
    </div>
  </div>
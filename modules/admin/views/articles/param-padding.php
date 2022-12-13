<div class="col-md-6 mt-2">
  <? if (isset($id)) {
    $tarId = $id;
  } else {
    $tarId = '';
  } ?>
  <label style="width: 100%;text-align: center;">Внутренние</label>
  <div class="margin-param-title" id="list-padding-input">
    <? $array = array(
      [
        "inputMsT",
        "padding-top",
      ],
      [
        "inputMsR",
        "padding-right"
      ],
      [
        "inputMsB",
        "padding-bottom"
      ],
      [
        "inputMsL",
        "padding-left"
      ]
    ); ?>
    <? foreach ($array as $item => $value) : ?>
      <?
      if (isset($output) && !empty($output)) {
        $val = preg_replace('/[^0-9]/', '', $output[$value[1]]);
      } else {
        if (isset($def)) {
          $val = $def;
        } else {
          $val = 0;
        }
      }
      ?>
      <input type="number" min="0" step="1" max="999" value="<?= $val?>" class="<?= $value['0'] ?>" data-type="<?= $value['1'] ?>" data-param="<?= $type ?>" data-id=<?= $tarId ?>>
    <? endforeach; ?>
    <div class="arr" style="position: absolute;top: 0;right: 0;left: 0;bottom: 0;margin: auto;width: 16px;height: 16px;">
      <i class="fa fa-arrows" aria-hidden="true"></i>
    </div>
  </div>
</div>
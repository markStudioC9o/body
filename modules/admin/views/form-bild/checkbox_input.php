<div class="for-block checkbox-field">
  <div class="wilder1">
    <label for="input-param-gen" class="fields-label"><?= $ress['name_input'] ?><?= (isset($ress['reqerd']) && !empty($ress['reqerd']) ? '*' : '') ?></label>
    <? if (!empty($sub)) : ?>
      <div class="sub">
        <p>
          <?= $sub; ?>
        </p>
      </div>
    <? endif; ?>
  </div>
  <div class="wilder">
    <? foreach ($ress as $key => $elem) : ?>
      <? if (strpos($key, 'param') !== false) : ?>
        <label class="labelChekbox">
          <input type="checkbox" value="<?= $elem ?>" name="<?= $name ?>[<?= $elem ?>]">
          <?= $elem ?>
        </label>
      <? endif; ?>
    <? endforeach; ?>
  </div>
</div>
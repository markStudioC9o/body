<div class="for-block select-field">
  <div class="wilder1">
    <label for="input-param-gen" class="inputSelect"><?= $ress['name_input'] ?><?= (isset($ress['reqerd']) && !empty($ress['reqerd']) ? '*' : '') ?></label>
    <? if (!empty($sub)) : ?>
      <div class="sub">
        <p>
          <?= $sub; ?>
        </p>
      </div>
    <? endif; ?>
  </div>
  <div class="wilder">
    <select name="<?= $name ?>" id="asd" class="form-control">
      <? foreach ($ress as $key => $elem) : ?>
        <? if (strpos($key, 'param') !== false) : ?>
          <option value="<?= $elem ?>"><?= $elem ?></option>
        <? endif; ?>
      <? endforeach; ?>
    </select>
  </div>
</div>
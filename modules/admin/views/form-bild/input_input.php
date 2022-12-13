<div class="for-block radio-field">
  <div class="wilder1">
    <label for="input-param-gen" class="labelInput"><?= $ress['name_input'] ?><?= (isset($ress['reqerd']) && !empty($ress['reqerd']) ? '*' : '')?></label>
    <? if (!empty($sub)) : ?>
      <div class="sub">
        <p>
          <?= $sub; ?>
        </p>
      </div>
    <? endif; ?>
  </div>
  <div class="wilder">
    <input type="text" name="<?= $name ?>" id="<?= $name ?>" class="form-control">
  </div>
</div>


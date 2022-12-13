<div class="for-block radio-field">
  <div class="wilder1">
    <label for="input-param-gen" class="labelTextarea"><?= $ress['name_input'] ?><?= (isset($ress['reqerd']) && !empty($ress['reqerd']) ? '*' : '')?></label>
    <? if (!empty($sub)) : ?>
      <div class="sub">
        <p>
          <?= $sub; ?>
        </p>
      </div>
    <? endif; ?>
  </div>
  <div class="wilder">
      <textarea name="<?= $name ?>" id="<?= $name ?>" style="width: 100%;height: 110px;"></textarea>
  </div>
</div>
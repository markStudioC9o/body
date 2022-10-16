<div class="for-block radio-field">
  <div class="wilder1">
    <label for="input-param-gen"><?= $ress['name_input'] ?><?= (isset($ress['reqerd']) && !empty($ress['reqerd']) ? '*' : '')?></label>
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
        <label for="" class="labelRadio">
          <input type="radio" value="<?= $elem ?>" name="<?= $name ?>">
          <?= $elem ?>
        </label>
      <? endif; ?>
    <? endforeach; ?>
  </div>
</div>
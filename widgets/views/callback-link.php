<div class="bb-arw-card__links">
  <? $maxer = json_decode($result['link'], true) ?>
  <? if (isset($maxer['link1'])) : ?>
    <a class="bb-arw-card__link" href="<?= (isset($maxer['link1']['url']) && !empty($maxer['link1']['url']) ? $maxer['link1']['url'] : "") ?>">
      <?= (isset($maxer['link1']['name']) && !empty($maxer['link1']['name']) ? $maxer['link1']['name'] : '') ?>
    </a>
  <? endif; ?>
  <? if (isset($maxer['link2'])) : ?>
    <a class="bb-arw-card__link" href="<?= (isset($maxer['link2']['url']) && !empty($maxer['link2']['url']) ? $maxer['link2']['url'] : "") ?>">
    <?= (isset($maxer['link2']['name']) && !empty($maxer['link2']['name']) ? $maxer['link2']['name'] : '') ?>
  </a>
  <? endif; ?>
</div>
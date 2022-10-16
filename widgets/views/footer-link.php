<? if (isset($link['value']) && !empty($link['value'])) : ?>
  <? $res = json_decode($link['value'], true); ?>
  <div class="column right-link">
    <div class="fb-wrap">
    <ul id="pervaya-kolonka-ru" class="fb2_menu menu">
      <? if (isset($res['left']) && !empty($res['left'])) : ?>
        <? foreach ($res['left'] as $elem) : ?>
          <li>
            <ul>
          <? if (isset($elem['head']) && !empty($elem['head'])) : ?>
            <li>
              <a href="<?= $elem['head']['link'] ?>" class="hd" style="
                font-size:<?= $elem['head']['size'] ?>px;
                color: <?= $elem['head']['color'] ?>;
                font-weight: <?= $elem['head']['weight'] ?>;">
                <?= $elem['head']['text'] ?>
              </a>
            </li>
          <? endif; ?>
          <? if (isset($elem['block']) && !empty($elem['block'])) : ?>
            <? foreach ($elem['block'] as $item) : ?>
              <li>
                <a href="<?= $item['link'] ?>" style="
                font-size:<?= $item['size'] ?>px;
                color: <?= $item['color'] ?>;
                  font-weight: <?= $item['weight'] ?>;">
                  <?= $item['text'] ?>
                </a>
              </li>
            <? endforeach; ?>
          <? endif; ?>
          </ul>
          </li>
        <? endforeach; ?>
      <? endif; ?>
    </ul>
    </div>
    <div class="fb-wrap">
    <ul id="vtoraya-kolonka-ru" class="fb2_menu menu">
    <? if (isset($res['right']) && !empty($res['right'])) : ?>
        <? foreach ($res['right'] as $elem) : ?>
          <li>
            <ul>

            
          <? if (isset($elem['head']) && !empty($elem['head'])) : ?>
            <li>
              <a href="<?= $elem['head']['link'] ?>" class="hd" style="
                font-size:<?= $elem['head']['size'] ?>px;
                color: <?= $elem['head']['color'] ?>;
                font-weight: <?= $elem['head']['weight'] ?>;">
                <?= $elem['head']['text'] ?>
              </a>
            </li>
          <? endif; ?>
          <? if (isset($elem['block']) && !empty($elem['block'])) : ?>
            <? foreach ($elem['block'] as $item) : ?>
              <li>
                <a href="<?= (isset($item['link']) ? $item['link'] : "") ?>" style="
                font-size:<?= (isset($item['size']) ? $item['size'] :"" ) ?>px;
                color: <?= (isset($item['color']) ? $item['color'] : "") ?>;
                  font-weight: <?= (isset($item['weight']) ? $item['weight'] : "") ?>;">
                  <?= (isset($item['text']) ? $item['text'] : "") ?>
                </a>
              </li>
            <? endforeach; ?>
          <? endif; ?>
          </ul>
          </li>
        <? endforeach; ?>
      <? endif; ?>
    </ul>
    </div>
  </div>
<? endif; ?>
<?

use yii\helpers\ArrayHelper;
?>
<div class="widget-calcbac">
  <section class="bb-arw-card gert">
    <div class="btn-cls-svg">
      <img src="/vidget/iocn/call_button.svg" alt="">
    </div>
    <div class="over-block">
      <div class="bb-arw-card__header">
        <? if (isset($mapOption['fir-tit']) && !empty($mapOption['fir-tit'])) : ?>
          <h2 class="bb-arw-card__headline">
            <?= $mapOption['fir-tit'] ?>
          </h2>
        <? endif; ?>
        <? if (isset($mapOption['step-tit']) && !empty($mapOption['step-tit'])) : ?>
          <h3 class="bb-arw-card__subline">
            <?= $mapOption['step-tit'] ?>
          </h3>
        <? endif; ?>
      </div>

      <? if (!empty($model)) : ?>
        <nav class="bb-arw-tabs bb-arw-card__tabs">
          <? foreach ($model as $item) : ?>
            <button class="bb-arw-tabs__tab" data-id="tab-<?= (isset($item->parent_id) && !empty($item->parent_id) ? $item->parent_id : $item->id) ?>" id="tabs-<?= (isset($item->parent_id) && !empty($item->parent_id) ? $item->parent_id : $item->id) ?>">
              <?= $item->name ?>
            </button>
          <? endforeach; ?>
        </nav>
      <? endif; ?>
      <? if (!empty($field)) : ?>
        <? foreach ($field as $item => $elem) : ?>
          <? $parametr = null; ?>
          <? if (isset($arrayParam[$item]) && !empty($arrayParam[$item])) {
            $parametr = $arrayParam[$item];
          }
          if (isset($parametr) && !empty($parametr)) {
            $result = array_reduce($parametr, 'array_merge', array());
          }
          ?>
          <form class="bb-arw-card__form" id="tab-<?= $item ?>" actions="#">
            <? if (isset($result['img']) && !empty($result['img'])) : ?>
              <img class="bb-arw-card__banner" src="/callback/<?= $result['img']; ?>">
            <? endif; ?>
            <? if (isset($result['pos_linker']) && $result['pos_linker'] == 'start') : ?>
              <?= $this->render('callback-link', [
                'result' => $result
              ]) ?>
            <? endif; ?>
            <? foreach ($elem as $fie) : ?>
              <? if ($fie['value'] == 'city') : ?>
                <?= $this->render('vid-city', [
                  'param' => $fie
                ]) ?>
              <? endif; ?>
            <? endforeach; ?>
            <? foreach ($elem as $fie) : ?>
              <? if ($fie['value'] != 'city') : ?>
                <label class="bb-arw-input bb-arw-card__field">
                  <input data-id="<?= $fie['id']; ?>" type="<?= ($fie['value'] == "data" ? 'date' : 'text') ?>" class="bb-arw-input__control <?= ($fie['reqared'] == '1') ? "recs" : "" ?>" placeholder="<?= $fie['name'] ?><?= ($fie['reqared'] == '1') ? "*" : "" ?>" name="<?= $fie['value'] ?>" <?= ($fie['value'] == 'phone' ? 'onkeypress="validate(event)"' : '') ?>>
                  <span class="bb-arw-input__placeholder" aria-hidden="true"><?= $fie['name'] ?><?= ($fie['reqared'] == '1') ? "*" : "" ?></span>
                </label>
                <? if (isset($result['pos_linker']) && $result['pos_linker'] == $fie['id']) : ?>
                  <?= $this->render('callback-link', [
                    'result' => $result
                  ]) ?>
                <? endif; ?>
              <? endif; ?>
            <? endforeach; ?>



            <button class="bb-arw-button bb-arw-card__button">
              <? if (isset($btn['value']) && !empty($btn['value'])) : ?>
                <?= $btn['value'] ?>
              <? else : ?>
                Отправить
              <? endif; ?>
            </button>
            <? if (isset($mapOption['parls']) && !empty($mapOption['parls'])) : ?>
              <label class="bb-arw-checkbox bb-arw-card__privacy-policy">
                <div class="block-iner-center">

                  <span class="bb-arw-checkbox__label">
                    <input class="bb-arw-checkbox__control" type="checkbox" checked disabled>
                    <svg class="bb-arw-checkbox__indicator" viewBox="0 0 12 12">
                      <path class="bb-arw-checkbox__checkmark" d="M3 5.47368L5.2 8L9 4" />
                    </svg>
                    <?= $mapOption['parls']; ?>
                  </span>
                </div>
              </label>
            <? endif; ?>

            <? if (isset($result['pos_linker']) && $result['pos_linker'] == 'end') : ?>
              <?= $this->render('callback-link', [
                'result' => $result
              ]) ?>
            <? endif; ?>

          </form>
        <? endforeach; ?>
      <? endif; ?>
      <footer class="bb-arw-social bb-arw-card__footer">
        <h2 class="bb-arw-social__headline">
          <? if (isset($text['value']) && !empty($text['value'])) : ?>
            <?= $text['value'] ?>
          <? else : ?>
            Начать чат с администратором
          <? endif; ?>
        </h2>
        <nav class="bb-arw-social__list">
          <? if (!empty($con)) : ?>
            <? foreach ($con as $eler) : ?>
              <? if (!empty($eler['link'])) : ?>
                <a class="bb-arw-social__link" href="<?= $eler['link'] ?>" target="_blanck">
                  <img src="<?= $eler['img'] ?>" alt="">
                </a>
              <? endif; ?>
            <? endforeach; ?>
          <? endif; ?>
        </nav>
      </footer>
      <div class="clic-clo">
        <img src="/vidget/close.svg" alt="">
      </div>
    </div>

  </section>

  <section class="bb-arw-card bb-arw-card_final" style="display:none">
    <? if ($lang != 'ru') : ?>
      <h2 class="bb-arw-card__headline">Thanks</h2>
      <h3 class="bb-arw-card__subline">Your application has been accepted, we will contact you shortly</h3>
    <? else : ?>
      <h2 class="bb-arw-card__headline">Спасибо</h2>
      <h3 class="bb-arw-card__subline">Ваша заявка принята, мы скоро с вами свяжемся</h3>
    <? endif; ?>
    <div class="clic-clo">
      <img src="/vidget/close.svg" alt="">
    </div>
  </section>
  <a href="" class="openWidget">
    <img src="/vidget/visg.svg" alt="" class="p1">
    <? if (isset($name['value']) && !empty($name['value'])) : ?>
      <span><?= $name['value'] ?></span>

    <? endif; ?>
    <img src="/icon/dfgh.svg" alt="" class="p1 shalot">
    <div class="wraper-sd"></div>
  </a>
</div>
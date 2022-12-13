<div class="big-galser">
  <div class="table-setting">
    <div class="count">
      <span>1</span>
      <span>/</span>
      <span><?= count($data['obj']) ?></span>
    </div>
    <div class="class-loop">
      <img src="/icon/serty.svg" alt="" class="iicon-loop">
    </div>
    <div class="closer-f">
      <img src="/icon/close.svg" alt="">
    </div>
  </div>

  <? if (isset($data['obj']) && !empty($data['obj'])) : ?>
    <? if (isset($data['targImg']) && !empty($data['targImg'])) : ?>
      <div class="perimage">
        <div class="im-wr" id="box-elemen">
          <img src="/gallery/<?= $data['targImg'] ?>" data-scrub="<?= $data['targImg'] ?>" id="prewImage-s">
          
        </div>
        <div id="plazer-zoom">
        </div>
      </div>
    <? else : ?>
      <div class="perimage">
        <div class="im-wr" id="box-elemen">
          <img src="/gallery/<?= $data['obj'][0]['src'] ?>" data-scrub="<?= $data['obj'][0]['scrub'] ?>">
          
        </div>
        <div id="plazer-zoom">
        </div>
        <? if (isset($data['obj'][0]['scrub']) && !empty($data['obj'][0]['scrub'])) : ?>
          <div class="scrub">
            <p>
              <?= $data['obj'][0]['scrub'] ?>
            <p>
          </div>
        <? endif; ?>
        
      </div>
    <? endif; ?>
    <div class="or-elm">
      <? foreach ($data['obj'] as $item) : ?>
        <div>
          <img src="/gallery/<?= $item['src'] ?>" data-scrub="<?= $item['scrub'] ?>">
        </div>
      <? endforeach; ?>
    </div>
  <? endif; ?>
</div>
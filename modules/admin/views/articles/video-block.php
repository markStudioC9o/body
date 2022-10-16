<div class="poor-block">
  <div class="block-video-default element-bord">
    <? $idS = rand(0, 999) . rand(0, 999) . $key_id; ?>
    <div class="block-video" style="width:100%" id="vide_id_<?= $idS ?>" class="video_id-<?= $key_id ?>" data-id="<?= $key_id ?>" data-attr_id="<?= $idS ?>">
      <img src="<?= $url ?>" alt="" style="width:100%" data-id="<?= $key_id ?>">
      <img src="/icon/youtube.svg" alt="" class="btn-play" data-id="<?= $key_id ?>" data-type="<?= $type ?>">
      <? if (!empty($title)) : ?>
        <div class="title_video_sp">
          <?= $title; ?>
        </div>
      <? endif ?>
    </div>
  </div>
  <div class="step-block" style="opacity: 0;">
    <span class="up-bs">
      <i class="fa fa-arrow-up"></i>
    </span>
    <span class="down-bs">
      <i class="fa fa-arrow-down"></i>
    </span>
    <span class="del-bs">
      <i class="fa fa-trash"></i>
    </span>
  </div>
  <div class="sirkle-param-cop"><i class="fa fa-plus"></i>
    <div class="cropp-block">
      <ul>
        <li class="cop-block video">Копировать</li>
        <li class="cop-paste">Вставить</li>
      </ul>
    </div>
  </div>
</div>
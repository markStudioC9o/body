<div class="poor-block">
  <div class="element-bord img-template rower-<?= $dataTag; ?>" data-tag="<?= $dataTag; ?>">
    <div class="img-wrap" style="width:40%" data-width="40">
      <video width="100%" data-tag="<?= $dataTag; ?>" autoplay loop muted playsinline>
        <source src="<?= $data ?>">
      </video>
    </div>
  </div>
  <div class="step-block">
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
  <div class="sirkle-param-cop">
    <i class="fa fa-plus"></i>
    <div class="cropp-block">
      <ul>
        <!-- <li class="cop-block video">Копировать</li> -->
        <li class="cop-paste">Вставить</li>
      </ul>
    </div>
  </div>
</div>
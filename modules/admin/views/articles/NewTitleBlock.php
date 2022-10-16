<div class="poor-block">
    <div class="block-tex-title element-bord">
        <? if($data['data'] == 'h1'):?>
        <h1 style="color:<?= (!empty($color) ? $color : 'rgb(0, 166, 202)') ?>;" data-color="<?= (!empty($color) ? $color : 'rgb(0, 166, 202)') ?>" id="mainH1" class="tit_elm">
        <span class="titleLiner"></span>
            <div contenteditable="true" class="title-text default">
                Lorem ipsum
            </div>
            
        </h1>
        <? else:?>
          <h2 style="color:<?= (!empty($color) ? $color : 'rgb(0, 166, 202)') ?>;" data-color="<?= (!empty($color) ? $color : 'rgb(0, 166, 202)') ?>" id="mainH2_<?= rand(0, 999)?><?= rand(0, 999)?>" class="tit_elm">
          <span class="titleLiner"></span>
            <div contenteditable="true" class="title-text default">
                Lorem ipsum
            </div>
            
        </h2>
        <? endif;?>
    </div>
    <div class="sirkle-param-cop">
    <i class="fa fa-plus"></i>
    <div class="cropp-block">
      <ul>
        <li class="cop-block title">Копировать</li>
        <li class="cop-paste">Вставить</li>
      </ul>
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
</div>
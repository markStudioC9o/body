<?

use yii\helpers\Html;
?>
<div class="poor-block">
  <div class="block-accardion" data-id="<?= $randId?>">
    <div class="block-accardion-page">
      <div class="accr-element">
        <div class="accardion-title">
          <div class="text-acc" contenteditable="true">
            lorem
          </div>
        </div>
        <div class="content-one-accardion" style="min-height:100px" data-id="<?= $randId ?>">
        
      </div>
      <!-- <div class="btn btn-warning del-elem-accr">
        Удалить
      </div> -->
      <div class="btn btn-success img-elem-accr" data-id="<?= $randId ?>">
        Добавить изображение
      </div>
      <!-- <div class="btn btn-success col-elem-accr" data-id="<?//= $randId ?>">
        Добавить Колонку
      </div> -->
    </div>

    <!-- <div class="add-alem-accr ster_<?//= $randId ?>" data-class="ster_<?//= $randId ?>">
      Добавить пункт  
    </div> -->
  </div>
  </div>
  <div class="step-block accardion" style="opacity: 0;">
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
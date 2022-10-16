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
        <div class="content-text-redactor text_margin_tag text_padding_tag <?= $randId; ?>_opens" id="redactor-<?= $randId ?>" data-id="<?= $randId ?>">
          <div contenteditable="true" class="contrel-text block-lest-<?= $randId ?>" id="dataRed-<?= $randId ?>" data-reb="<?= $randId ?>">
            <div>
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Beatae minus officiis eligendi sint accusantium praesentium saepe pariatur, amet doloribus veniam necessitatibus adipisci cum sunt nam soluta ipsa explicabo obcaecati earum.
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Beatae minus officiis eligendi sint accusantium praesentium saepe pariatur, amet doloribus veniam necessitatibus adipisci cum sunt nam soluta ipsa explicabo obcaecati earum.
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Beatae minus officiis eligendi sint accusantium praesentium saepe pariatur, amet doloribus veniam necessitatibus adipisci cum sunt nam soluta ipsa explicabo obcaecati earum.
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Beatae minus officiis eligendi sint accusantium praesentium saepe pariatur, amet doloribus veniam necessitatibus adipisci cum sunt nam soluta ipsa explicabo obcaecati earum.
            </div>
          </div>
        </div>
      </div>
      <div class="btn btn-warning del-elem-accr">
        Удалить
      </div>
      <div class="btn btn-success img-elem-accr" data-id="<?= $randId ?>">
        Добавить изображение
      </div>
      <div class="btn btn-success col-elem-accr" data-id="<?= $randId ?>">
        Добавить Колонку
      </div>
    </div>

    <div class="add-alem-accr ster_<?= $randId ?>" data-class="ster_<?= $randId ?>">
      Добавить пункт  
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
</div>
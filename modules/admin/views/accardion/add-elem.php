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
              Вставить текст...
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
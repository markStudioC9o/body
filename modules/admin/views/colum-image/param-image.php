<?php

use yii\helpers\Html;
?>
<div class="row">
  <input type="hidden" value="<?= $id ?>" class="idImageColum">
  <div class="col-md-12">
    <div class="row">
      <div class="col-md-6">
        <?= Html::submitButton('Подогнать изо.', ['class' => 'flopImage btn btn-success', 'data-id' => $id]) ?>
      </div>
      <div class="col-md-6">
        <?= Html::submitButton('Подогнать кол.', ['class' => 'flopColum btn btn-success', 'data-id' => $id]) ?>
      </div>
    </div>
  </div>
  <div class="col-md-12">
    <? if (isset($data['output']) && !empty($data['output'])) {
      $output = $data['output'];
    } else {
      $output = '';
    } ?>
    <?= $this->render('../articles/param-padding', ['type' => 'image-colum', 'id' => $id, 'output' => $output]) ?>
  </div>
  <div class="col-md-12 mt-4">
    <label>Ссылка для картинки</label>
    <div class="row">
      <div class="col-md-11">
        <?
        $valHref = null;
        if (isset($data['por']['href']) && !empty($data['por']['href'])) {
            $valHref = $data['por']['href'];
        } ?>
        <?= Html::textInput('img-col-link', $valHref, ['class' => 'form-control linkFromImgLink']) ?>
      </div>
      <div class="col-md-1">
        <span class="addLinkSeh" style="display: flex; justify-content: center; align-items: center; width: 100%; height: 100%;"><i class="fa fa-plus-circle" aria-hidden="true"></i></span>
      </div>
      <!-- <div class="col-md-12 mt-1">
        <label>
        <input type="checkbox" class="linkTargetSet" checked>
        Открыть в новом окне
        </label>
      </div> -->
    </div>
  </div>
  <div class="col-md-12 mt-1">
  <?= Html::submitButton((isset($data['parentColum']) && $data['parentColum'] == '1' ? 'Отключить авто размер колонки' : 'Включить авто размер колонки'), ['class' => (isset($data['parentColum']) && $data['parentColum'] == '1' ? 'flowColum' : 'flowAddColum').' btn btn-success', 'data-id' => $id]) ?>
  </div>
  <div class="col-md-12 mt-1">
    <label for="">Ширина блока</label>
    <input type="number" class="blockWidthCol form-control" value="<?= (isset($data['width']) && !empty($data['width']) ? round((int)$data['width']) : 0)?>">
  </div>
  <div class="col-md-12 mt-3">
    <a href="#" data-id="<?= $id ?>" class="del-img-col btn btn-danger">Удалить изображение из колонки</a>
  </div>

</div>


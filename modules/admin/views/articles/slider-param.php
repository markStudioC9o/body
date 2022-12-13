<?

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<? $form = ActiveForm::begin([
  'id' => 'form-slider-param'
]); ?>
<div class="row">

  <div class="col-md-12">
    <label for="">
      <div class="form-group" style="display: flex;align-items: center;">
        <input type="checkbox" name="main" value="1" style="margin-right: 10px" <?= (isset($data["stel"]) && $data["stel"]!= "none" ? "checked": "")?>>
        Превью
      </div>
    </label>
  </div>
  <div class="col-md-12">
    <label for="">
    
      <div class="form-group" style="display: flex;align-items: center;">
        <input type="checkbox" name="main-in-modal" value="1" style="margin-right: 10px" class="in-modal-up" <?= (isset($data["modal"]) && $data["modal"]== "chek" ? "checked": "")?>>
        Открывать в модальном окне
      </div>
    </label>
  </div>

  <div class="col-md-12">
    <div class="slow-rectal">
      <input type="hidden" value="<?= $id ?>" name="id">
      <? if (isset($data['obj']) && !empty($data['obj'])) : ?>
        <? foreach ($data['obj'] as $key => $val) : ?>
          <div class="crostTrok">
            <div class="form-group" style="display: flex;">
              <input type="text" name="name-<?= $key ?>-<?= $id ?>" data-name="<?= $key ?>-<?= $id ?>" class="form-control" value="<?= (isset($val["src"]) && !empty($val["src"]) ? $val["src"] : "") ?>"> <span style="position: relative;display: flex;align-items: center;margin-left: 18px;" class="remove-img-slider fa fa-trash"></span>
            </div>
            <div class="form-group">
              <label for="">
                Описание
              </label>
              <input type="text" name="desc-<?= $key ?>-<?= $id ?>" data-name="<?= $key ?>-<?= $id ?>" class="form-control" value="<?= (isset($val["subs"]) && !empty($val["subs"]) ? $val["subs"] : "") ?>">
            </div>
            <div class="form-group">
              <?= Html::submitButton('Выбрать изображение', ['class' => 'btn btn-info select-image-slider', 'data-name' => $key . '-' . $id]) ?>
            </div>
          </div>
        <? endforeach; ?>
      <? else : ?>
        <div class="form-group">
          <input type="text" name="name-1-<?= $id ?>" data-name="1-<?= $id ?>" class="form-control">
        </div>
        <div class="form-group">
          <label for="">
            Описание
          </label>
          <input type="text" name="desc-1-<?= $id ?>" data-name="1-<?= $id ?>" class="form-control">
        </div>
        <div class="form-group">
          <?= Html::submitButton('Выбрать изображение', ['class' => 'btn btn-info select-image-slider', 'data-name' => '1-' . $id]) ?>
        </div>
      <? endif; ?>
      <div class="form-group">
        <?= Html::submitButton('Добавить изображение', ['class' => 'btn btn-info add-slider-img']) ?>
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="form-group">
      <?= Html::submitButton('Вставить', ['class' => 'btn btn-info insider-slider']) ?>
    </div>
  </div>
</div>
<? ActiveForm::end(); ?>
    <div class="row">
    <div class="col-md-6 mt-2">
    <?= $this->render('../articles/param-margin', ['type' => 'slider-slis', 'id' =>$data['id'], 'output' => $data['output']]) ?>
    </div>
    </div>
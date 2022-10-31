<?

use yii\helpers\Html;

?>
<div class="row">
  <input type="text" value="<?=  $data['id']?>" class="id-gall">
  <div class="col-md-12 mb-3">
    <label for="">
      Внутрение отступы
    </label>
    <input type="number" class="pading-gal form-control" value="0" max="30" min="0" step="1" >
  </div>
  <div class="col-md-12 mb-3">
    <label for="">
      Изображение превью
    </label>
    <input type="text" class="prev-img form-control">
  </div>
  <div class="col-md-12">
  <?= Html::submitButton('Вставить',['class'=>'btn btn-success add-gal-par'])?>
  </div>
    <div class="col-md-12">
      <?= $this->render('../articles/param-margin',['id' => $data['id'], 'output' => $data['output'] ])?>
    </div>
</div>
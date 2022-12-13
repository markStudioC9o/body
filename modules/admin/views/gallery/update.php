<?

use yii\bootstrap4\Modal;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Шаблон галлереи';
?>
<div class="container-fluid">
  <div class="row">
    <section class="col-lg-10 connectedSortable">
      <div class="row">
        <div class="col-md-12 mt-3 mb-3">
          <input type="text" class="form-control" placeholder="Наименование" id="nameSet" value="<?= $model->name?>">
        </div>
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-11">
              <div id="templateGallery">
                <? print_r($model->value) ?>
              </div>
            </div>
            <div class="col-md-1">
              <span class="plus fat-plus"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></span>
            </div>
          </div>

        </div>
        <div class="col-md-12">
          <br>
          <div class="tree_rub">

          </div>
        </div>
      </div>
    </section>
    <section class="col-lg-2 connectedSortable mt-3">
      <?= Html::submitButton('Сохранить', ['id' => 'updateGallery', 'class' => 'btn btn-primary', 'data-id' => $model->id]) ?>
    </section>
  </div>
</div>
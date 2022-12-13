<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SliderItem */

$this->title = 'Новый слайд' . ' для ' . '"' . $slider->name . '"';
$this->params['breadcrumbs'][] = ['label' => 'Slider Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <section class="col-lg-12 connectedSortable">
        <div class="card card-primary card-outline">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="slider-item-create">
                  <?= $this->render('_form', [
                    'model' => $model,
                    'id' => $id,
                    'slider' => $id
                  ]) ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</section>
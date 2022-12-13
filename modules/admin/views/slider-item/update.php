<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SliderItem */

$this->title = 'Изменить слайд';
$this->params['breadcrumbs'][] = ['label' => 'Slider Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 mb-3">
        <?= Html::a('Вернуться к слайдеру',['/admin/slider/update', 'id' => $slider],['class' => 'btn btn-info'])?>
      </div>
      <section class="col-lg-12 connectedSortable">
        <div class="card card-primary card-outline">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <? if (!empty($lang)) : ?>
                  <ul class="nav nav-pills">
                  <li class="nav-item">
                        <?
                        $class = "no-active";
                        if (empty($tag)) {
                          $class = "active";
                        }
                         ?>
                        <?= Html::a('Ru', ['update', 'id' => $id, 'slider' => $slider], ['class' => 'nav-link ' . $class]) ?>
                      </li>
                    <? foreach ($lang as $item) : ?>
                      <li class="nav-item">
                        <? if ($item['tag'] == $tag) {
                          $class = "active";
                        } else {
                          $class = "no-active";
                        }
                         ?>
                        <?= Html::a($item['name'], ['', 'id' => $id, 'slider' => $slider,'tag' => $item['tag']], ['class' => 'nav-link ' . $class]) ?>
                      </li>
                    <? endforeach; ?>
                  </ul>
                <? endif; ?>
              </div>
              <div class="col-md-12">
                <hr>
              </div>
              <div class="col-md-12">
                <div class="slider-item-create">
                  <?= $this->render('_form', [
                    'model' => $model,
                    'slider' => $slider,
                    'tag' => $tag
                  ]);
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</section>
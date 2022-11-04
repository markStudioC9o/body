<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="row">
  <div class="col-md-10">
    <p>
      
      <?= Html::a('<i class="fas fa-plus"></i>Добавить страну', ['add-country'], ['class' => 'btn btn-primary']) ?>
      
        <? if($visible->value == 'show'){
          $ter = 'Скрыть';
          $teg = 'btn-danger';
        }else{
          $ter = 'Показать';
          $teg = 'btn-success';
        }?>
        <?= Html::a($ter, ['hide-country'], ['class' => 'btn '.$teg]) ?>
      
    </p>
  </div>
  <div class="col-md-10 mt-4">
    <? if(!empty($globalCity)):?>
      <label for="">Глобальный для мира: </label>
      <?foreach($globalCity as $erg):?>
        <span><?= $erg->name?></span>
        <? endforeach;?>
    <? endif;?>
  </div>
  <div class="col-md-10 mt-2">
    <div class="authors-index">
      <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
          ['class' => 'yii\grid\SerialColumn'],
          'name',
          [
            'attribute' => 'Родной язык',
            'value' => function ($model) {
              return $model->tag;
            }
          ],

          [
            'attribute' => 'Список городов',
            'format' => 'raw',
            'value' => function ($model) {
              $result = $model->citeslist;
              if (!empty($result)) {
                $str = '<ul>';
                foreach ($result as $item) {
                  $str .= '<li>' . $item->name . '</li>';
                }
                $str .= '<ul>';
                $str .= '<a href="/admin/location/city?id=' . $model->id . '">Править</a>';

                return $str;
              } else {
                return null;
              }
            }
          ],
          [
            'attribute' => 'Переводы',
            'format' => 'raw',
            'value' => function ($model) {
              $result = $model->lang;
              if (!empty($result)) {
                $str = '<ul>';
                foreach ($result as $item) {
                  $str .= '<li>' . $item->tag . ' : ' . $item->name . '</li>';
                }
                $str .= '<ul>';
                return $str;
              } else {
                return null;
              }
            }
          ],
          [
            'attribute' => 'Глобальный для страны',
            'format' => 'raw',
            'value' => function ($model) {
              return $this->render('mal', ['model' => $model]);
            }
          ],
          [
            'attribute' => 'Добавить город',
            'format' => 'raw',
            'value' => function ($model) {
              return Html::a('Новый город', ['add-city', 'id' => $model->id], ['class' => 'btn btn-info']);
            }
          ],
          [
              'class' => ActionColumn::className(),
              'template' => '<ul class="settingGrid"><li>'.'{delete}'.'</li></ul>',
              'urlCreator' => function ($action , $model, $key, $index, $column) {
                  return Url::toRoute([$action.'-cor', 'id' => $model->id]);
              }
          ],
        ],
      ]); ?>
    </div>
  </div>
</div>
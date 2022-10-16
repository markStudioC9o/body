<?php

use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Widgets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="widget-update">
  <div class="row">
    <div class="col-md-10">
      <?= $this->render('_form', [
        'model' => $model,
        'lang' => $lang,
        'widgetLangContent' => $widgetLangContent
      ]) ?>
    </div>
    <div class="col-md-10 mt-2">
    <br>
      <p>
        <?= Html::a('<i class="fas fa-plus"></i>Добавить', ['create-param', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
      </p>
      
      <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
          ['class' => 'yii\grid\SerialColumn'],
          'id',
          'parent_id',
          'link',
          'img',
          [
            'class' => ActionColumn::className(),
            'template' => '<ul class="settingGrid"><li>' . '{update}' . '</li><li>' . '{delete}' . '</li></ul>',
            'urlCreator' => function ($action, $model, $key, $index, $parent) {
              return Url::toRoute(["param-".$action,'id' => $model->id, 'parent' => $model->parent_id]);
            }
          ],
        ],
      ]); ?>
    </div>
  </div>
</div>
<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
?>
<div class="row">
  <div class="col-md-12">
  <div class="widget-create">
    <?= $this->render('_forms', [
        'model' => $model
    ]) ?>
</div>
  </div>
    <div class="col-md-10 mt-3">
        <div class="widget-index">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    
                    [
                        'attribute' => 'img',
                        'format' => 'raw',
                        'value' => function ($model) {
                            if(!empty($model->img)){
                              return '<img style="max-height:80px" src="/widget/' . $model->img . '">';
                            }else{
                              return null;
                            }
                        }
                    ],
                    [
                        'class' => ActionColumn::className(),
                        'template' => '<ul class="settingGrid"><li>'.'{delete}'.'</li></ul>',
                        'urlCreator' => function ($action, $model, $key, $index, $column) {
                            return Url::toRoute(['banner-'.$action, 'id' => $model->id, 'widget' => $model->parent_id]);
                        }
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
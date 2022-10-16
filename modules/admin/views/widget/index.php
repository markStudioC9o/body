<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

?>
<div class="row">
    <div class="col-md-10">
        <div class="widget-index">

            <p>
                <?= Html::a('<i class="fas fa-plus"></i> Добавить простой виджет', ['create'], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('<i class="fas fa-plus"></i> Добавить банерный виджет', ['create-banners'], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('<i class="fas fa-plus"></i> Добавить виджет статей', ['create-articles'], ['class' => 'btn btn-primary']) ?>
            </p>
            <br>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'title',
                        'format' => 'html',
                        'value' => function ($model) {
                          if(!empty($model->title)){
                            return $model->title;
                          }else{
                            return $model->id;
                          }
                            
                        }
                    ],
                    [
                        'attribute' => 'img',
                        'format' => 'raw',
                        'value' => function ($model) {
                            if(!empty($model->img)){
                              if($model->img == 'widget-articles'){
                                return 'виджет блока статей';
                              }else{
                                return '<img style="max-height:30px" src="/widget/' . $model->img . '">';
                              }
                            }else{
                              return null;
                            }
                            
                        }
                    ],
                    [
                        'attribute' => 'content',
                        'format' => 'html',
                        'value' => function($model){
                            return '<div style="max-width:200px">'.$model->content.'</div>';
                        }
                        
                    ],
                    [
                        'class' => ActionColumn::className(),
                        'template' => '<ul class="settingGrid"><li>'.'{update}'.'</li><li>'.'{delete}'.'</li></ul>',
                        'urlCreator' => function ($action, $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                        }
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
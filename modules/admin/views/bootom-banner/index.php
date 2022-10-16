<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;


$this->title = 'Authors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-10">
        <div class="authors-index">
            <p>
                <?= Html::a('<i class="fas fa-plus"></i> Добавить баннер', ['create'], ['class' => 'btn btn-primary']) ?>
            </p>
            <br>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'id',
                    'img',
                    [
                      'attribute' => 'img',
                      'format' => 'raw',
                      'value' => function($model){
                        if(!empty($model->img)){
                          return "<img style='max-width: 100px' src='/botom-banner/".$model->img."'>";
                        }else{
                          return null;
                        }
                      }
                    ],
                    'link',
                    'active',
                    [
                        'class' => ActionColumn::className(),
                        'template' => '<ul class="settingGrid"><li>'.'{update}'.'</li><li>'.'{delete}'.'</li></ul>',
                        'urlCreator' => function ($action , $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                        }
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
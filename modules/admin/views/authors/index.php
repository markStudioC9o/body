<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Authors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-10">
        <div class="authors-index">
            <p>
                <?= Html::a('<i class="fas fa-plus"></i>Добавить автора', ['create'], ['class' => 'btn btn-primary']) ?>
            </p>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'photo',
                        'format' => 'raw',
                        'value' => function($model){
                             if(!empty($model->photo)){return '<img src="/authors/'.$model->photo.'" style="max-height:30px">';}else{return 'not set';};
                        }
                    ],
                    'name',
                    'date:date',
                    'link',
                    [
                        'class' => ActionColumn::className(),
                        'template' => '<ul class="settingGrid"><li>'.'{update}'.'</li><li>'.'{delete}'.'</li></ul>',
                        'urlCreator' => function ($action , $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                        }
                    ],
                    [
                      'attribute' => 'default_author',
                      'format' => 'raw',
                      'value' => function($model){
                        return "<div style=\"width: 20px\"><input class=\"cherf-author\" data-id=\"".$model->id."\" type=\"checkbox\" value=\"1\" ". ($model->default_author == 1 ? 'checked' : ' ')."></div>";
                      }
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>

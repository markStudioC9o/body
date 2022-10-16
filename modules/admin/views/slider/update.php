<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model app\models\SliderList */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Slider Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="slider-list-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
<div class="col-md-12">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'img',
                'format' => 'raw',
                'value' => function ($model) {
                    return '<img style="max-width:200px" src="/slider/' . $model->img . '"/>';
                }
            ],
            //'img',
            'link',
            'bottom',
            //'active',
            //'sort',
            [
                'class' => ActionColumn::className(),
                'template' => '{update} {delete}',
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    return Url::toRoute(['/admin/slider-item/'.$action, 'id' => $model->id, 'slider' => $model->slider_id]);
                }
            ],
        ],
    ]); ?>
</div>
<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Слайдеры';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <section class="col-lg-12 connectedSortable">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="slider-list-index">
                                <p>
                                    <?= Html::a('Добавить слайдер', ['create'], ['class' => 'btn btn-success']) ?>
                                </p>
                                <?= GridView::widget([
                                    'dataProvider' => $dataProvider,
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],

                                        'name',
                                        [
                                            'attribute' => 'Новый слайд',
                                            'format' => 'raw',
                                            'value' => function ($model) {
                                                return '<a href="/admin/slider-item/create?id=' . $model->id . '"><i class="fa fa-plus"></i></a>';
                                            }
                                        ],
                                        [
                                            'class' => ActionColumn::className(),
                                            'template' => '{update} {delete}',
                                            'urlCreator' => function ($action, $model, $key, $index, $column) {
                                                return Url::toRoute([$action, 'id' => $model->id]);
                                            }
                                        ],

                                    ],
                                ]); ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
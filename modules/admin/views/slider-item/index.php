<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Слайды';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $this->title ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><?= $this->title ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <section class="col-lg-12 connectedSortable">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="slider-item-index">
                                        <p>
                                            <?= Html::a('Добавить слайд', ['create', 'id' => $id], ['class' => 'btn btn-success']) ?>
                                        </p>
                                        <?= GridView::widget([
                                            'dataProvider' => $dataProvider,
                                            'columns' => [
                                                ['class' => 'yii\grid\SerialColumn'],
                                                [
                                                    'attribute' => 'img',
                                                    'format' => 'raw',
                                                    'value' => function($model){
                                                        return '<img style="max-width:200px" src="/slider/'.$model->img.'"/>';
                                                    }
                                                ],
                                                //'img',
                                                'link',
                                                'bottom',
                                                //'active',
                                                //'sort',
                                                [
                                                    'class' => ActionColumn::className(),
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
    </section>
</div>
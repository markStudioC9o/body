<?

use yii\bootstrap4\Modal;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Шаблон галлереи';
?>
<div class="container-fluid">
    <div class="row">
        <section class="col-lg-10 connectedSortable">
            <div class="row">
                <div class="col-md-12">
                <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'id',
                    'name',
                    [
                        'class' => ActionColumn::className(),
                        'template' => '<ul class="settingGrid"><li>'.'{update}'.'</li><li>'.'{delete}'.'</li></ul>',
                        'urlCreator' => function ($action , $model, $key, $index, $column) {
                            return Url::toRoute(['gallery/'.$action, 'id' => $model->id]);
                        }
                    ],
                ],
            ]); ?>
                </div>
                <div class="col-md-12 mt-3 mb-3">
                  <input type="text" class="form-control" placeholder="Наименование" id="nameSet">
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-11">
                            <div id="templateGallery">
                                <div class="block-gall-default" style="flex-grow:1; min-height:200px;display: flex;flex-direction: column;">
                                    <div class="col-bl" style="width:100%; height:100%;display: flex;flex-grow:1;">
                                        <div class="param-bl-col">
                                            <span class="pl-col-j"><i class="fa fa-columns" aria-hidden="true"></i></span>
                                        </div>
                                        <div class="bt-pr">
                                            <span class="pl-line"><i class="fa fa-arrows-v" aria-hidden="true"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <span class="plus fat-plus"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></span>
                        </div>
                    </div>

                </div>
                <div class="col-md-12">
                    <br>
                    <div class="tree_rub">

                    </div>
                </div>
            </div>
        </section>
        <section class="col-lg-2 connectedSortable">
            <?= Html::submitButton('Сохранить',['id'=>'saveGallery','class' => 'btn btn-primary'])?>
        </section>
    </div>
</div>

<?

use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Url;

?>
<div class="row">
  <div class="col-md-12 mb-5 mt-4">
  <?= GridView::widget([
                'dataProvider' => $dataProvuder,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'id',
                    'name',
                    [
                        'class' => ActionColumn::className(),
                        'urlCreator' => function ($action , $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                        }
                    ],
                ],
            ]); ?>
  </div>
<div class="col-md-6">
<div class="row">
  <div class="col-md-12">
    <div id="polForm">



    </div>
  </div>
  <div class="col-md-12">
    <span class="add_input btn-info">Добавить поле</span>
  </div>
</div>
</div>
<div class="col-md-6">
<div class="param_field">
  
</div>
</div>
<div class="col-md-12 mt-5">
  <label for="">Наименование формы*</label>
  <input type="text" class="form-control nameForm" name="name">
</div>
<div class="col-md-12 mt-3">
  <a href="" class="btn btn-success saveForm">Сохранить</a>
</div>
</div>
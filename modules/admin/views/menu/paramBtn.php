<?

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
?>
<div class="row">
  <div class="col-md-12">
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-12">
          <?= Html::a('Удалить',['/admin/menu/deletes', 'id' => $id],['class' => 'btn btn-info']); ?>
        </div>
      </div>
    </div>
  </div>
</div>
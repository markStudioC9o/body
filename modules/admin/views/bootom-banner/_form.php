<?

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<? $form = ActiveForm::begin() ?>
<div class="row">
  <div class="col-md-6">
    <div class="row">
      <div class="col-md-12">
        <?= $form->field($model, 'link')->textInput(); ?>
      </div>
      <div class="col-md-12">
        <?= $form->field($model, 'name')->textInput(); ?>
      </div>
      <div class="col-md-12">
        <?= $form->field($model, 'image')->fileInput(); ?>
      </div>
      <div class="col-md-12">
      <?= $form->field($model, 'active')->checkbox(['value' => '1', 'checked' => true])?>
      </div>
      <div class="col-md-12">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
      </div>
    </div>
  </div>
  <div class="col-md-6">

  </div>
</div>
<? ActiveForm::end(); ?>
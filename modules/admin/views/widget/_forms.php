<?

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<? $form = ActiveForm::begin() ?>
<?= $form->field($model, 'title')->textInput(['maxlength' => true, 'required' => true]) ?>
<div class="example-1">
  <div class="form-gr">
    <label class="label">
      <i class="material-icons">attach_file</i>
      <span class="title">Добавить файл</span>
      <?= $form->field($model, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*'])->label(false) ?>
    </label>
  </div>
</div>
<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
<? ActiveForm::end() ?>


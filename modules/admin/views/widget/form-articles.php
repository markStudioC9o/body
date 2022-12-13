<?

use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="row">
  <div class="col-md-6">
    <? $form = ActiveForm::begin(); ?>
    <div class="row">
      <div class="col-md-12">
        <? if (isset($model->content) && !empty($model->content)) {
          $widgetVal = json_decode($model->content, true);
          if(isset($widgetVal['pop']) && !empty($widgetVal['pop'])){
            $pop = $widgetVal['pop'];
          }else{
            $pop = '';
          }
          if(isset($widgetVal['new']) && !empty($widgetVal['new'])){
            $new = $widgetVal['new'];
          }else{
            $new = '';
          }
          if(isset($widgetVal['type']) && !empty($widgetVal['type'])){
            $type = $widgetVal['type'];
          }else{
            $type = 'artic';
          }
        } else {
          $widgetVal = '';
          $type = 'artic';
          $new = '';
          $pop = '';
        } ?>
        <?= Html::radioList('Widget[widgetArticles][type]', $type, ['artic'=> 'Статьи', 'video' => 'Видео'])?>
        <label for="">Популярное</label>
        <? echo Select2::widget([
          'name' => 'Widget[widgetArticles][pop]',
          'data' => ArrayHelper::map($articles, 'id', 'text'),
          'size' => Select2::SIZE_X_LARGE,
          'value' => $pop,
          'options' => ['placeholder' => 'Выберите статью ...', 'multiple' => true],
          'pluginOptions' => [
            'allowClear' => true
          ],
        ]);
        ?>

        <label for="">Новые</label>
        <? echo Select2::widget([
          'name' => 'Widget[widgetArticles][new]',
          'data' => ArrayHelper::map($articles, 'id', 'text'),
          'size' => Select2::SIZE_X_LARGE,
          'value' => $new,
          'options' => ['placeholder' => 'Выберите статью ...', 'multiple' => true],
          'pluginOptions' => [
            'allowClear' => true
          ],
        ]);
        ?>
        
      </div>
      <div class="col-md-12">
        <?= $form->field($model, 'title')->textInput() ?>
      </div>
      <div class="col-md-12">
        <div class="form-group field-widget-title">
          <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>
      </div>
    </div>
    <? ActiveForm::end() ?>
  </div>
</div>
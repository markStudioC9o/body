<?

use app\widgets\ArticlesType;
use yii\widgets\ActiveForm;
use vova07\imperavi\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\select2\Select2;
?>


<? $form = ActiveForm::begin() ?>
<? if (isset($model->id) && !empty($model->id)) : ?>
    
  <div id="tabs-param">
    <input type="hidden" value="<?= $model->id ?>" class="id_heading">
    <br>
  <div class="form-group">
  <label for="">Виджеты</label>
  <? if(isset($headingWidget->value) && !empty($headingWidget->value)){
    $dataVal = json_decode($headingWidget->value , true);
  }else{
    $dataVal = null;
  }?>
    <?
  echo Select2::widget([
    'name' => 'HeadingWidget[widget]',
    'data' => $widgetMap,
    'value' => $dataVal,
    'options' => [
      'placeholder' => 'Виджеты',
      'multiple' => true,
      'class' => 'form-control selecter23 headingSelect'
    ],
  ]);
  ?>
  </div>

  <div class="form-group">
  <label for="">Нижний баннер</label>
  <? if(isset($bottomBanner->value) && !empty($bottomBanner->value)){
    $dataBB = json_decode($bottomBanner->value , true);
  }else{
    $dataBB = null;
  }?>
    <?
  echo Select2::widget([
    'name' => 'HeadingWidget[bottomBanner]',
    'data' => $widgetBB,
    'value' => $dataBB,
    'options' => [
      'placeholder' => 'Выберите баннер',
      'multiple' => false,
      'class' => 'form-control selecter23 headingSelect'
    ],
  ]);
  ?>
  </div>


<br>
    <? $articles = $model->getArticl()->select('articles_id')->asArray()->all();?>
    <? $option = $model->getOption();?>
    <?= ArticlesType::widget(['articles' => $articles, 'option' => $option])?>

    <div class="form-group">
      <label for="">Картинка</label>
      <input type="file" id="headingBanner" name="file">
    </div>
    <div class="form-group">
    <span class="btn btn-info" id="sevaHeadingImg">Сохранить изображение</span>
    </div>
    <br>
  </div>
<? endif; ?>

<? foreach ($lang as $elem) : ?>
  <? if ($elem->tag == 'ru') : ?>
    <div id="tabs-<?= $elem->id ?>">
      <? if (isset($model->id) && !empty($model->id)) : ?>
        <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>
      <? endif; ?>
      <?= $form->field($model, 'title')->textInput() ?>
      <?= $form->field($model, 'link')->textInput() ?>
      <?
      $array = array();
      if (!empty($list)){
        $array[0] = 'Без родительской';
        $array = ArrayHelper::map($list, 'id', 'title');
        asort($array);
      };
      $params = [
        'prompt' => 'Без родительской'
      ];
      ?>
      <?= $form->field($model, 'parent_id')->dropDownList($array, $params, ['class' => 'form-control',]) 
      ?>

      <?= $form->field($model, 'descript') ?>
      <?= $form->field($model, 'key_meta') ?>
      <?
      $items = array(
        '1' => '1 колонкa',
        '2' => '2 колонки',
        '3' => '4 колонки'
      );
      ?>
      <?= $form->field($model, 'col')->dropDownList($items) ?>
      <label for="">Описание рубрики</label>
      <?
      echo $form->field($model, 'text')->widget(Widget::className(), [
        'value' => $model->text,
        'settings' => [
          'lang' => 'ru',
          'minHeight' => 200,
        ],
      ])->label(false);
      ?>
    </div>
  <? else : ?>
    <div id="tabs-<?= $elem->id ?>">
      <? if (!empty($modelLang)) : ?>
        <? foreach ($modelLang as $vals) : ?>
          <? if ($vals->tag == $elem->tag) : ?>
            <div class="form-group field-heading-title">
              <label class="control-label" for="heading-title">Название (<?= $elem->name ?>)</label>
              <?= Html::textInput('HeadingLang[' . $elem->tag . '][name]', $vals->title, ['class' => 'form-control']) ?>
            </div>
            <div class="form-group field-heading-title">
              <label class="control-label" for="heading-title">Link</label>
              <?= Html::textInput('HeadingLang[' . $elem->tag . '][link]', $vals->link, ['class' => 'form-control']) ?>
            </div>
            
            <div class="form-group field-heading-title">
              <label class="control-label" for="heading-title">Descript (SEO)</label>
              <?= Html::textInput('HeadingLang[' . $elem->tag . '][descript]', $vals->descript, ['class' => 'form-control']) ?>
            </div>
            <div class="form-group field-heading-title">
              <label class="control-label" for="heading-title">Key Meta (SEO)</label>
              <?= Html::textInput('HeadingLang[' . $elem->tag . '][key_meta]', $vals->key_meta, ['class' => 'form-control']) ?>
            </div>
            <label for="">Описание рубрики</label>
            <?
            echo \vova07\imperavi\Widget::widget([
              'id' => 'heading-text-' . $elem->tag,
              'name' => 'HeadingLang[' . $elem->tag . '][text]',
              'value' => $vals->text,
              'settings' => [
                'lang' => 'ru',
                'minHeight' => 200,
              ],
            ]);
            ?>
          <? endif; ?>
        <? endforeach; ?>
      <? else : ?>
        <div class="form-group field-heading-title">
          <label class="control-label" for="heading-title">Название (<?= $elem->name ?>)</label>
          <?= Html::textInput('HeadingLang[' . $elem->tag . '][name]', '', ['class' => 'form-control']) ?>
        </div>
        <div class="form-group field-heading-title">
          <label class="control-label" for="heading-title">Link (<?= $elem->name ?>)</label>
          <?= Html::textInput('HeadingLang[' . $elem->tag . '][link]', '', ['class' => 'form-control']) ?>
        </div>
        <div class="form-group field-heading-title">
          <label class="control-label" for="heading-title">Descript (SEO)</label>
          <?= Html::textInput('HeadingLang[' . $elem->tag . '][descript]', '', ['class' => 'form-control']) ?>
        </div>
        <div class="form-group field-heading-title">
          <label class="control-label" for="heading-title">Key Meta (SEO)</label>
          <?= Html::textInput('HeadingLang[' . $elem->tag . '][key_meta]', '', ['class' => 'form-control']) ?>
        </div>
        <label for="">Описание рубрики</label>
        <?
        echo \vova07\imperavi\Widget::widget([
          'id' => 'heading-text-' . $elem->tag,
          'name' => 'HeadingLang[' . $elem->tag . '][text]',
          'value' => '',
          'settings' => [
            'lang' => 'ru',
            'minHeight' => 200,
          ],
        ]);
        ?>
      <? endif; ?>
    </div>
  <? endif; ?>
<? endforeach; ?>
<div class="form-group">
  <?= Html::submitButton('Соханить', ['class' => 'btn btn-primary']) ?>
</div>
<? ActiveForm::end(); ?>
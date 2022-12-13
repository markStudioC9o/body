<?

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

$this->title = 'Страница ' . $model->title;
?>
<div class="container-fluid">
  <div class="row">
    <section class="col-lg-12 connectedSortable">
      <div class="card card-primary card-outline">
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <?php $form = ActiveForm::begin(); ?>

              <div class="row">
                <div class="col-md-12">
                  <?php if (Yii::$app->session->hasFlash('error')) : ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <?php echo Yii::$app->session->getFlash('error'); ?>
                    </div>
                  <?php endif; ?>
                </div>
                <div class="col-md-12">
                  <?php if (Yii::$app->session->hasFlash('success')) : ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <?php echo Yii::$app->session->getFlash('success'); ?>
                    </div>
                  <?php endif; ?>
                </div>
                <div class="col-md-12">
                  <?= $form->errorSummary($model) ?>
                </div>
                <div class="col-md-4">
                  <?= $form->field($model, 'title') ?>
                  <div class="form-group field-pages-seo has-success">
                    <label class="control-label">Описание</label>
                    <input type="text" class="form-control" name="Seo[desc]" aria-invalid="false" value="<?= $desc; ?>">
                  </div>
                  <div class="form-group field-pages-seo has-success">
                    <label class="control-label"> Seo ключи</label>
                    <input type="text" class="form-control" name="Seo[key]" aria-invalid="false" value="<?= $key; ?>">
                  </div>
                  <div class="form-group field-pages-seo has-success">
                    <!-- <input type="text" id="linkTranslite" name="link" class="form-control" value="<? //= (!empty($model->link) ? $model->link : '') 
                                                                                                        ?>" name="link" aria-invalid="false"> -->
                    <?= $form->field($model, 'link')->textInput(['placeholder' => 'Ссылка']) ?>
                  </div>
                  <div class="form-group field-pages-seo has-success">
                    <!-- <input type="text" id="linkTranslite" name="link" class="form-control" value="<? //= (!empty($model->link) ? $model->link : '') 
                                                                                                        ?>" name="link" aria-invalid="false"> -->
                    <?= $form->field($model, 'ex_link')->textInput(['placeholder' => 'Внешняя Ссылка']) ?>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="control-label">Виджеты на странице (по умолчанию)</label>
                        <? if (!empty($optParam['widget']['value'])) {
                          $widgetVal = json_decode($optParam['widget']['value'], true);
                        } else {
                          $widgetVal = '';
                        } ?>
                        <?
                        foreach ($widgetList as &$lib) {
                          $lib['title'] = $lib['id'] . '-' . $lib['title'];
                        }
                        ?>
                        <? echo Select2::widget([
                          'name' => 'Widget[widgetList]',
                          'data' => ArrayHelper::map($widgetList, 'id', 'title'),
                          'size' => Select2::MEDIUM,
                          'value' => $widgetVal,
                          'options' => ['placeholder' => 'Выбрать виджет ...', 'multiple' => true],
                          'pluginOptions' => [
                            'allowClear' => true
                          ],
                        ]);
                        ?>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="control-label">Слайдер на странице</label>
                        <? if (!empty($optParam['slider']['value'])) {
                          $slideVal = $optParam['slider']['value'];
                        } else {
                          $slideVal = '';
                        } ?>
                        <?= Html::DropDownList('slider', $slideVal, ArrayHelper::map($slider, 'id', 'name'), ['prompt' => 'Без слайдера', 'class' => 'form-control']) ?>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <?
                      $data = array(
                        'artic' => 'Статья',
                        'categ' => 'Категория статей',
                        'all' => 'Все статьи'
                      );
                      ?>
                      <div class="form-group">
                        <label class="control-label">Тип страницы</label>
                        <? if (isset($optParam['type']['value']) && !empty($optParam['type']['value'])) {
                          $paramType = json_decode($optParam['type']['value'], true);
                          if ($paramType[0] == "arcticles") {
                            $value = 'artic';
                          } else {
                            $value = $paramType[0];
                          }
                        } else {
                          $value = '';
                        }
                        if (isset($paramType[1]) && !empty($paramType[1])) {
                          echo "<input type='hidden' class='catId-ls' value='" . $paramType[1] . "'>";
                        }
                        ?>

                        <? echo Select2::widget([
                          'name' => 'type[Page]',
                          'data' => $data,
                          'size' => Select2::MEDIUM,
                          'value' => $value,
                          'options' => ['placeholder' => 'Выбрать тип ...', 'multiple' => false],
                          'pluginOptions' => [
                            'allowClear' => true
                          ],
                        ]);
                        ?>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="areaArticles">

                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <?= $form->field($model, 'top_menu')->checkbox(['uncheck' => '0', 'value' => '1', 'label' => 'Добавить как пункт верхнего меню']); ?>
                  <?= $form->field($model, 'bottom_menu')->checkbox(['uncheck' => '0', 'value' => '1', 'label' => 'Добавить как пункт нижнего меню']); ?>
                </div>
                <div class="col-md-12">

                  <? if (!empty($lang)) : ?>
                    <label for="">Языковый параметры</label>
                    <div id="accordion">
                      <? foreach ($lang as $item) : ?>

                        <?
                        $title = '';
                        $desc = '';
                        $key = '';
                        $link = '';
                        $exlink = '';
                        foreach ($pageLang as $els) {
                          if ($item['tag'] == $els['tag']) {
                            $title = $els['title'];
                            $desc = $els['descript'];
                            $key = $els['keyword'];
                            $link = $els['link'];
                            $exlink = $els['ex_link'];
                          }
                        } ?>
                        <h3 class="alert alert-light"><?= $item['name'] ?></h3>
                        <div>
                          <div class="form-group field-widget-title">
                            <label class="control-label" for="widget-title">Наименование страницы</label>
                            <?= Html::input('text', 'Lang[' . $item['tag'] . '][title]', $title, ['class' => 'form-control']) ?>
                          </div>
                          <div class="form-group field-pages-seo has-success">
                            <label class="control-label">Описание</label>
                            <?= Html::input('text', 'Lang[' . $item['tag'] . '][desc]', $desc, ['class' => 'form-control']) ?>
                          </div>
                          <div class="form-group field-pages-seo has-success">
                            <label class="control-label"> Seo ключи</label>
                            <?= Html::input('text', 'Lang[' . $item['tag'] . '][key]', $key, ['class' => 'form-control']) ?>
                          </div>
                          <div class="form-group field-pages-seo has-success">
                            <label class="control-label">Внутренняя ссылка</label>
                            <?= Html::input('text', 'Lang[' . $item['tag'] . '][link]', $link, ['class' => 'form-control']) ?>
                          </div>
                          <div class="form-group field-pages-seo has-success">
                            <label class="control-label">Внешняя ссылка</label>
                            <?= Html::input('text', 'Lang[' . $item['tag'] . '][ex_link]', $exlink, ['class' => 'form-control']) ?>
                          </div>
                        </div>
                      <? endforeach; ?>
                    </div>
                  <? endif; ?>

                </div>
                <div class="col-md-12 mt-5">
                  <div class="form-group">
                    <?= Html::submitButton('Соханить', ['class' => 'btn btn-primary']) ?>
                  </div>
                </div>
              </div>
              <?php ActiveForm::end(); ?>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
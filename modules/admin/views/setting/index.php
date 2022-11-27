<?

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \vova07\imperavi\Widget;
use mihaildev\ckeditor\CKEditor;

$this->title = 'Настройки';
?>
<div class="container-fluid">
  <div class="row">
    <section class="col-lg-12 connectedSortable">
      <div class="card card-primary card-outline">
        <div class="card-body">
          <div class="row">
            <div class="col-5 col-sm-3">
              <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                <!-- <a class="nav-link" id="vert-tabs-city-tab" data-toggle="pill" href="#vert-tabs-city" role="tab">города и адреса</a> -->
                <!-- <a class="nav-link" id="vert-tabs-cosial-tab" data-toggle="pill" href="#vert-tabs-cosial" role="tab">Социальные сети</a> -->
                <a class="nav-link" id="vert-tabs-footer-tab" data-toggle="pill" href="#vert-tabs-footer" role="tab">Ссылки в подвале</a>
                <a class="nav-link" id="vert-tabs-info-block-tab" data-toggle="pill" href="#vert-tabs-info-block" role="tab">Информационый блок</a>
                <a class="nav-link" id="tabs-favicon-tab" data-toggle="pill" href="#tabs-favicon" role="tab">Фавикон</a>
              </div>
            </div>
            <div class="col-7 col-sm-9">
              <div class="tab-content" id="vert-tabs-tabContent">
                <div class="tab-pane fade" id="tabs-favicon" role="tabpanel" aria-labelledby="tabs-favicon">
                  <div class="row">
                  
                  <div class="col-md-6">

                  
                    <? $flow = ActiveForm::begin([
                      'id' => 'favicon-form',
                      'options' => [
                        'id' => 'favicon-id'
                      ]
                    ]) ?>
                        <div class="example-1">
                          <div class="form-gr">
                            <label class="label">
                              <i class="material-icons">attach_file</i>
                              <span class="title">Изображение снипета</span>
                              <?= $flow->field($favicon, 'img')->fileInput()->label(false); ?>
                            </label>
                          </div>
                        </div>
                        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success'])?>
                    <? ActiveForm::end() ?>
                    </div>
                    <div class="col-md-6">
                      <? if(isset($favImg['value']) && !empty($favImg['value'])):?>
                        <img src="/favicon/<?= $favImg['value']?>" alt="">
                        <? endif;?>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="vert-tabs-footer" role="tabpanel" aria-labelledby="vert-tabs-footer">
                  <div class="col-md-12 mb-5">
                        <?= Html::a('Языковые версии ', '/admin/setting/lang-link-footer') ?>
                      
                        <?= Html::a(' Картинка в подвале', '/admin/setting/image-footer') ?>
                  </div>
                  <? $form = ActiveForm::begin([
                    'id' => 'footer_if',
                    'options' => [
                      'id' => 'footer_link'
                    ]
                  ]) ?>
                  <div class="row">
                    <?= $this->render('form-link', [
                      'link' => $link
                    ]) ?>
                    <div class="col-md-12">
                      <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
                    </div>
                  </div>
                  <? ActiveForm::end(); ?>
                </div>

                <div class="tab-pane fade" id="vert-tabs-info-block" role="tabpanel" aria-labelledby="vert-tabs-info-block">
                  <? $form = ActiveForm::begin([
                    'id' => 'inform'
                  ]) ?>
                  <?= Html::a('Языковые Настройки', '/admin/setting/lan-informer') ?>
                  <br>
                  <?
                  // echo $form->field($inform, 'value')->widget(Widget::className(), [
                  //   'value' => $inform->value,
                  //   'settings' => [
                  //     'lang' => 'ru',
                  //     'minHeight' => 200,
                  //   ],
                  // ]);

                  // echo $form->field($inform, 'value')->widget(CKEditor::className(), [
                  //   'editorOptions' => [
                  //     'preset' => 'full',
                  //     'inline' => false, 
                  //   ],
                  // ]);
                  ?>
                  <? if (!empty($inform->value)) {
                    $trety = json_decode($inform->value, true);
                  } ?>
                  <label for="">Заголовок</label>
                  <?= Html::textInput('footerHeaderParam[inform][title]', $trety['title'], ['class' => 'form-control', 'plaсeholder' => 'Заголовок']) ?>
                  <br>
                  <label for="">Текст</label>
                  <?= Html::textarea('footerHeaderParam[inform][text]', $trety['text'], ['class' => 'form-control', 'plaсeholder' => 'Текст']) ?>
                  <br>
                  <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
                  <? ActiveForm::end(); ?>
                </div>

                <div class="tab-pane fade" id="vert-tabs-city" role="tabpanel" aria-labelledby="vert-tabs-city-tab">
                  <? if (!empty($city)) : ?>
                    <ul>
                      <li><label for="">Список городов</label></li>
                      <? foreach ($city as $item) : ?>
                        <li><?= $item->name ?> : <?= $item->phone ?></li>
                      <? endforeach; ?>
                    </ul>
                  <? endif; ?>
                  <? $form = ActiveForm::begin([
                    'id' => 'city-form'
                  ]); ?>
                  <?= $form->field($modelCity, 'name')->textInput() ?>
                  <?= $form->field($modelCity, 'phone')->textInput() ?>
                  <?= $form->field($modelCity, 'email')->textInput() ?>
                  <?= $form->field($modelCity, 'lang')->dropDownList(ArrayHelper::map($languge, 'id', 'tag')) ?>
                  <?
                  echo $form->field($modelCity, 'text')->widget(Widget::className(), [
                    'value' => '  ',
                    'settings' => [
                      'lang' => 'ru',
                      'minHeight' => 200,
                    ],
                  ]);
                  ?>
                  <div class="form-group">
                    <?= Html::submitButton('Соханить', ['class' => 'btn btn-primary']) ?>
                  </div>
                  <? ActiveForm::end(); ?>
                </div>
                <div class="tab-pane fade" id="vert-tabs-cosial" role="tabpanel" aria-labelledby="vert-tabs-cosial-tab">
                  <? $form = ActiveForm::begin([
                    'id' => 'cosial-form'
                  ]); ?>
                  <div class="form-group field-citylist-name required has-success">
                    <label class="control-label" for="citylist-name">Instagram</label>
                    <?= Html::textInput('Cosial[insta]', (!empty($cosial['insta']) ? $cosial['insta'] : ''), ['class' => 'form-control']) ?>
                  </div>
                  <div class="form-group field-citylist-name required has-success">
                    <label class="control-label" for="citylist-name">Youtube</label>
                    <?= Html::textInput('Cosial[youtube]', (!empty($cosial['youtube']) ? $cosial['youtube'] : ''), ['class' => 'form-control']) ?>
                  </div>
                  <div class="form-group field-citylist-name required has-success">
                    <label class="control-label" for="citylist-name">Email</label>
                    <?= Html::textInput('Cosial[email]', (!empty($cosial['email']) ? $cosial['email'] : ''), ['class' => 'form-control']) ?>
                  </div>
                  <div class="form-group field-citylist-name required has-success">
                    <label class="control-label" for="citylist-name">Telegram</label>
                    <?= Html::textInput('Cosial[telegram]', (!empty($cosial['telegram']) ? $cosial['telegram'] : ''), ['class' => 'form-control']) ?>
                  </div>
                  <div class="form-group">
                    <?= Html::submitButton('Соханить', ['class' => 'btn btn-primary']) ?>
                  </div>
                  <? ActiveForm::end(); ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
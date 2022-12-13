<?

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

?>
<div class="container-fluid">
  <div class="row">
    <section class="col-lg-12 connectedSortable">
      <div class="card card-primary card-outline">
        <div class="card-header">
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-5 col-sm-3">
              <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                <? foreach ($pages as $item) : ?>
                  <a class="nav-link" id="vert-tabs-<?= $item->id ?>-tab" data-toggle="pill" href="#vert-tabs-<?= $item->id ?>" role="tab" aria-controls="vert-tabs-<?= $item->id ?>" aria-selected="false"><?= $item->title ?></a>
                <? endforeach; ?>
                <a class="nav-link active" id="vert-tabs-new-tab" data-toggle="pill" href="#vert-tabs-new" role="tab" aria-controls="vert-tabs-new" aria-selected="false"><i class="fas fa-plus"></i> Новая страница</a>
              </div>
            </div>
            <div class="col-7 col-sm-9">
              <div class="tab-content" id="vert-tabs-tabContent">
                <? foreach ($pages as $item) : ?>
                  <div class="tab-pane text-left fade" id="vert-tabs-<?= $item->id ?>" role="tabpanel" aria-labelledby="vert-tabs-<?= $item->id ?>-tab">
                    <div class="row">
                      <div class="col-md-12">
                        <?= $item->title ?>
                      </div>
                      <div class="col-md-12">
                        <? $param = json_decode($item->seo, true) ?>
                        <? if (!empty($param)) : ?>
                          <ul>
                            <li>
                              <p>SEO описание: </p>
                              <p><?= $param['desc'] ?></p>
                            </li>
                            <li>
                              <p>SEO ключи: </p>
                              <p><?= $param['key'] ?></p>
                            </li>
                          </ul>
                        <? endif; ?>
                      </div>
                      <div class="col-md-12">
                        Сылка на страницу <a href="/pages/<?= $item->link ?>">/pages/<?= $item->link ?></a>

                      </div>
                      <div class="col-md-12 mt-3">
                        <?= Html::a('Настроить', ['/admin/pages/setting', 'id' => $item->id], ['class' => 'btn btn-primary']) ?>
                        <? if ($item->id != '5') : ?>
                          <?= Html::a('Удалить', ['/admin/pages/remove', 'id' => $item->id], ['class' => 'btn btn-info']) ?>
                        <? endif; ?>
                        <?= Html::a('Отключить', ['/admin/pages/setting', 'id' => $item->id], ['class' => 'btn btn-primary']) ?>
                      </div>
                    </div>

                  </div>
                <? endforeach; ?>
                <div class="tab-pane active show" id="vert-tabs-new" role="tabpanel" aria-labelledby="vert-tabs-new-tab">
                  <?php Pjax::begin(['id' => 'some_pjax_id']); ?>
                  <?php if (Yii::$app->session->hasFlash('warning')) : ?>
                    <div class="alert alert-warning alert-dismissible" role="alert">
                      <?php echo Yii::$app->session->getFlash('warning'); ?>
                    </div>
                  <?php endif; ?>
                  <?php Pjax::end(); ?>
                  <?php $form = ActiveForm::begin([
                    //'validationUrl' => '/admin/pages/validate-form',
                    //'enableAjaxValidation' => true
                  ]); ?>
                  <?= $form->field($model, 'title') ?>
                  <div class="form-group field-pages-seo has-success">
                    <label class="control-label">Описание</label>
                    <input type="text" class="form-control" name="Seo[desc]" aria-invalid="false">
                  </div>
                  <div class="form-group field-pages-seo has-success">
                    <label class="control-label"> Seo ключи</label>
                    <input type="text" class="form-control" name="Seo[key]" aria-invalid="false">
                  </div>
                  <div class="form-group field-pages-seo has-success">
                  <label class="control-label">Ссылка</label>
                    <input type="text" id="linkTranslite" name="link" class="form-control" name="link" aria-invalid="false">
                  </div>
                  <?= $form->field($model, 'top_menu')->checkbox(['uncheck' => '0', 'value' => '1', 'label' => 'Добавить как пункт верхнего меню',  'checked ' => true]); ?>
                  <?= $form->field($model, 'bottom_menu')->checkbox(['uncheck' => '0', 'value' => '1', 'label' => 'Добавить как пункт нижнего меню',  'checked ' => true]); ?>
                  <div class="form-group">
                    <?= Html::submitButton('Соханить', ['class' => 'btn btn-primary', 'id' => 'pajaxRefer']) ?>
                  </div>
                  <?php ActiveForm::end(); ?>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
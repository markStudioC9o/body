<?php

use app\widgets\FormBlock;
use kartik\select2\Select2;
use yii\bootstrap4\Html;
use yii\bootstrap4\Modal;
use yii\helpers\ArrayHelper;
use vova07\imperavi\Widget;

$this->title = 'Новая статья';
?>
<div class="fixed-plash-block">
  В историю записан блок
</div>
<div class="fixed-param-right relle" style="display: none">
  <div class="opte">
    <img src="/icon/left-a.svg" alt="" class="op">
    <img src="/icon/right-a.svg" alt="" class="cos">
  </div>
  <button class="btn btn-bottom btn-success saveArticleThis">Сохранить</button>
</div>
<div class="container-fluid">
<div class="row">
    <div class="col-md-12">
      <div class="it-rem">
        
        <div class="knopSave">
          <button class="btn btn-bottom btn-success saveArticleThis" id="saveArticle">Сохранить</button>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <input type="hidden" id="idArticles" value="">
    <input type="hidden" id="ArticlesSize" value="<?= (isset($mot) && !empty($mot) ? $mot : '1680') ?>">
    <input type="hidden" id="ArticlesLang" value="<?= (isset($tag) && !empty($tag) ? $tag : 'ru') ?>">
    
    <section class="col-md-9 connectedSortable left-conters">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-2">
              <?= $this->render('../layouts/adminmenu.php') ?>
            </div>
            <div class="col-md-10" style="display:flex">
              <div id="blockContent">
              </div>
              <div class="block-colum" id="indexColum">
                <div class="card-block">
                  <div class="card">
                    <div class="card-header">
                      <h5>BODY BALANCE CLINIC</h5>
                    </div>
                    <div class="card__wrapper">
                      <div class="card-image">
                        <img src="/widget/widget-128-2022-07-09.jpg" alt="">
                      </div>
                      <div class="card-descr">
                        <p><a href="" target="_blank">20 представительств</a></p>
                        <p><a href="" target="_blank">Центральный офис Praha, Czech</a><br></p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
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
    <section class="col-md-3 connectedSortable right-conters">
      <div class="row">
        <div class="col-md-12">
          <div id="tabsNap">
            <ul>
              <li><a href="#tabs-1">Управление</a></li>
              <li><a href="#tabs-2">Параметры</a></li>
            </ul>
            <div id="tabs-1" class="cust">
              <div class="block-parametrs">
                <? if (isset($articlesOption['img_articles']) && !empty($articlesOption['img_articles'])) {
                  echo '<img src="/articles/' . $articlesOption['img_articles'] . '" style="width:100%"/>';
                } ?>
              </div>
            </div>
            <div id="tabs-2" class="cust">
              <div class="col-md-12 mt-1">
                <div class="example-1">
                  <div class="form-gr">
                    <label class="label">
                      <i class="material-icons">attach_file</i>
                      <span class="title">Изображение статьи</span>
                      <input type="file" id="prevImageArticles">
                    </label>
                  </div>
                </div>
                <div class="col-md-12 mt-3">
                  <div class="wid-im">
                  </div>
                </div>
              </div>

              <? echo Select2::widget([
                  'name' => 'articlesWidget',
                  'id' => 'articlesWidget',
                  'data' => ArrayHelper::map($widget, 'id', 'title'),
                  //'size' => Select2::LARGE,
                  //'value' => $widgetVal,
                  'options' => ['placeholder' => 'Выбрать виджет ...', 'multiple' => true],
                  'pluginOptions' => [
                    'allowClear' => true
                  ],
                ]);
                ?>
              <?= $this->render('param-articles-index', [
                'articlesOption' => $articlesOption,
                'heading' => $heading
              ]) ?>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
<?= $this->render('modal-block-index') ?>
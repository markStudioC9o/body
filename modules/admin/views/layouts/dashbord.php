<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AdminAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Modal;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Html;
use kartik\editors\Summernote;
use kartik\color\ColorInput;          

AdminAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
  <meta charset="<?= Yii::$app->charset ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?php $this->registerCsrfMetaTags() ?>
  <title><?= Html::encode($this->title) ?></title>
  <?php $this->head() ?>
</head>

<body class="d-flex flex-column">
  <?php $this->beginBody() ?>
  <header>
  </header>
  <div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <!-- <li class="nav-item d-none d-sm-inline-block">
          <a href="/admin" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Contact</a>
        </li> -->
        <li class="nav-item">
          <a class="nav-link" href="#"><?= (isset(Yii::$app->user->identity->username) ? Yii::$app->user->identity->username : null) ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/logout">Выход</a>
        </li>
      </ul>
      <!-- <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
          </a>
          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>
      </ul> -->
    </nav>
    <?= $this->render('aside') ?>
    <div class="content-wrapper otyu" style="background:#fff">
      <!-- <div class="content-header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <h1 class="m-0">
              <? if (isset($this->context->title)) : ?>
                <? //= $this->context->title 
                ?>
                <? endif; ?>
              </h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">
                  <? if (isset($this->context->title)) : ?>
                  <? //= $this->context->title 
                  ?>
                  <? endif; ?>
              </li>
              </ol>
            </div>
          </div>
        </div>
      </div> -->
      <section class="content" style="padding-left: 20px">
        <?= $content ?>
      </section>
    </div>
    <footer class="main-footer">


      <div class="float-right d-none d-sm-inline-block">

      </div>
    </footer>

    <aside class="control-sidebar control-sidebar-dark">
    </aside>
  </div>
  <? Modal::begin([
    'id' => 'image',
    'size' => 'modal-max'
  ]) ?>
  <div class="abbred-image" data-img_id="">
    <?= $this->render('/articles/form-add-image') ?>
  </div>
  <?
  Modal::end();
  ?>
  <? Modal::begin([
    'id' => 'fon-icon',
    'size' => 'modal-lg'
  ]) ?>
  <div class="telo">

  </div>
  <? Modal::end()?>
  <? Modal::begin([
    'id' => 'quote',
    'size' => 'modal-lg'
  ]) ?>


  <div class="qoute">
    <div class="row">
      <div class="col-md-12 mb-4">
      <?
          echo ColorInput::widget([
              'name' => 'colorMenu',
              'id'=>'colorMenu',
              'value' => (!empty($model['color']) ? $model['color'] : '#759523'),
              'options' => ['readonly' => true]
          ]);
          ?>
      </div>
      <div class="col-md-8">
        <input type="text" class="form-control title-qut" placeholder="Заголовок">
      </div>
      <div class="col-md-4">
        <?//= Html::submitButton('Картинка', ['class' => 'btn btn-success img-quote'])?>
      
        <?= Html::submitButton('Иконка', ['class' => 'btn btn-success icon-quote'])?>
      </div>
      <div class="col-md-4 mt-1">
        <input type="text" readonly id="link-img" class="form-control">
      </div>
      <div class="col-md-4 mt-1">
        <input type="text" readonly id="link-icon" class="form-control">
      </div>
      <div class="col-md-6"></div>
      <div class="col-md-6">
      <sub>Изображение должно быть пропорциональным</sub>
      </div>
      <div class="col-md-12 mt-4">
        <?
        echo Summernote::widget([
          'name' => 'comments',
          'id' => 'quote-bodsy',
          'value' => '',
          // other widget settings
        ]);
        ?>
      </div>
      <div class="col-md-12 mt-4">
        <?= Html::submitButton('Получить', ['class' => 'btn btn-success asd-fert']) ?>
      </div>
    </div>
  </div>

  <?
  Modal::end();
  ?>

  <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>
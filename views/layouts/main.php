<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use app\widgets\CalbackWedget;
use app\widgets\ColorWidget;
use app\widgets\InfoBanner;
use app\widgets\LangWidget;
use app\widgets\Menu;
use app\widgets\TitleWidget;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Modal;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Url;

AppAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<? $lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'en';?>
<html lang="<?= $lang?>-<?= mb_strtoupper($lang)?>" >

<head>
  <meta charset="<?= Yii::$app->charset ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?php $this->registerCsrfMetaTags() ?>
  <title><?= (isset(Yii::$app->params['title']) && !empty(Yii::$app->params['title']) ? TitleWidget::widget()." ".Yii::$app->params['title'] : TitleWidget::widget(['type' => 'default']))?></title>
  <style>
    @font-face {
    font-family: 'Stem';
    src: url('/stem/Stem-Light.eot');
    src: local('Stem Light'), local('Stem-Light'),
        url('/stem/Stem-Light.eot?#iefix') format('embedded-opentype'),
        url('/stem/Stem-Light.woff2') format('woff2'),
        url('/stem/Stem-Light.woff') format('woff'),
        url('/stem/Stem-Light.ttf') format('truetype');
    font-weight: 300;
    font-style: normal;
}
@font-face {
    font-family: 'Stem';
    src: url('/stem/Stem-Medium.eot');
    src: local('Stem Medium'), local('Stem-Medium'),
        url('/stem/Stem-Medium.eot?#iefix') format('embedded-opentype'),
        url('/stem/Stem-Medium.woff2') format('woff2'),
        url('/stem/Stem-Medium.woff') format('woff'),
        url('/stem/Stem-Medium.ttf') format('truetype');
    font-weight: 500;
    font-style: normal;
}
@font-face {
    font-family: 'Stem';
    src: url('/stem/Stem-Bold.eot');
    src: local('Stem Bold'), local('Stem-Bold'),
        url('/stem/Stem-Bold.eot?#iefix') format('embedded-opentype'),
        url('/stem/Stem-Bold.woff2') format('woff2'),
        url('/stem/Stem-Bold.woff') format('woff'),
        url('/stem/Stem-Bold.ttf') format('truetype');
    font-weight: bold;
    font-style: normal;
}
@font-face {
    font-family: 'Stem';
    src: url('/stem/Stem-SemiLight.eot');
    src: local('Stem Semi Light'), local('Stem-SemiLight'),
        url('/stem/Stem-SemiLight.eot?#iefix') format('embedded-opentype'),
        url('/stem/Stem-SemiLight.woff2') format('woff2'),
        url('/stem/Stem-SemiLight.woff') format('woff'),
        url('/stem/Stem-SemiLight.ttf') format('truetype');
    font-weight: 300;
    font-style: normal;
}

@font-face {
    font-family: 'Stem';
    src: url('/stem/Stem-ExtraLight.eot');
    src: local('Stem Extra Light'), local('Stem-ExtraLight'),
        url('/stem/Stem-ExtraLight.eot?#iefix') format('embedded-opentype'),
        url('/stem/Stem-ExtraLight.woff2') format('woff2'),
        url('/stem/Stem-ExtraLight.woff') format('woff'),
        url('/stem/Stem-ExtraLight.ttf') format('truetype');
    font-weight: 200;
    font-style: normal;
}
@font-face {
    font-family: 'Stem';
    src: url('/stem/Stem-Thin.eot');
    src: local('Stem Thin'), local('Stem-Thin'),
        url('/stem/Stem-Thin.eot?#iefix') format('embedded-opentype'),
        url('/stem/Stem-Thin.woff2') format('woff2'),
        url('/stem/Stem-Thin.woff') format('woff'),
        url('/stem/Stem-Thin.ttf') format('truetype');
    font-weight: 100;
    font-style: normal;
}
@font-face {
    font-family: 'Stem';
    src: url('/stem/Stem-Regular.eot');
    src: local('Stem Regular'), local('Stem-Regular'),
        url('/stem/Stem-Regular.eot?#iefix') format('embedded-opentype'),
        url('/stem/Stem-Regular.woff2') format('woff2'),
        url('/stem/Stem-Regular.woff') format('woff'),
        url('/stem/Stem-Regular.ttf') format('truetype');
    font-weight: bold;
    font-style: normal;
}
@font-face {
  font-family: "Stem";
  src: url("/fonts/Stem-Regular.eot");
  src: local("Stem"),
    url("/fonts/Stem-Regular.eot?#iefix") format("embedded-opentype"),
    url("/fonts/Stem-Regular.woff") format("woff"),
    url("/fonts/Stem-Regular.ttf") format("truetype");
  font-weight: 400;
  font-style: normal;
}
*{
  font-family: "Stem", serif;
}
  </style>
  <?php $this->head() ?>
  <!-- /favicon-1.jpg -->

  <?
  function issetFunction($mod){
    if(isset($mod) && !empty($mod)){
      return trim(str_replace('"', '', $mod));
    }
  }
  
  ?>
  <link rel="icon" href="<?= issetFunction(Yii::$app->params['favicon'])?>" sizes="32x32">
  <link rel="icon" href="<?= issetFunction(Yii::$app->params['favicon'])?>" sizes="192x192">
  <link rel="apple-touch-icon" href="<?= issetFunction(Yii::$app->params['favicon'])?>">
  <meta name="msapplication-TileImage" content="<?= issetFunction(Yii::$app->params['favicon'])?>">
  <link rel="image_src" href="<?= issetFunction(Yii::$app->params['shipet'])?>">
  
  
  
  <!-- <link rel="image_src" href='/icon/snippet-vk.jpg'> -->
  <meta property="og:type" content="website" />
  <link property="og:image" href="<?= issetFunction(Yii::$app->params['shipet'])?>">
  <meta property="og:title" content="<?= issetFunction(Yii::$app->params['title'])?>"/>
  <meta property="og:description" content="<?= issetFunction(Yii::$app->params['description'])?>"/>
  <meta property="og:locale" content="<?= $lang?>_<?= mb_strtoupper($lang)?>" />
  <meta property="og:url" content="https://<?= Yii::$app->request->serverName.Url::to(); ?>">
  <meta property="og:site_name" content="<?= (isset(Yii::$app->params['title']) && !empty(Yii::$app->params['title']) ? TitleWidget::widget()." ".issetFunction(Yii::$app->params['title']) : TitleWidget::widget(['type' => 'default']))?>"/>

  <meta property="twitter:image" content="<?= issetFunction(Yii::$app->params['shipet'])?>">
  <meta property="twitter:title" content="<?= issetFunction(Yii::$app->params['title'])?>"/>
  <meta property="twitter:description" content="<?= issetFunction(Yii::$app->params['description'])?>" />

  <meta property="twitter:locale" content="<?= $lang?>_<?= mb_strtoupper($lang)?>" />
  <meta property="twitter:url" content="https://<?= Yii::$app->request->serverName.Url::to(); ?>">

  <meta property="twitter:site_name" content="<?= (isset(Yii::$app->params['title']) && !empty(Yii::$app->params['title']) ? TitleWidget::widget()." ".issetFunction(Yii::$app->params['title']) : TitleWidget::widget(['type' => 'default']))?>"    />

  <meta name="twitter:card" content="summary_large_image" />

  <meta name="format-detection" content="telephone=no">
  <meta http-equiv="x-rim-auto-match" content="none">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <link rel="canonical" href="https://<?= Yii::$app->request->serverName;?>">
  <meta property="article:modified_time" content="2022-03-29T16:33:06+00:00" />
  <meta name="robots" content="max-image-preview:large">
  <meta name="robots" content="index, follow">
  <meta name="bingbot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
  
</head>

<body class="d-flex flex-column">
  <?php $this->beginBody() ?>
  <header style="background-color: <?= ColorWidget::widget(['type' => 'main'])?>">
    <?= Menu::widget() ?>
    <?= InfoBanner::widget();?>
  </header>
  <div class="debug_block" style="display:none">
  <?
  $lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : null;
  $city = isset($_SESSION['city']) ? $_SESSION['city'] : null;
  var_dump($lang, $city);
  ?>
</div>
  <?= $content ?>
  <?= $this->render('footer') ?>
  <? Modal::begin([
    'id' => 'em_video',
    'size' => 'modal-lg'
  ]) ?>
  <div id="video_pop">
  </div>
  <? Modal::end(); ?>
  <div class="wrapper-black">
    <div id="blosker">
    </div>  
  </div>


  <div class="back_to_top">
    <img src="/icon/arr-top.svg" alt="">
  </div>
  <?= LangWidget::widget();?>
  <?= CalbackWedget::widget()?>
  <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
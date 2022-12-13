<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use app\widgets\CalbackWedget;
use app\widgets\LangWidget;
use app\widgets\Menu;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Modal;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
<?php $this->registerCsrfMetaTags() ?>
  <title><?= Html::encode($this->title) ?></title>
  <?php $this->head() ?>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="/login/vendor/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="/login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
  <link rel="stylesheet" type="text/css" href="/login/vendor/animate/animate.css">
  <link rel="stylesheet" type="text/css" href="/login/vendor/css-hamburgers/hamburgers.min.css">
  <link rel="stylesheet" type="text/css" href="/login/vendor/animsition/css/animsition.min.css">
  <link rel="stylesheet" type="text/css" href="/login/vendor/select2/select2.min.css">
  <link rel="stylesheet" type="text/css" href="/login/vendor/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" type="text/css" href="/login/css/util.css">
  <link rel="stylesheet" type="text/css" href="/login/css/main.css">
  <meta name="robots" content="noindex, follow">
</head>

<body>
  <?php $this->beginBody() ?>
  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100 p-t-90 p-b-30">
        <form class="login100-form validate-form">
          <span class="login100-form-title p-b-40">
            Login
          </span>
          <div>
            <a href="#" class="btn-login-with bg1 m-b-10">
              <i class="fa fa-facebook-official"></i>
              Login with Facebook
            </a>
            <a href="#" class="btn-login-with bg2">
              <i class="fa fa-twitter"></i>
              Login with Twitter
            </a>
          </div>
          <div class="text-center p-t-55 p-b-30">
            <span class="txt1">
              Login with email
            </span>
          </div>
          <div class="wrap-input100 validate-input m-b-16" data-validate="Please enter email: ex@abc.xyz">
            <input class="input100" type="text" name="username" placeholder="Email">
            <span class="focus-input100"></span>
          </div>
          <div class="wrap-input100 validate-input m-b-20" data-validate="Please enter password">
            <span class="btn-show-pass">
              <i class="fa fa fa-eye"></i>
            </span>
            <input class="input100" type="password" name="password" placeholder="Password">
            <span class="focus-input100"></span>
          </div>
          <div class="container-login100-form-btn">
            <button class="login100-form-btn">
              Login
            </button>
          </div>
          <div class="flex-col-c p-t-224">
            <span class="txt2 p-b-10">
              Don’t have an account?
            </span>
            <a href="#" class="txt3 bo1 hov1">
              Sign up now
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>



  <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>
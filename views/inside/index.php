<?php

/** @var yii\web\View $this */
/** @var string $content */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
<?php $this->registerCsrfMetaTags() ?>
  <title><?= Html::encode($this->title) ?></title>
  <?php $this->head() ?>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="/login/vendor/animate/animate.css">
  <link rel="stylesheet" type="text/css" href="/login/vendor/css-hamburgers/hamburgers.min.css">
  <link rel="stylesheet" type="text/css" href="/login/vendor/animsition/css/animsition.min.css">
  <link rel="stylesheet" type="text/css" href="/login/vendor/select2/select2.min.css">
  <link rel="stylesheet" type="text/css" href="/login/vendor/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" type="text/css" href="/login/css/util.css">
  <link href="/stem/stylesheet.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="/login/css/main.css">
  <meta name="robots" content="noindex, follow">
</head>

<body>
  <?php $this->beginBody() ?>
  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100 p-t-90 p-b-30">
        
          <? $form =ActiveForm::begin();?>
          <span class="login100-form-title">
            Login
          </span>
          <!-- <div>
            <a href="#" class="btn-login-with bg1 m-b-10">
              <i class="fa fa-facebook-official"></i>
              Login with Facebook
            </a>
            <a href="#" class="btn-login-with bg2">
              <i class="fa fa-twitter"></i>
              Login with Twitter
            </a>
          </div>
           -->
          <div class="text-center  p-b-30">
            <span class="txt1">
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
            <input class="input100" type="password" name="password" placeholder="Пароль">
            <span class="focus-input100"></span>
          </div>
          <div class="container-login100-form-btn">
            <?= Html::submitButton('Вход', ["class"=>"login100-form-btn"])?>
          </div>
        <? ActiveForm::end();?>
      </div>
    </div>
  </div>
  <script src="/login/vendor/jquery/jquery-3.2.1.min.js"></script>
  <script src="/login/vendor/animsition/js/animsition.min.js"></script>
  <script src="/login/vendor/select2/select2.min.js"></script>
  <script src="/login/vendor/daterangepicker/moment.min.js"></script>
  <script src="/login/vendor/daterangepicker/daterangepicker.js"></script>
  <script src="/login/vendor/countdowntime/countdowntime.js"></script>
  <script src="/login/js/main.js"></script>
  <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>
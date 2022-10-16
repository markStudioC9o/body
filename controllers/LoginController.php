<?php

namespace app\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;

/**
 * Default controller for the `admin` module
 */
class LoginController extends Controller
{

  public function actionIndex()
  {
    //$this->layout = 'login';
    return $this->render('ifset');
  }
}

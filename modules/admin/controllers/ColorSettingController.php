<?php

namespace app\modules\admin\controllers;

use app\assets\AdminAsset;
use app\models\Articles;
use app\models\ArticlesOption;
use app\models\CityList;
use app\models\Favicon;
use app\models\FooterHeaderParam;
use app\models\FooterHeaderParamLang;
use yii;
use app\models\Heading;
use app\models\LanguageSetting;
use app\models\MainOption;
use app\models\Pages;
use app\models\SiteSetting;
use Faker\Provider\Lorem;
use yii\web\Controller;
use yii\web\UploadedFile;

/**
 * Default controller for the `admin` module
 */
class ColorSettingController extends MainController
{
  public $title = "Color Setting";
  public function actionIndex(){
    if(Yii::$app->request->isPost){
      $data = Yii::$app->request->post();
      echo "<pre>";
      print_r($data);
      echo "</pre>";
    }
    return $this->render('index');
  }
}
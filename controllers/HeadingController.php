<?php

namespace app\controllers;

use app\models\Articles;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Heading;
use app\models\HeadingLang;
use app\models\HeadingOption;
use app\models\MainOption;
use app\models\MenuImg;
use app\models\Pages;
use app\models\PagesLang;
use app\models\PagesOption;
use app\models\SliderItem;
use yii\helpers\ArrayHelper;

class HeadingController extends MainController
{
  public $heading;
  public function actionIndex($index, $sort = null)
  {
    $lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : null;
    if ($lang == 'ru') {
      $heading = Heading::find()->where(['link' => $index])->one();
    } else {
      $headinLang = HeadingLang::find()->where(['link' => $index])->one();
      $heading = Heading::find()->where(['id' => $headinLang->heading_id])->one();
    }
    $children = Heading::find()->where(['parent_id' => $this->heading->id])->asArray()->all();
    $headingOption = HeadingOption::find()->where(['heading_id' => $heading->id])->all();
    // echo "<pre>";
    // print_r($heading);
    // print_r($children);
    // print_r($headingOption);
    
    // echo "</pre>";
    if ($heading->col == '2') {
      return $this->render('indexTwoColnew', [
        'heading' => $heading,
        'pagesOption' => null,
        'param' => null,
        'colorHex' => null
      ]);
    }
    if ($heading->col == '3') {
      $children = Heading::find()->where(['parent_id' => $this->heading->id])->asArray()->all();
      return $this->render('indexFourCol', [
        'heading' => $this->heading,
        'pagesOption' => null,
        'param' => null,
        'children' => $children,
        'colorHex' => null,
        'sort' => $sort
      ]);
    }
    return $this->render('index', [
      'heading' => $heading,
      'pagesOption' => null,
      'param' => null,
      'colorHex' => null
    ]);
  }
}

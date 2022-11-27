<?php

namespace app\controllers;

use app\assets\AppAsset;
use app\models\ArticleLang;
use app\models\Articles;
use app\models\ArticlesOption;
use app\models\ArticlesOptionLang;
use app\models\Cities;
use app\models\CitiesLang;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Countries;
use app\models\Heading;
use app\models\Pages;
use app\models\PagesOption;
use app\models\SliderItem;
use yii\helpers\ArrayHelper;

class GlobalController extends MainController
{
  public function actionIndex(){
    $request = Yii::$app->request->get();
    if($request['lang'] == 'ru'){
      // link
      if(ArticlesOption::find()->where(['option_param' => 'link'])->andWhere(['value' => $request['index']])->exists()){
        $controller = new ArticlesController('articles', $this->module);
        return $controller->actionIndex($request['index']);
      }
      if(Pages::find()->where(['link' => $request['index']])->exists()){
        $controller = new PagesController('pages', $this->module);
        return $controller->actionIndex($request['index']);
      }
      if(Heading::find()->where(['link' => $request['index']])->exists()){
        $controller = new HeadingController('heading', $this->module);
        return $controller->actionIndex($request['index']);
      }

    }else{
      if(ArticlesOptionLang::find()->where(['option_param' => 'link'])->andWhere(['value' => $request['index']])->exists()){
        $controller = new ArticlesController('articles', $this->module);
        return $controller->actionIndex($request['index']);
      }
    }
    echo __METHOD__;
    // echo "<pre>";
    // print_r($request);
  }
}
<?php

namespace app\controllers;
use app\models\LanguageSetting;
use app\models\SiteSetting;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;


class TestController extends Controller
{
  public function beforeAction($action)
  {
      //echo Yii::$app->request->url;
      
      if(SiteSetting::find()->where(['param' => 'favicon'])->exists()){
        $fav = SiteSetting::find()->where(['param' => 'favicon'])->asArray()->one();
        if(!empty($fav['value'])){
          Yii::$app->params['favicon'] = '/favicon/'.$fav['value'];
        }
      }



      $request = Yii::$app->request->get();
      $session = Yii::$app->session;

      $lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : null;
      
      if(empty($lang)){
        
        if(empty($request['lang'])){
          $newLang = $this->setLang();
          $session->set('lang', $newLang);
        }else{
          if($this->setLest($request['lang'])){
            $session->set('lang', $request['lang']);
          }else{
            $session->set('lang', 'en');
            return $this->redirect('/def-page');
          }
        }
      }else{
        if(isset($request['lang']) && !empty($request['lang']) && $lang != $request['lang'] ){
          
          if($this->setLest($request['lang'])){
            $session->set('lang', $request['lang']);
          }else{

            $session->set('lang', 'en');
            return $this->redirect('/def-page');
          }
        }else{
          // $newLang = $this->setLang();
          // if( !empty($newLang) ){
          //   $session->set('lang', $newLang);
          // }else{
          //   $session->set('lang', 'en');
          // }
        }
      }

      //print_r(Yii::$app->request->get());

      return parent::beforeAction($action);
  }
  public function actionIndex(){
    //$rety =  Yii::$app->runAction(['articles/index', 'articles' => 'chto-takoe-body-balance-clinic']);
    // echo "<pre>";
    // print_r($rety);
    $controller = new ArticlesController('articles', $this->module);
     return $controller->actionIndex('chto-takoe-body-balance-clinic');
  }
  public function actionTest(){
    return $this->render('test');
  }
}


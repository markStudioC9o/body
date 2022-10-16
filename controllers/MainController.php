<?php

namespace app\controllers;

use app\models\LanguageSetting;
use app\models\SiteSetting;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;

class MainController extends Controller
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
      return parent::beforeAction($action);
  }

  public function setLang(){
    $langs = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    if(isset($langs) && !empty($langs)){
      $langList = LanguageSetting::find()->where(['like', 'tag', $langs])->asArray()->one();
      if(!empty($langList)){
        if(isset($langList['tag']) && !empty($langList['tag'])){
          return $langList['tag'];
        }
      }else{
        return null;
      }
    }
  }

  public function setLest($vals){
    if(!$model = LanguageSetting::find()->where(['tag' => $vals])->exists()){
      return false;
    }
    return true;
  }
}
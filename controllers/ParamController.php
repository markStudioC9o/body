<?php

namespace app\controllers;

use app\models\Cities;
use app\models\CoitiesData;
use app\models\Countries;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Controller;

/**
 * Default controller for the `admin` module
 */
class ParamController extends MainController
{

  public function actionSetVideo()
  {
    if (Yii::$app->request->isAjax) {
      $data = Yii::$app->request->post();
      return $this->renderPartial('video-frame', [
        'id' => $data['id']
      ]);
    }
  }
  public function actionLang($tag)

  {
    
    $session = Yii::$app->session;
    
    $country = Countries::find()->where(['tag' => $tag])->one();

    $globalData  = CoitiesData::find()->where(['global' => '1'])->one();
    

    if(!empty($globalData)){
      $cityGlobal = Cities::find()->where(['id'=>$globalData->cities_id])->one();
    }
    if(!empty($country)){
      
      $findCity = Cities::find()->where(['counries_id' => $country->id])->all();
      
      $cityListId = ArrayHelper::getColumn($findCity, 'id');
      $cityData = CoitiesData::find()->where(['cities_id' => $cityListId])->andWhere(['main' => '1'])->one();
      if(!empty($cityData)){
          $city = Cities::find()->where(['id'=>$cityData->cities_id])->one();
          $session->set('city', $city->name);
      }else{
        if(!empty($cityGlobal)){
          $session->set('city', $cityGlobal->name);
        }
      }
    }else{
      if(!empty($cityGlobal)){
        $session->set('city', $cityGlobal->name);
      }
    }
    $url = Url::to([
      'site/index',
      $tag
    ]);
    
    return $this->redirect([Url::home().$tag]);
  }
}

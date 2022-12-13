<?php

namespace app\widgets;

use app\models\Articles;
use app\models\Cities;
use app\models\CitiesLang;
use app\models\CoitiesData;
use app\models\Heading;
use app\models\SortHeader;
use Yii;
use yii\helpers\ArrayHelper;

class CitiesWidget extends \yii\bootstrap4\Widget
{
  public $city;
  public $cosial;
  public $type = null;
  public $cityData = null;
  public $cityHide = null;
  public function run()
  {
    $kontakty = null;
    $nameThisCity = null;
    
    $session = Yii::$app->session;
    $city = isset($_SESSION['city']) ? $_SESSION['city'] : null;
    $lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'en';
    $cityName = null;
    if (empty($city)) {
      $this->cityData = CoitiesData::find()->where(['global' => "1"])->one();
      if (!empty($this->cityData)) {
        if (!empty($lang)) {
          if (CitiesLang::find()->where(['parent_id' => $this->cityData->cities_id])->andWhere(['tag' => $lang])->exists()) {
            $cityName = CitiesLang::find()->where(['parent_id' => $this->cityData->cities_id])->andWhere(['tag' => $lang])->one();
          } else {
            $cityName = Cities::find()->where(['id' => $this->cityData->cities_id])->one();
          }
          $nameThisCity = $cityName->name;
        }else{
          $retyCity = Cities::find()->where(['global' => 1])->one();
          $nameThisCity = $retyCity->name;
        }
      }
    }else{
      if(Cities::find()->where(['like', 'name', $city])->exists()){
        $cityName = Cities::find()->where(['like', 'name', $city])->asArray()->one();
        if(!empty($lang)){
          if(CitiesLang::find()->where(['parent_id' => $cityName['id']])->andWhere(['tag' => $lang])->exists()){
            $nameModelThisCity = CitiesLang::find()->where(['parent_id' => $cityName['id']])->andWhere(['tag' => $lang])->asArray()->one();
            $nameThisCity = $nameModelThisCity['name'];
          }else{
            $nameThisCity = $cityName['name'];
          }
        }
        $this->cityData = CoitiesData::find()->where(['cities_id' => $cityName['id']])->one();
      }
      
    }
    
    if(isset($this->cityData->kontakty) && !empty($this->cityData->kontakty)){
      $kontakty = json_decode($this->cityData->kontakty, true);
    }
    if($this->type == 'mob'){
      if(isset($nameThisCity) && !empty($nameThisCity)){
        $show = $this->cityHide;
        if(isset($show->value)){
          if($show->value == 'show'){
            return $nameThisCity;
          }else{
            return null;  
          }
        }else{
          return $nameThisCity;
        }
        
      }else{
        return null;
      }
    }
    
    if($this->type == 'phone'){
      if (isset($kontakty['phone']) && !empty($kontakty['phone'])){
        return $kontakty['phone'];
      }
    }
    if(!isset($cityName['id']) && empty($cityName['id'])){
      $globcon = CoitiesData::find()->where(['global' => 1])->asArray()->one();
      $sledId = $globcon['cities_id'];
    }else{
      if(isset($cityName['parent_id']) && !empty($cityName['parent_id'])){
        $sledId = $cityName['parent_id'];
      }else{
        $sledId = $cityName['id'];
      }
      
    }
    $serty = SortHeader::find()->where(['parent_id' => $sledId])->asArray()->one();
    if(!empty($serty['value'])){
      $sort = json_decode($serty['value'], true);
    }else{
      $sort = null;
    }
      return $this->render('cities', [
        'nameThisCity' => $nameThisCity,
        'cityName' => $cityName,
        'city' => $this->city,
        'cosial' => $this->cosial,
        'kontakty' => $kontakty,
        'sort' => $sort,
        'cityHide' => $this->cityHide
      ]);
    
  }
}

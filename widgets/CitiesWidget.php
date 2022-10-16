<?php

namespace app\widgets;

use app\models\Articles;
use app\models\Cities;
use app\models\CitiesLang;
use app\models\CoitiesData;
use app\models\Heading;
use Yii;
use yii\helpers\ArrayHelper;

class CitiesWidget extends \yii\bootstrap4\Widget
{
  public $city;
  public $cosial;
  public $type = null;
  public $cityData = null;
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
        return $nameThisCity;
      }else{
        return null;
      }
    }
    
    if($this->type == 'phone'){
      if (isset($kontakty['phone']) && !empty($kontakty['phone'])){
        return $kontakty['phone'];
      }
    }
    
      return $this->render('cities', [
        'nameThisCity' => $nameThisCity,
        'cityName' => $cityName,
        'city' => $this->city,
        'cosial' => $this->cosial,
        'kontakty' => $kontakty
      ]);
    
  }
}

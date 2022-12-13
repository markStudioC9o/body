<?php

namespace app\widgets;

use app\controllers\SiteController;
use app\models\Cities;
use app\models\CitiesLang;
use app\models\CityList;
use app\models\CoitiesData;
use app\models\LanguageSetting;
use app\models\MainOption;
use app\models\SiteSetting;
use Yii;

class FooterContact extends \yii\bootstrap4\Widget
{
  public $city;
  public $cosial;
  public $cityData = null;


  public function run()
  {

    $kontakty = null;
    $session = Yii::$app->session;
    $city = isset($_SESSION['city']) ? $_SESSION['city'] : null;
    $lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'ru';
    if (empty($city)) {
      $this->cityData = CoitiesData::find()->where(['global' => '1'])->one();
      if (!empty($this->cityData)) {
        if (!empty($lang)) {
          if (CitiesLang::find()->where(['parent_id' => $this->cityData->cities_id])->andWhere(['tag' => $lang])->exists()) {
            $cityName = CitiesLang::find()->where(['parent_id' => $this->cityData->cities_id])->andWhere(['tag' => $lang])->one();
          } else {
            $cityName = Cities::find()->where(['id' => $this->cityData->cities_id])->one();
          }
        }
      }
    }else{
      if(Cities::find()->where(['like', 'name', $city])->exists()){
        $cityName = Cities::find()->where(['like', 'name', $city])->one();
        $this->cityData = CoitiesData::find()->where(['cities_id' => $cityName->id])->one();
      }
    }
    

    if (isset($this->cityData->kontakty) && !empty($this->cityData->kontakty)) {
      $kontakty = json_decode($this->cityData->kontakty, true);
    }

    $title = SiteSetting::find()->where(['param'=>'footer-title'])->andWhere(['tag' => $lang])->asArray()->one();
    if(isset($title['value']) && !empty($title['value'])){
      $titarray = json_decode($title['value'], true);
    }else{
      $titarray = null;
    }
    return $this->render('contact_footer', [
      'footerImage' => SiteSetting::find()->where(['param' => 'image-footer'])->one(),
      'data' => $this->cityData,
      'kontakty' => $kontakty,
      'titarray' => $titarray
    ]);
  }
}

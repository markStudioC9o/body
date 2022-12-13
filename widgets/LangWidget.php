<?php

namespace app\widgets;

use app\models\Articles;
use app\models\Cities;
use app\models\CitiesLang;
use app\models\CoitiesData;
use app\models\Countries;
use app\models\CountriesLang;
use app\models\Heading;
use app\models\SiteSetting;
use Yii;
use yii\helpers\ArrayHelper;

class LangWidget extends \yii\bootstrap4\Widget
{
  public $city;
  public $cosial;
  public $cityData = null;
  public function run()
  {
    $session = Yii::$app->session;
    $city = isset($_SESSION['city']) ? $_SESSION['city'] : null;
    $lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : null;
    if(empty($lang)){
      $lang = 'ru';
    }
    $country = Countries::find()->where(['tag' => $lang])->one();
    $countryDop = CountriesLang::find()->where(['tag' => $lang])->all();
    if(!empty($city)){
      $main =  CoitiesData::find()->where(['global' =>'1'])->one();
    }

    $title = SiteSetting::find()->where(['param' => 'modal-title'])->andWhere(['tag' => $lang])->asArray()->one();
    return $this->render('lang',[
      'country' => $country,
      'countryDop' => $countryDop,
      'title' => $title
    ]);
  }
}

<?php

namespace app\widgets;

use app\models\CityList;
use app\models\LanguageSetting;
use app\models\MainOption;
use app\models\MenuParam;
use app\models\Pages;
use app\models\SiteSetting;
use Yii;

class Menu extends \yii\bootstrap4\Widget
{
  public function run()
  {
    $menuArr = array();
    $modelMenu = MainOption::find()->where(['key_param' => 'menu_list'])->asArray()->one();
    if (!empty($modelMenu['value'])) {
      $menuArr = json_decode($modelMenu['value'], true);
    }

    
    $city = array();
    $cityParam = MainOption::find()->where(['key_param' => 'city_param'])->asArray()->one();
    if (!empty($cityParam['value'])) {
      $city = json_decode($cityParam['value'], true);
    }
    $session = Yii::$app->session;
    $lang = $session->get('lang');
    if (!empty($lang)) {
      $langId = LanguageSetting::find()->where(['tag' => $lang])->asArray()->one();
      if(CityList::find()->where(['lang' => $langId['id']])->exists()){
        $city = CityList::find()->where(['lang' => $langId['id']])->one();
      }else{
        $city = CityList::find()->one();
      }
    }else{
     $lang = 'en';
      $city = CityList::find()->one();
    }
    $pages = new Pages();
    $cosial = MainOption::find()->where(['key_param' => 'cosial_param'])->asArray()->one();

    $linkShop = SiteSetting::find()->where(['param' => 'shop-attr'])->andWhere(['tag' => $lang])->asArray()->one();
    if(!empty($linkShop) && !empty($linkShop['value'])){
      $textLink = $linkShop['value'];
    }else{
      $textLink = "Магазин";
    }

    $hrefShop = SiteSetting::find()->where(['param' => 'shop-link'])->asArray()->one();
    $menuParam = new MenuParam();
    
    return $this->render('menu', [
      'menuArr' => $menuArr,
      'pages' => $pages,
      'city' => $city,
      'cosial' => json_decode($cosial['value'], true),
      'textLink' => $textLink,
      'hrefShop' => $hrefShop,
      'lang' => $lang,
      'menuParam' => $menuParam
    ]);
  }
}

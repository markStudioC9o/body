<?php

namespace app\widgets;

use app\models\CityList;
use app\models\LanguageSetting;
use app\models\MainOption;
use app\models\Pages;
use app\models\SiteSetting;
use Yii;

class FooterMenu extends \yii\bootstrap4\Widget
{
  public function run()
  {
    $menuArr = array();
    $modelMenu = MainOption::find()->where(['key_param' => 'menu_bottom'])->asArray()->one();
    if (!empty($modelMenu['value'])) {
      $menuArr = json_decode($modelMenu['value'], true);
    }
    $session = Yii::$app->session;
    $lang = $session->get('lang');
    $langId = LanguageSetting::find()->where(['tag' => $lang])->asArray()->one();
    $pages = new Pages();
    
    return $this->render('footer-menu', [
      'menuArr' => $menuArr,
      'pages' => $pages,
    ]);
  }
}

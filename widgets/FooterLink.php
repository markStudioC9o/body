<?php

namespace app\widgets;

use app\models\CityList;
use app\models\FooterHeaderParam;
use app\models\FooterHeaderParamLang;
use app\models\LanguageSetting;
use app\models\MainOption;
use Yii;

class FooterLink extends \yii\bootstrap4\Widget
{
  public function run()
  {
    $lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'ru';
    if($lang == 'ru' || empty($lang)){
      $link = FooterHeaderParam::find()->where(['param' => 'link'])->asArray()->one();
    }else{
      $link = FooterHeaderParamLang::find()->where(['param' => 'link'])->andWhere(['tag' => $lang])->asArray()->one();
    }
    
    return $this->render('footer-link',[
      'link' => $link
    ]);
  }
}

<?php

namespace app\widgets;

use app\models\CityList;
use app\models\FooterHeaderParam;
use app\models\FooterHeaderParamLang;
use app\models\LanguageSetting;
use app\models\MainOption;
use Yii;

class FooterInformer extends \yii\bootstrap4\Widget
{
  public function run()
  {
    $lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'ru';
    if(empty($lang) || $lang == 'ru'){
      $informer = FooterHeaderParam::find()->where(['param' => 'inform'])->asArray()->one();
    }else{
      $informer = FooterHeaderParamLang::find()->where(['param' => 'inform'])->andWhere(['tag' => $lang])->asArray()->one();
    }
    if(!empty($informer['value'])){
      $resVart = json_decode($informer['value'] ,true);
      $str = "<div class=\"inf-tit\">".$resVart['title']."</div><div class=\"inf-text\">".$resVart['text']."</div>";
      return $str;
    }
    return null;
    
  }
}

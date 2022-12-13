<?php

namespace app\widgets;

use app\models\MainOption;
use app\models\Pages;
use app\models\SiteSetting;
use app\models\VideoList;
use Yii;

class TitleWidget extends \yii\bootstrap4\Widget
{
  public $type = null;
  public function run()
  {
    if($this->type == 'default'){
      $titleDefault = SiteSetting::find()->where(['param' => 'title_default'])->one();

      if(!empty($titleDefault->value)){
        return $titleDefault->value;
      }else{
        return null;
      };
    }else{
      $titleCustom = SiteSetting::find()->where(['param' => 'title_custom'])->one();
    }
    if(!empty($titleCustom->value)){
      return $titleCustom->value;
    }else{
      return null;
    };
    
  }
}
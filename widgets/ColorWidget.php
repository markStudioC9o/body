<?php

namespace app\widgets;

use app\models\SiteSetting;
use Yii;
use yii\helpers\ArrayHelper;

class ColorWidget extends \yii\bootstrap4\Widget
{
  public $type;
  public function run()
  {
    if($this->type == 'main'){
      if(SiteSetting::find()->where(['param' => 'SiteMainColor'])->exists()){
        $SiteMainColor =  SiteSetting::find()->where(['param' => 'SiteMainColor'])->asArray()->one();
        return $SiteMainColor['value'];
      }else{
        return '#00a6ca';
      }
    }elseif($this->type == 'dop'){
      if(SiteSetting::find()->where(['param' => 'SiteDopColor'])->exists()){
        $SiteMainColor =  SiteSetting::find()->where(['param' => 'SiteDopColor'])->asArray()->one();
        return $SiteMainColor['value'];
      }else{
        return '#007d96';
      }
    }else{

      if(SiteSetting::find()->where(['param' => 'SiteAcsentColor'])->exists()){
        $SiteAcsentColor =  SiteSetting::find()->where(['param' => 'SiteAcsentColor'])->asArray()->one();
        return $SiteAcsentColor['value'];
      }else{
        return '#dbf9ff';
      }

    }
  }
}

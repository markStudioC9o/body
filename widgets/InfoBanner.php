<?php

namespace app\widgets;

use app\models\Articles;
use app\models\Heading;
use app\models\HeadingLang;
use app\models\HeadingOption;
use app\models\SiteSetting;
use Yii;

class InfoBanner extends \yii\bootstrap4\Widget
{
  public function run()
  {
    $lang = LangStat::widget();
    $model = SiteSetting::find()->where(['param' => 'banners'])->andWhere(['tag' => $lang])->asArray()->one();
    $active = SiteSetting::find()->where(['param' => 'activeBannersTitle'])->andWhere(['tag' => $lang])->one();
    if(isset($active->value) && $active->value == '1'){
      return $this->render('info-banner',[
        'model' => $model
      ]);
    }
  }
}

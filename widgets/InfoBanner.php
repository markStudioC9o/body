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
    $lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'en';
    $model = SiteSetting::find()->where(['param' => 'banners'])->andWhere(['tag' => $lang])->asArray()->one();
    return $this->render('info-banner',[
      'model' => $model
    ]);
  }
}

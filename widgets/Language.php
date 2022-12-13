<?php

namespace app\widgets;

use app\models\LanguageSetting;
use Yii;

class Language extends \yii\bootstrap4\Widget
{
  public function run()
  {
    $session = Yii::$app->session;
    $lang = $session->get('lang');
    if(!empty($lang)){
      $active = LanguageSetting::find()->where(['tag' => $lang])->asArray()->one();
    }else{
      $active = LanguageSetting::find()->where(['tag' => 'ru'])->asArray()->one();
    }
    $model = LanguageSetting::find()->asArray()->all();
    return $this->render('langView', [
      'model' => $model,
      'active' => $active
    ]);
  }
}

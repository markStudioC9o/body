<?php

namespace app\widgets;

use app\controllers\SiteController;
use app\models\SiteSetting;
use Yii;

class FooterDisc extends \yii\bootstrap4\Widget
{

  public function run()
  {
    $lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : null;
    $model = SiteSetting::find()->where(['param'=>'val_authors'])->andWhere(['tag' => $lang])->asArray()->one();
    if(!empty($model) && !empty($model['value'])){
      return $model['value'];
    }else{
      return "© Авторское право \"Баланс Тела\", 2020";
    }
  }
}

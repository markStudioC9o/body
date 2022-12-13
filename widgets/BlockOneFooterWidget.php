<?php

namespace app\widgets;

use app\models\Articles;
use app\models\SiteSetting;
use Yii;
use yii\helpers\ArrayHelper;

class BlockOneFooterWidget extends \yii\bootstrap4\Widget
{
  public function run()
  {
    $lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'ru';
    $con = null;
    $model = SiteSetting::find()->where(['param' => 'pre_footer'])->andWhere(['tag' => $lang])->asArray()->one();
    if(isset($model['value']) && !empty($model['value'])){
      $con = $model['value'];
    }
    return $this->render('blockOne',[
      'con' => $con
    ]);
  }
}
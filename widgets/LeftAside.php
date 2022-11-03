<?php

namespace app\widgets;

use app\models\MainOption;
use app\models\Pages;
use app\models\Widget;
use Yii;

class LeftAside extends \yii\bootstrap4\Widget
{
  public $listWidget;

  public function run()
  {
    $widget = new Widget();
    $lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'en';
    if(empty($this->listWidget)) return;
    $list = json_decode($this->listWidget['value'], true);
    $model = Widget::find()->where(['id' => $list])->asArray()->all();
    return $this->render('left-aside', [
      'model' => $model,
      'widget' => $widget,
      'lang' => $lang
    ]);
  }
}

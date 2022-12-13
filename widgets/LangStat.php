<?php

namespace app\widgets;
use Yii;

class LangStat extends \yii\bootstrap4\Widget
{
  public function run()
  {
    $lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'en';
    return $lang;
  }
}

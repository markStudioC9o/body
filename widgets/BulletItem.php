<?php

namespace app\widgets;

use app\models\Articles;
use app\models\Heading;
use app\models\HeadingLang;
use app\models\HeadingOption;
use Yii;

class BulletItem extends \yii\bootstrap4\Widget
{
  public $viewSlider;
  public function run()
  {
    $lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : null;
    return $this->render('bullet',[
      'viewSlider' => $this->viewSlider,
      'lang' => $lang
    ]);
  }
}

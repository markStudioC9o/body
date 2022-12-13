<?php

namespace app\widgets;

use app\models\CityList;
use app\models\FormBilder;
use app\models\LanguageSetting;
use app\models\MainOption;
use Yii;

class FormBlock extends \yii\bootstrap4\Widget
{
  public function run()
  {
    $model = FormBilder::find()->all();
    return $this->render('form-bilder',[
      'model' => $model
    ]);
  }
}

<?php

namespace app\widgets;

use app\models\Articles;
use app\models\CallbacField;
use app\models\CallbacFieldLang;
use app\models\CallbackParam;
use app\models\CallbackParamLang;
use app\models\CallbacOption;
use app\models\CallbacWidget;
use app\models\CallbacWidgetLang;
use app\models\CillbacOptionLang;
use app\models\Heading;
use Yii;
use yii\helpers\ArrayHelper;

class CalbackWedget extends \yii\bootstrap4\Widget
{
  public function run()
  {
    $lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'en';
    $field = array();
    $arrayParam = array();

    if ($lang == 'ru') {
      $model = CallbacWidget::find()->where(['active' => '1'])->all();
      $option = CallbacOption::find()->asArray()->all();
      $con = CallbacOption::find()->where(['param' => 'con'])->asArray()->one();

      if (!empty($model)) {
        foreach ($model as $item) {
          $field[$item->id] = CallbacField::find()->where(['widget_1' => $item->id])->andWhere(['active' => '1'])->asArray()->all();
        }
      }
      $param = CallbackParam::find()->asArray()->all();
      $btn = CallbacOption::find()->where(['param' => 'button'])->asArray()->one();
      $text = CallbacOption::find()->where(['param' => 'text'])->asArray()->one();
      $name = CallbacOption::find()->where(['param' => 'name'])->asArray()->one();
    } else {
      $btn = CillbacOptionLang::find()->where(['param' => 'button'])->andWhere(['tag' => $lang])->asArray()->one();
      $text = CillbacOptionLang::find()->where(['param' => 'text'])->andWhere(['tag' => $lang])->asArray()->one();
      $model = CallbacWidgetLang::find()->where(['active' => '1'])->andWhere(['tag' => $lang])->all();
      $option = CillbacOptionLang::find()->asArray()->andWhere(['tag' => $lang])->all();
      $con = CillbacOptionLang::find()->where(['param' => 'con'])->andWhere(['tag' => $lang])->asArray()->one();
      $param = CallbackParamLang::find()->andWhere(['tag' => $lang])->asArray()->all();
      $name = CillbacOptionLang::find()->where(['param' => 'name'])->andWhere(['tag' => $lang])->asArray()->one();
      if (!empty($model)) {
        foreach ($model as $item) {
          $field[$item->parent_id] = CallbacFieldLang::find()->where(['widget_1' => $item->parent_id])->andWhere(['active' => '1'])->andWhere(['tag' => $lang])->asArray()->all();
        }
      }
    }

    foreach ($param as $elem) {
      $arrayParam[$elem['widget_id']][] = [
        $elem['param'] => $elem['value']
      ];
    }
    $mapOption = ArrayHelper::map($option, 'param', 'value');
    return $this->render('calbac', [
      'btn' => $btn,
      'text' => $text,
      'model' => $model,
      'field' => $field,
      'con' => json_decode($con['value'], true),
      'mapOption' => $mapOption,
      'arrayParam' => $arrayParam,
      'name' => $name,
      'lang' => $lang,
      'param' => $param
    ]);
  }
}


 
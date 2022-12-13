<?php

namespace app\controllers;

use app\models\Articles;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Heading;
use app\models\MainOption;
use app\models\MenuImg;
use app\models\Pages;
use app\models\PagesLang;
use app\models\PagesOption;
use app\models\SliderItem;
use yii\helpers\ArrayHelper;

class PagesController extends MainController
{
  public $heading;
  public function actionIndex($index, $sort = null)
  {

    $colorHex = '';
    $model = Pages::find()->where(['link' => $index])->one();
    if (empty($model)) {
      $modelLang = PagesLang::find()->where(['link' => $index])->one();
      $model = Pages::find()->where(['id' => $modelLang->parent_id])->one();
    }
    $pagesOption = array(
      'type' => PagesOption::find()->where(['pages_id' => $model->id])->andWhere(['option_param' => 'type'])->asArray()->one(),
      'slide' => PagesOption::find()->where(['pages_id' => $model->id])->andWhere(['option_param' => 'slide'])->asArray()->one(),
      'widget' => PagesOption::find()->where(['pages_id' => $model->id])->andWhere(['option_param' => 'widget'])->asArray()->one()
    );


    if (MenuImg::find()->where(['parent_id' => "item_" . $model->id])->exists()) {
      $colorHex = MenuImg::find()->where(['parent_id' => "item_" . $model->id])->one();
    }

    if (!empty($pagesOption['type']['value'])) {
      $type = json_decode($pagesOption['type']['value'], true);
    }
    if (isset($type) && !empty($type)) {
      if (isset($type[0]) && !empty($type[0])) {
        if ($type[0] == "categ") {
          $this->heading = Heading::findOne($type[1]);
        }
      }
    }
    $param = PagesOption::find()->where(['pages_id' => $model->id])->asArray()->all();
    $param = ArrayHelper::map($param, 'option_param', 'value');
    if (!empty($this->heading)) {
      if ($this->heading->col == '2') {
        return $this->render('indexTwoCol', [
          'pagesOption' => $pagesOption,
          'param' => $param,
          'colorHex' => $colorHex
        ]);
      }
      if ($this->heading->col == '3') {
        $children = Heading::find()->where(['parent_id' => $this->heading->id])->asArray()->all();
        return $this->render('indexFourCol', [
          'heading' => $this->heading,
          'pagesOption' => $pagesOption,
          'param' => $param,
          'children' => $children,
          'colorHex' => $colorHex,
          'sort' => $sort
        ]);
      }
    }
    return $this->render('index', [
      'pagesOption' => $pagesOption,
      'param' => $param,
      'colorHex' => $colorHex
    ]);
  }
}

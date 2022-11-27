<?php

namespace app\controllers;

use app\assets\AdminAsset;
use app\models\ArticleLang;
use app\models\Articles;
use app\models\ArticlesOption;
use app\models\ArticlesOptionLang;
use app\models\Authors;
use app\models\GqlleryHtml;
use app\models\Heading;
use app\models\SiteSetting;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;


class ArticlesController extends MainController
{
  public function actionIndex($articles)
  {
    $index = $articles;

    $sizeSes = isset($_SESSION['size']) ? $_SESSION['size'] : null;
    $lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : null;

    if ($lang == 'ru') {
      if (ArticlesOption::find()->where(['option_param' => 'link'])->andWhere(['value' => $index])->exists()) {
        $model = ArticlesOption::find()->where(['option_param' => 'link'])->andWhere(['value' => $index])->asArray()->one();
        $index = $model['articles_id'];
      }
    } else {
      if (ArticlesOptionLang::find()->where(['option_param' => 'link'])->andWhere(['value' => $index])->andWhere(['tag' => $lang])->exists()) {
        $model = ArticlesOptionLang::find()->where(['option_param' => 'link'])->andWhere(['value' => $index])->andWhere(['tag' => $lang])->asArray()->one();
        $index = $model['articles_id'];
      }
    }
    if (!empty($sizeSes)) {
      if ($sizeSes > 1680) {
        $stecSize = "1680";
      } elseif ($sizeSes < 1680 && $sizeSes > 1440) {
        $stecSize = "1680";
      } elseif ($sizeSes < 1440 && $sizeSes > 1280) {
        $stecSize = "1440";
      } elseif ($sizeSes < 1280 && $sizeSes > 1024) {
        $stecSize = "1280";
      } elseif ($sizeSes < 1024) {
        $stecSize = "375";
      } else {
        $stecSize = null;
      }
    }

    $articlesLang = ArticleLang::find()->where(['parent_id' => $index]);
    if (isset($lang) && !empty($lang)) {
      if (ArticleLang::find()->where(['parent_id' => $index])->andWhere(['lang' => $lang])->andWhere(['size' => $stecSize])->exists()) {
        $model = ArticleLang::find()->where(['parent_id' => $index])->andWhere(['lang' => $lang])->andWhere(['size' => $stecSize])->one();
      } else {
        if (ArticleLang::find()->where(['parent_id' => $index])->andWhere(['lang' => $lang])->andWhere(['size' => '1680'])->exists()) {
          $model = ArticleLang::find()->where(['parent_id' => $index])->andWhere(['lang' => $lang])->andWhere(['size' => '1680'])->one();
        } else {
          $model = Articles::find()->where(['id' => $index])->one();
        }
      }
    } else {
      if (ArticleLang::find()->where(['parent_id' => $index])->andWhere(['size' => $stecSize])->exists()) {
        $model = ArticleLang::find()->where(['parent_id' => $index])->andWhere(['size' => $stecSize])->one();
      } else {
        $model = Articles::find()->where(['id' => $index])->one();
      }
    }

    if ($lang == 'ru') {
      $options = ArticlesOption::find()->where(['articles_id' => $index])->asArray()->all();
    } else {
      $options = ArticlesOptionLang::find()->where(['articles_id' => $index])->andWhere(['tag' => $lang])->asArray()->all();
    }

    $param = array();
    if (!empty($options)) {
      $param = ArrayHelper::map($options, 'option_param', 'value');
    }
    if (isset($param['shipet']) && !empty($param['shipet'])) {
      Yii::$app->params['shipet'] = '/shipet/' . $param['shipet'];
    }else{
      // echo "<pre>";
      // print_r($param);
      Yii::$app->params['shipet'] = '/gallery/' . $param['img_articles'];
    }
    if (isset($param['keywords']) && !empty($param['keywords'])) {
      Yii::$app->params['keywords'] = $param['keywords'];
    }
    if (isset($param['description']) && !empty($param['description'])) {
      Yii::$app->params['description'] = $param['description'];
    }
    if (isset($param['title']) && !empty($param['title'])) {
      Yii::$app->params['title'] = $param['title'];
    }
    $breadcrambs = SiteSetting::find()->where(['param'=>'breadcrambs'])->andWhere(['tag' => $lang])->asArray()->one();
    $heading = new Heading();
    return $this->render('index', [
      'model' => $model,
      'param' => $param,
      'lang' => $lang,
      'stecSize' => $stecSize,
      'heading' => $heading,
      'breadcrambs'=>$breadcrambs
    ]);
  }
}

<?php

namespace app\widgets;

use app\models\ArticleLang;
use app\models\Articles;
use app\models\ArticlesOption;
use app\models\ArticlesOptionLang;
use app\models\Heading;
use app\models\HeadingLang;
use app\models\HeadingOption;
use Yii;
use yii\helpers\ArrayHelper;

class ContentWidget extends \yii\bootstrap4\Widget
{
  public $content;
  public $sort = null;
  public $color = null;
  public $type = null;
  public function run()
  {

    //return '123';
    if ($this->type == 'heading') {
      return $this->getCategory($this->content->id);
    } else {
      $param = $this->content;
      $articles = json_decode($param['value'], true);
      if ($articles[0] == 'arcticles') {
        return $this->getContent($articles[1]);
      }
      if ($articles[0] == 'categ') {
        return $this->getCategory($articles[1]);
      }
    }
  }

  public function getContent($id)
  {
    $lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'en';
    if ($lang == 'ru') {
      $model = Articles::find()->where(['id' => $id])->asArray()->one();
      $options = ArticlesOption::find()->where(['articles_id' => $id])->asArray()->all();
    } else {
      $model = ArticleLang::find()->where(['parent_id' => $id])->andWhere(['lang' => $lang])->asArray()->one();
      $options = ArticlesOptionLang::find()->where(['articles_id' => $id])->andWhere(['tag' => $lang])->asArray()->all();
    }
    $param = array();
    if (!empty($options)) {
      $param = ArrayHelper::map($options, 'option_param', 'value');
    }
    if (isset($param['shipet']) && !empty($param['shipet'])) {
      Yii::$app->params['shipet'] = '/shipet/' . $param['shipet'];
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
    return $this->render('content', [
      'model' => $model
    ]);
  }
  public function getCategory($id)
  {
    $lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'en';

    $model = Heading::find()->where(['id' => $id])->one();
    if (HeadingLang::find()->where(['heading_id' => $id])->andWhere(['tag' => $lang])->exists()) {
      $modelName = HeadingLang::find()->where(['heading_id' => $id])->andWhere(['tag' => $lang])->one();
    } else {
      if ($lang == 'ru') {
        $modelName = $model;
      } else {
        $modelName = null;
      }
    }
    $option = HeadingOption::find()->where(['heading_id' => $id])->asArray()->all();
    $category = $model->getArticles($this->sort);

    return $this->render('category', [
      'option' => $option,
      'model' => $model,
      'category' => $category,
      'color' => $this->color,
      'modelName' => $modelName,
      'lang' => $lang
    ]);
  }
}

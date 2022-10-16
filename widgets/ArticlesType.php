<?php

namespace app\widgets;

use app\models\Articles;
use app\models\Heading;
use Yii;
use yii\helpers\ArrayHelper;

class ArticlesType extends \yii\bootstrap4\Widget
{
  public $articles;
  public $option;
  public function run()
  {
    $param = ArrayHelper::getColumn($this->articles, 'articles_id');

    return $this->getArticles($param);
  }

  public function getArticles($articles){
    $model = Articles::find()->where(['id' => $articles])->asArray()->all();
    $array = ArrayHelper::map(Articles::find()->asArray()->all(), 'id','text');
    return $this->render('articles-type',['array' => $array, 'option' => $this->option]);
  }
}

<?php

namespace app\widgets;

use app\models\Articles;
use app\models\Heading;
use Yii;

class ContentFourColWidget extends \yii\bootstrap4\Widget
{
  public $content;
  public $color = null;
  public $sort = null;
  public $heading = null;
  public $type = null;
  public function run()
  {

    //return '123';
    $param = $this->content;
    $articles = json_decode($param['value'], true);
    
    if ($articles[0] == 'arcticles') {
      return $this->getContent($articles[1], $this->sort);
    }
    if ($articles[0] == 'categ' || $this->type == "categ") {
      $heading = $this->heading;
      return $this->getCategory($heading->id, $this->sort );
    }
  }

  public function getContent($id, $sort)
  {
    // print_r($this->heading);
    // print_r('123');
    $query = Articles::find()->where(['id' => $id])->asArray();
    $model = $query->one(); 
    return $this->render('content',[
      'model' => $model
    ]);
  }

  public function getCategory($id, $sort)
  {
    $model = Heading::find()->where(['id' => $id])->one();
    $category = $model->getArticles($sort);
    return $this->render('categoryFour',[
      'col' => $model->col,
      'model' => $model,
      'category' =>$category,
      'color' => $this->color
    ]);
  }

}

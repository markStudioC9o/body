<?php

namespace app\widgets;

use app\models\Articles;
use app\models\Heading;
use app\models\HeadingLang;
use app\models\HeadingOption;
use Yii;

class ContentTwoColWidget extends \yii\bootstrap4\Widget
{
  public $content;
  public $heading = null;
  public $color= null;
  public $sort = null;
  public $type = null;
  public function run()
  {

    //return '123';
    $param = $this->content;
    $articles = json_decode($param['value'], true);
    
    if ($articles[0] == 'arcticles' || $this->type == 'arcticles') {
      return $this->getContent($articles[1]);
    }
    if ($articles[0] == 'categ' || $this->type == 'categ') {
      if(!empty($this->heading)){
        return $this->getCategory($this->heading->id);  
      }else{
        return $this->getCategory($articles[1]);  
      }
      
    }
    
  }
  
  public function getContent($id)
  {
    $model = Articles::find()->where(['id' => $id])->asArray()->one();
    return $this->render('content',[
      'model' => $model
    ]);
  }




  public function getCategory($id)
  {
    $lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'en';
    $model = Heading::find()->where(['id' => $id])->one();
    if(HeadingLang::find()->where(['heading_id' => $id])->andWhere(['tag' => $lang])->exists()){
      $modelName = HeadingLang::find()->where(['heading_id' => $id])->andWhere(['tag' => $lang])->one();
    }else{
      if($lang == 'ru'){
        $modelName = $model;
      }else{
        $modelName = null;
      }
    }
    
    $category = $model->getArticles();
    $option = HeadingOption::find()->where(['heading_id' => $id])->asArray()->all();
    return $this->render('category',[
      'option' => $option,
      'col' => $model->col,
      'model' => $model,
      'category' =>$category,
      'color' => $this->color,
      'modelName' => $modelName
    ]);
  }

}

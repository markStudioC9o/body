<?php

namespace app\modules\admin\controllers;

use app\assets\AdminAsset;
use app\models\ArticleLang;
use app\models\Articles;
use app\models\ArticlesOption;
use app\models\Authors;
use app\models\GqlleryHtml;
use app\models\Heading;
use app\models\LanguageSetting;
use app\models\VideoList;
use app\models\Widget;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class ImageController extends MainController
{
  public function actionRemoveImage(){
    if(Yii::$app->request->isAjax){
      $data = Yii::$app->request->post();
      if(isset($data['src']) && !empty($data['src'])){
        $filePath = Yii::getAlias('@webroot').$data['src'];
        if(file_exists($filePath)){
          if(unlink($filePath)){
            return  true;
          }else{
            return  false;
          }
        }else{
          return false;
        }
      }
    }
  }

  public function actionCadring(){
    if(Yii::$app->request->isAjax){
      $data = Yii::$app->request->post();
      return $this->renderAjax('modal',['data' => $data]);
    }
  }
}
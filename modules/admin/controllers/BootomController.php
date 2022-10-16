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

class BootomController extends MainController
{
  public function actionParam(){
    if(Yii::$app->request->isAjax){
      $randId = rand(0, 999);
      return $this->renderPartial('boot', [
        "randId" =>$randId
      ]);
    }
  }

  public function actionParamBoot(){
    if(Yii::$app->request->isAjax){
      $data = Yii::$app->request->post();
      return $this->renderPartial('boot-param',[
        'data' => $data
      ]);
    }
  }
}
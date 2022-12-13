<?php

namespace app\modules\admin\controllers;

use app\assets\AdminAsset;
use app\models\Articles;
use app\models\LanguageSetting;
use app\models\VideoList;
use app\models\Widget;
use app\models\WidgetBanner;
use app\models\WidgetLang;
use app\models\WidgetParam;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * WidgetController implements the CRUD actions for Widget model.
 */
class VideoController extends MainController
{
  public function actionVideoParam()
  {
    if(Yii::$app->request->isAjax){
      $data = Yii::$app->request->post();
      return $this->renderPartial("video-param", [
        "data" => $data
      ]);
    }
  }

  public function actionDeleteVideo(){
    if(Yii::$app->request->isAjax){
      $data = Yii::$app->request->post();
      $model = VideoList::findOne($data['id']);
      if($model->delete()){
        return true;
      }
    }
  }
}

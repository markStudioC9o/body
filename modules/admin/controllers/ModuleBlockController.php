<?php

namespace app\modules\admin\controllers;

use app\assets\AdminAsset;
use app\models\LanguageSetting;
use app\models\Widget;
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
class ModuleBlockController extends MainController
{
  public $title;

  public function actionTextCol()
  {
    if(Yii::$app->request->isAjax){
      $data = Yii::$app->request->post();
      return $this->renderPartial('text/text-param',[
        'data' => $data
      ]);
    }
  }
  
}

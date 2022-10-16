<?php

namespace app\modules\admin\controllers;

use app\assets\AdminAsset;
use app\models\Widget;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use Yii;

/**
 * WidgetController implements the CRUD actions for Widget model.
 */
class MainController extends Controller
{
    public $title;

    public function beforeAction($action)
  {
      
      //$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : null;
      if(Yii::$app->user->isGuest){
        return $this->redirect('/inside');
      }
      return parent::beforeAction($action);
  }
}
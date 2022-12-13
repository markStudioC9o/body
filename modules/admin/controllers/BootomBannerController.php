<?php

namespace app\modules\admin\controllers;

use app\assets\AdminAsset;
use app\models\Articles;
use app\models\ArticlesOption;
use app\models\Authors;
use app\models\BootomBanner;
use app\models\GqlleryHtml;
use app\models\Heading;
use app\models\LanguageSetting;
use app\models\VideoList;
use app\models\Widget;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\UploadedFile;

/**
 * Default controller for the `admin` module
 */
class BootomBannerController extends MainController
{
  public $title = "Настройки нижнего баннера";
  public function actionIndex()
  {
    $dataProvider = new ActiveDataProvider([
      'query' => BootomBanner::find(),
    ]);
    return $this->render('index', [
      'dataProvider' => $dataProvider
    ]);
  }

  public function actionCreate()
  {
    $model = new BootomBanner();
    if (Yii::$app->request->isPost) {
      $data = Yii::$app->request->post();
      $model->image = UploadedFile::getInstance($model, 'image');
      if (!empty($model->image)) {
        $model->img = $model->upload();
      }
      if ($model->load($data) && $model->save()) {
        return  $this->redirect('index');
      }
    }
    return $this->render('create', [
      'model' => $model
    ]);
  }

  public function actionUpdate($id)
  {
    $model = BootomBanner::findOne($id);
    if (Yii::$app->request->isPost) {
      $data = Yii::$app->request->post();
      $model->image = UploadedFile::getInstance($model, 'image');
      if (!empty($model->image)) {
        $model->img = $model->upload();
      }
      if ($model->load($data) && $model->save()) {
        return  $this->redirect('index');
      }
    }
    return $this->render('update',[
      'model' => $model
    ]);
  }

  public function actionDelete($id){
    $model = BootomBanner::findOne($id)->delete();
    return $this->redirect('index');
  }
}

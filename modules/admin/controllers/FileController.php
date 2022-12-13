<?php

namespace app\modules\admin\controllers;

use app\assets\AdminAsset;
use app\models\LanguageSetting;
use app\models\Widget;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

class FileController extends MainController
{
  public function actionGetDir()
  {
    if (Yii::$app->request->isAjax) {
      $data = Yii::$app->request->post();
      $path = Yii::getAlias('@webroot') . '/gallery/'.$data['path'].'/';
      $dirGall = scandir($path);
      //print_r($dirGall);

      $arrayFileImg = array();
      
      foreach ($dirGall as $key => $item) {
        
        if ($item != '.' && $item != '..' && !is_dir($path . $item)  && is_file($path . $item)) {
          $met = stat($path . $item);
          $arrayFileImg[] = array(
            'ino' => $met['ino'],
            'size' => $met['size'],
            'atime' => $met['atime'],
            'mtime' => $met['mtime'],
            'path' => $item
          );
        }
      }
      $array_name = [];
      foreach ($arrayFileImg as $key => $row) {
        $array_name[$key] = $row['mtime'];
      }
      array_multisort($array_name, SORT_DESC, $arrayFileImg);
//      print_r($arrayFileImg);
      return $this->renderPartial('file',[
        'catTwo' => $arrayFileImg,
        'path' => $data['path']
      ]);
    }
  }

  public function actionRenderVideo()
  {
    if (Yii::$app->request->isAjax) {
      $data = Yii::$app->request->post();
      $dataTag = rand(0, 999) . 'video' . rand(0, 999);
      return $this->renderAjax('render-video', [
        'data' => $data['src'],
        'dataTag' => $dataTag
      ]);
    }
  }
}

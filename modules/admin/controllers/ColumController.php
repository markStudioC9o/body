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

class ColumController extends MainController
{
  public function actionIndex(){
    if(Yii::$app->request->isAjax){
      return $this->renderPartial('colum');
    }
  }

  public function actionAddText(){
    if(Yii::$app->request->isAjax){
      $data = Yii::$app->request->post();
      $randId = rand(0,999)."text".rand(0,999).rand(0,999);
      $data = array();
      $data['glow'] = '1';
    $array = array(
      'textBlock' => "<div contenteditable=\"true\" data-id=\"".$randId."\" class=\"est-text text_padding_tag ".$randId."_opens innertText\" >Вставить текст...</div>",
      'randId' => $randId,
      'temp' => $this->renderPartial('param',[
        'data' => $data,
        'id' => $randId,
        'sizeVal' => $data['width']

      ])
    );
    return json_encode($array);
    }
    
  }
  
  public function actionParam(){
    if(Yii::$app->request->isAjax){
      $data = Yii::$app->request->post();

      return $this->renderPartial('param',[
        'data' => $data,
        'id' => $data['id'],
        'glow' => $data['glow'],
        'sizeVal' => $data['width'],
        'output' => $data['output']
      ]);
    }
  }
}


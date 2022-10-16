<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;

/**
 * Default controller for the `admin` module
 */
class AccardionController extends MainController
{

  public function actionAdd()
  {
    if (Yii::$app->request->isAjax) {
      $randId = rand(0, 999) . rand(0, 999);
      $accarId = rand(0, 999) . rand(0, 999);
      return $this->renderPartial('index', [
        'randId' => $randId,
        'accarId' => $accarId
      ]);
    }
  }
  public function actionAddElem()
  {
    if (Yii::$app->request->isAjax) {
      $randId = rand(0, 999) . rand(0, 999);
      return $this->renderPartial('add-elem', [
        'randId' => $randId
      ]);
    }
  }
  public function actionPaddinger(){
    if (Yii::$app->request->isAjax) {
      $randId = rand(0, 999) . rand(0, 999). rand(0, 999)."-padinger";
      return $this->renderPartial('padinger', [
        'randId' => $randId
      ]);
    }
  }
  public function actionPaddingerParam(){
    if (Yii::$app->request->isAjax) {
      $data = Yii::$app->request->post();
      return $this->renderPartial('padinger-param', [
        'data' => $data
      ]);
    }
  }
  public function actionLiner(){
    if (Yii::$app->request->isAjax) {
      $idLiner = rand(0, 999);
      return $this->renderPartial('liner', [
        'idLiner' => $idLiner
      ]);
    }
  }
  public function actionTitleParam(){
    if(Yii::$app->request->isAjax){
      $data = Yii::$app->request->post();
      return $this->renderPartial('param-title-accardion',[
        'data' => $data
      ]);
    }
  }

  public function actionLinerParam(){
    if(Yii::$app->request->isAjax){
      $data = Yii::$app->request->post();
      return $this->renderPartial('liner-param',[
        'data' => $data
      ]);
    }
  }
}

<?php

namespace app\modules\admin\controllers;

use app\assets\AdminAsset;
use app\models\FormBilder;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class FormBildController extends MainController
{
  public $title = 'Шаблоны форм';
  public function actionIndex()
  {
    $dataProvuder = new  ActiveDataProvider([
      'query' => FormBilder::find(),
    ]);
    $this->view->registerJsFile('/adminStyle/adminForm.js', ['depends' => AdminAsset::className()]);
    $this->view->registerCssFile('/adminStyle/adminInputCss.css');
    return $this->render('index', [
      'dataProvuder' => $dataProvuder
    ]);
  }
  public function actionNewField()
  {
    if (Yii::$app->request->isAjax) {
      $data = Yii::$app->request->post();
      return $this->renderPartial('new-input');
    }
  }
  public function actionParam()
  {
    if (Yii::$app->request->isAjax) {
      $data = Yii::$app->request->post();
      return $this->renderAjax('input-param', [
        'id' => $data['id']

      ]);
    }
  }

  public function actionSuccInput()
  {
    if (Yii::$app->request->isAjax) {
      $data = Yii::$app->request->post();
      $ress = ArrayHelper::map($data['arry'], 'name', 'value');
      unset($ress['_csrf']);
      if ($ress['type_input'] == 'select') {
        return $this->renderPartial('select_input', [
          'ress' => $ress,
          'name' => $data['name'],
          'sub' => $data['sub']
        ]);
      }
      if ($ress['type_input'] == 'radio') {
        return $this->renderPartial('radio_input', [
          'ress' => $ress,
          'name' => $data['name'],
          'sub' => $data['sub']
        ]);
      }
      if ($ress['type_input'] == 'checkbox') {
        return $this->renderPartial('checkbox_input', [
          'ress' => $ress,
          'name' => $data['name'],
          'sub' => $data['sub']
        ]);
      }
      if ($ress['type_input'] == 'textarea') {
        return $this->renderPartial('textarea_input', [
          'ress' => $ress,
          'name' => $data['name'],
          'sub' => $data['sub']
        ]);
      }
      if ($ress['type_input'] == 'input') {
        return $this->renderPartial('input_input', [
          'ress' => $ress,
          'name' => $data['name'],
          'sub' => $data['sub']
        ]);
      }
      if ($ress['type_input'] == 'text') {
        return $this->renderPartial('text_input', [
          'ress' => $ress,
          'name' => $data['name']
        ]);
      }
    }
  }


  public function actionListParam()
  {
    if (Yii::$app->request->isAjax) {
      $data = Yii::$app->request->post();
      $id = $data['id'] + 1;
      return $this->renderPartial('list-param', [
        'id' => $id
      ]);
    }
  }

  public function actionSave()
  {
    if (Yii::$app->request->isAjax) {
      $data = Yii::$app->request->post();
      $model = new FormBilder([
        'name' => $data['name'],
        'value' => $data['val']
      ]);
      if ($model->save()) {
        return true;
      }
    }
  }

  public function actionAddPage()
  {
    if (Yii::$app->request->isAjax) {
      $data = Yii::$app->request->post();
      if (FormBilder::find()->where(['id' => $data['id']])->exists()) {
        $model = FormBilder::find()->where(['id' => $data['id']])->one();
        return $this->renderPartial('form-page', [
          'model' => $model
        ]);
      }
    }
  }

  public function actionParamPage()
  {
    if (Yii::$app->request->isAjax) {
      $data = Yii::$app->request->post();
      if ($data['id'] != 'btn-param') {
        return $this->renderPartial('param-page', [
          'data' => $data
        ]);
      }else{
        return $this->renderPartial('param-page-btn', [
          'data' => $data
        ]);
      }
    }
  }

  public function actionEndPage()
  {
    if (Yii::$app->request->isAjax) {
      return $this->renderPartial('end-form');
    }
  }
  
  public function actionDelete($id){
    if(FormBilder::find()->where(['id' => $id])->exists()){
      $model = FormBilder::find()->where(['id' => $id])->one();
      if($model->delete()){
        return $this->redirect(['index']);
      }
    }
  }
}


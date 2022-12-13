<?php

namespace app\modules\admin\controllers;

use app\assets\AdminAsset;
use app\models\GqlleryHtml;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `admin` module
 */
class GalleryController extends MainController
{
    public $title;
    public function actionUpdate($id)
    {
      $this->title = 'Шаблон галлереи';
        $model = GqlleryHtml::findOne($id);
        $this->view->registerCssFile('/adminStyle/adminGal.css');
        $this->view->registerJsFile('/adminStyle/adminGal.js', ['depends' => AdminAsset::className()]);
        return $this->render('update',[
            'model' => $model
        ]);
    }

    public function actionSaveGall(){
      if(Yii::$app->request->isAjax){
        $data = Yii::$app->request->post();
        $model = GqlleryHtml::findOne($data["id"]);
        $model->value = $data['html'];
        $model->name = $data['name'];
        if($model->save()){
          return true;
        }else{
          return false;
        }
      }
    }

    public function actionList(){
      if(Yii::$app->request->isajax){
        $model = GqlleryHtml::find()->asArray()->all();
        return $this->renderPartial('gal-list',[
          'model' => $model
        ]);
        }
    }

    public function actionGet(){
      if(Yii::$app->request->isajax){
        $data = Yii::$app->request->post();
        if(GqlleryHtml::find()->where(['id' => $data['id']])->exists()){
          $model = GqlleryHtml::find()->where(['id' => $data['id']])->one();
          $randId = rand(0,999)."gal".rand(0,999);
          if(!empty($model->value)){
            return $this->renderPartial('gel-temp',[
              'cont' => $model->value,
              'randId' => $randId
            ]);
            //return $model->value;
          }else{
            return false;
          }
          }
      }
    }

    public function actionParamGal(){
      if(Yii::$app->request->isAjax){
        $data = Yii::$app->request->post();
        return $this->renderPartial('param', [
          'data' => $data
        ]);
      }
    }
    public function actionDelete($id){
      $model = GqlleryHtml::findOne($id);
      $model->delete();
      return $this->redirect(['/admin/articles/template-galery']);
    }
}

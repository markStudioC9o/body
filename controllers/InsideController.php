<?php

namespace app\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use app\models\LoginForm;
/**
 * Default controller for the `admin` module
 */
class InsideController extends MainController
{

  public function actionIndex()
  {
    $this->layout = false;
    if(!Yii::$app->user->isGuest){
      return $this->redirect('/admin');
    }
    if($this->request->isPost){
      $data = $this->request->post();
        $model = new LoginForm();
        $model->username = $data['username'];
        $model->password =  $data['password'];
        $model->rememberMe = true;
          if(!$model->login()){
            var_dump($model->getErrors(), '222');
          }else{
            return $this->redirect('admin');
            
          }
        
    }
    return $this->render('index');
  }
}

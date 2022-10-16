<?php
namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;

class TextBlockController extends MainController
{
    public $title;
    public function actionParam()
    {
        if(Yii::$app->request->isAjax){
            $data = Yii::$app->request->post();
            return $this->renderAjax('text-param',[
                'id' => $data['id'],
                'data' => $data
            ]);
        }
    }
    public function actionSetting(){
      if(Yii::$app->request->isAjax){
        $data = Yii::$app->request->post();
        return $this->renderAjax('text-uprav', [
          'id' => $data['id'],
          'glow' => $data['glow']
        ]);
      }
    }
}

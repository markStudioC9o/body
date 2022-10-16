<?php

namespace app\modules\admin\controllers;

use app\assets\AdminAsset;
use app\models\ArticlesOption;
use app\models\ArticlesOptionLang;
use app\models\LanguageSetting;
use app\models\Shipet;
use app\models\SliderItem;
use app\models\SliderLang;
use app\models\SliderList;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * SliderItemController implements the CRUD actions for SliderItem model.
 */
class ShipetController extends MainController
{
  public function actionIndex($id, $tag){
    $this->title = 'Снипет статьи для языка '.$tag;
    $model = new Shipet();
    if($tag == 'ru'){
      $shipet = ArticlesOption::find()->where(['articles_id' => $id])->andWhere(['option_param' => 'shipet'])->one();
    }else{
      $shipet = ArticlesOptionLang::find()->where(['articles_id' => $id])->andwhere(['option_param' => 'shipet'])->andWhere(['tag' => $tag])->one();
    }
    if(Yii::$app->request->isPost){
      $model->img = UploadedFile::getInstance($model, 'img');
      
      if(!empty($model->img)){
        $file = $model->upload();
        //var_dump($file);
        if($file){
          if($tag == 'ru'){
            if(ArticlesOption::find()->where(['articles_id' => $id])->andWhere(['option_param' => 'shipet'])->exists()){
              $artic = ArticlesOption::find()->where(['articles_id' => $id])->andWhere(['option_param' => 'shipet'])->one();
              $artic->value = $file;
            }else{
              $artic = new ArticlesOption([
                'option_param' => 'shipet',
                'articles_id' => $id,
                'value' => $file
              ]);
            }
          }else{
            if(ArticlesOptionLang::find()->where(['articles_id' => $id])->andwhere(['option_param' => 'shipet'])->andWhere(['tag' => $tag])->exists()){
              $artic = ArticlesOptionLang::find()->where(['articles_id' => $id])->andwhere(['option_param' => 'shipet'])->andWhere(['tag' => $tag])->one();
              $artic->value = $file;
            }else{
              $artic = new ArticlesOptionLang([
                'articles_id' => $id,
                'option_param' => 'shipet',
                'tag' => $tag,
                'value' => $file
              ]);
            }
          }
          if($artic->save()){
            return $this->refresh();
          }
        }
      }
    }
    return $this->render('index',[
      'id' => $id,
      'tag' => $tag,
      'model' => $model,
      'shipet' => $shipet
      
    ]);
  }
}
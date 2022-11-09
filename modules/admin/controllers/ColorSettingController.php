<?php

namespace app\modules\admin\controllers;

use app\assets\AdminAsset;
use app\models\Articles;
use app\models\ArticlesOption;
use app\models\CityList;
use app\models\Favicon;
use app\models\FooterHeaderParam;
use app\models\FooterHeaderParamLang;
use yii;
use app\models\Heading;
use app\models\LanguageSetting;
use app\models\MainOption;
use app\models\Pages;
use app\models\SiteSetting;
use Faker\Provider\Lorem;
use yii\web\Controller;
use yii\web\UploadedFile;

/**
 * Default controller for the `admin` module
 */
class ColorSettingController extends MainController
{
  public $title = "Color Setting";
  public function actionIndex(){
    if(Yii::$app->request->isPost){
      $data = Yii::$app->request->post();

      if(!empty($data['SiteMainColor'])){
        if(SiteSetting::find()->where(['param' => 'SiteMainColor'])->exists()){
          $model = SiteSetting::find()->where(['param' => 'SiteMainColor'])->one();
          $model->value = $data['SiteMainColor'];
        }else{
          $model = new SiteSetting([
            'param' => 'SiteMainColor',
            'value' => $data['SiteMainColor']
          ]);
        }
        if(!$model->save()){
          return var_dump($model->getErrors());
        }
      }

      if(!empty($data['SiteAcsentColor'])){
        if(SiteSetting::find()->where(['param' => 'SiteAcsentColor'])->exists()){
          $model = SiteSetting::find()->where(['param' => 'SiteAcsentColor'])->one();
          $model->value = $data['SiteAcsentColor'];
        }else{
          $model = new SiteSetting([
            'param' => 'SiteAcsentColor',
            'value' => $data['SiteAcsentColor']
          ]);
        }
        if(!$model->save()){
          return var_dump($model->getErrors());
        }
      }
      return $this->refresh();
    }

    $SiteAcsentColor = SiteSetting::find()->where(['param' => 'SiteAcsentColor'])->asArray()->one();
    $SiteMainColor = SiteSetting::find()->where(['param' => 'SiteMainColor'])->asArray()->one();
    return $this->render('index',[
      'SiteMainColor' => $SiteMainColor,
      'SiteAcsentColor' => $SiteAcsentColor
    ]);
  }
}

// [mainColor-source] => #00a6ca
// [mainColor] => #00a6ca
// [acsentColor-source] => #dbf9ff
// [acsentColor] => #dbf9ff
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
class SettingController extends MainController
{
  public $title;

  public $contr = array(
    "title" => "",
    "text" => ""
  );
  public function actionIndex()
  {
    $lang = LanguageSetting::find()->all();
    $cosial = MainOption::find()->where(['key_param' => 'cosial_param'])->one();
    $city = CityList::find()->all();
    $modelCity = new CityList();
    $link = FooterHeaderParam::find()->where(['param' => 'link'])->one();
    //$link = null;
    $inform = FooterHeaderParam::find()->where(['param' => 'inform'])->one();
    $favicon = new Favicon();
    $favImg = SiteSetting::find()->where(['param' => 'favicon'])->asArray()->one();
    if (Yii::$app->request->isPost) {

      $data = Yii::$app->request->post();

      $favicon->img = UploadedFile::getInstance($favicon, 'img');
      if (!empty($favicon->img)) {
        //var_dump($favicon->img);
        $file = $favicon->upload();
        if ($file) {
          if (SiteSetting::find()->where(['param' => 'favicon'])->exists()) {
            $favload = SiteSetting::find()->where(['param' => 'favicon'])->one();
            $favload->value = $file;
          } else {
            $favload = new SiteSetting([
              'value' => $file,
              'param' => 'favicon',
              'tag' => 'or'
            ]);
          }
          if ($favload->save()) {
            return $this->refresh();
          } else {
            var_dump($favload->getErrors());
          }
        }
      }
      if (isset($data['CityList']) && !empty($data['CityList'])) {
        if ($modelCity->load($data)) {
          if ($modelCity->save()) {
            return $this->refresh();
          }
        }
      }
      if (isset($data['Cosial']) && !empty($data['Cosial'])) {
        $cosial->value = json_encode($data['Cosial']);
        if ($cosial->save()) {
          return $this->refresh();
        }
      }
      if (isset($data['footerHeaderParam']['inform']) && !empty($data['footerHeaderParam']['inform'])) {
        $inform->value = json_encode($data['footerHeaderParam']['inform']);
        if ($inform->save()) {
          return $this->refresh();
        }
      }
      // if(!empty($city->value)){
      //     $arrData = json_decode($city->value, true);
      //     $arrData[] = array(
      //         'name' => $data['City']['name'],
      //         'phone' => $data['City']['phone']

      //     );
      //     $city->value = json_encode($arrData);
      //     if($city->save()){
      //         return $this->refresh();
      //     }
      // }else{
      //     $arrData = array();
      //     $arr = array(
      //         'name' => $data['City']['name'],
      //         'phone' => $data['City']['phone']

      //     );
      //     $arrData[] = $arr;
      //     $city->value = json_encode($arrData);
      //     if($city->save()){
      //         return $this->refresh();
      //     }
      // }

      if (isset($data['FooterHeaderParam']) && !empty($data['FooterHeaderParam']['value'])) {
        $inform->value = $data['FooterHeaderParam']['value'];
        if ($inform->save()) {
          return $this->refresh();
        }
      }
      if (isset($data['footer']) && !empty($data['footer'])) {
        $value = json_encode($data['footer']);
        $link->value = $value;
        if ($link->save()) {
          return $this->refresh();
        } else {
          var_dump($link->getErrors());
        }
      }
    }
    $inform = FooterHeaderParam::find()->where(['param' => 'inform'])->one();
    $languge = LanguageSetting::find()->all();
    $this->title = "Настройки";
    return $this->render('index', [
      'inform' => $inform,
      'city' => $city,
      'languge' => $languge,
      'modelCity' => $modelCity,
      'cosial' => json_decode($cosial->value, true),
      'link' => $link,
      'lang' => $lang,
      'favicon' => $favicon,
      'favImg' => $favImg
    ]);
  }

  public function actionDeleteArcticles()
  {
    if (Yii::$app->request->isAjax) {
      $data = Yii::$app->request->post();
      if (Articles::find()->where(['id' => $data['id']])->exists()) {
        $model = Articles::findOne($data['id']);
        $model->delete();
      }
      if (ArticlesOption::find()->where(['articles_id' => $data['id']])->exists()) {
        ArticlesOption::deleteAll(['articles_id' => $data['id']]);
      }
      return true;
    }
  }

  public function actionAddBlock()
  {
    if (Yii::$app->request->isAjax) {
      $data = Yii::$app->request->post();
      return $this->renderPartial('index-block', [
        'data' => $data,
        'type' => $data['type']
      ]);
    }
  }

  public function actionModalBlock()
  {
    if (Yii::$app->request->isAjax) {
      $data = Yii::$app->request->post();
      return $this->renderPartial('modal-block', [
        'pos' => $data['pos']
      ]);
    }
  }

  public function actionLanInformer($tag = null)
  {
    $lang = LanguageSetting::find()->where(['!=', 'tag', 'ru'])->all();
    $this->title = "Языковые настройки";
    $inform = FooterHeaderParamLang::find()->where(['param' => 'inform'])->andWhere(['tag' => $tag])->one();
    if (isset($inform->value) && !empty($inform->value)) {
      $arrayValue = json_decode($inform->value, true);
    } else {
      $arrayValue = $this->contr;
    }
    if ($this->request->isPost) {
      $data = $this->request->post();
      // echo "<pre>";
      // print_r($data);
      // echo "</pre>";
      // exit();
      if (!empty($data['inform'])) {
        if (FooterHeaderParamLang::find()->where(['param' => 'inform'])->andWhere(['tag' => $tag])->exists()) {
          $informs = FooterHeaderParamLang::find()->where(['param' => 'inform'])->andWhere(['tag' => $tag])->one();
          $informs->value = json_encode($data['inform']);
        } else {
          $informs = new FooterHeaderParamLang([
            'tag' => $tag,
            'param' => 'inform',
            'value' => json_encode($data['inform'])
          ]);
        }
        if (!$informs->save()) {
          var_dump($informs->getErrors());
        }
      }
      return $this->refresh();
    }
    return $this->render('lan-informer', [
      'lang' => $lang,
      'tag' => $tag,
      'inform' => $inform,
      'arrayValue' => $arrayValue
    ]);
  }

  public function actionLangLinkFooter($tag = null)
  {
    $this->title = 'Настройка языковых версий';
    $lang = LanguageSetting::find()->where(['!=', 'tag', 'ru'])->asArray()->all();
    $link = FooterHeaderParamLang::find()->where(['param' => 'link'])->andWhere(['tag' => $tag])->one();
    if ($this->request->isPost) {
      $data = $this->request->post();
      if (isset($data['footer']) && !empty($data['footer'])) {
        $value = json_encode($data['footer']);
        if (FooterHeaderParamLang::find()->where(['param' => 'link'])->andWhere(['tag' => $tag])->exists()) {
          $link->value = $value;
        } else {
          $link = new FooterHeaderParamLang([
            'param' => 'link',
            'tag' => $tag,
            'value' => $value
          ]);
        }
        if ($link->save()) {
          return $this->refresh();
        } else {
          var_dump($link->getErrors());
        }
      }
    }

    return $this->render('lang-link-footer', [
      'link' => $link,
      'lang' => $lang,
      'tag' => $tag
    ]);
  }
}

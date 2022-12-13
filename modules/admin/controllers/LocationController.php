<?php

namespace app\modules\admin\controllers;

use app\assets\AdminAsset;
use app\models\Articles;
use app\models\ArticlesOption;
use app\models\Cities;
use app\models\CitiesLang;
use app\models\CityList;
use app\models\CoitiesData;
use app\models\Countries;
use app\models\CountriesLang;
use app\models\FooterHeaderParam;
use yii;
use app\models\Heading;
use app\models\LanguageSetting;
use app\models\MainOption;
use app\models\Pages;
use app\models\SiteSetting;
use app\models\SortHeader;
use Faker\Provider\Lorem;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;


/**
 * Default controller for the `admin` module
 */
class LocationController extends MainController
{
  public $title = 'Страны и города';
  public $social = array(
    'phone',
    'email',
    'instagram',
    'vkontakte',
    'viber',
    'whatsapp',
    'youtube',
    'facebook',
    'telegram'
  );
  public function actionIndex()
  {
    $dataProvider = new ActiveDataProvider([
      'query' => Countries::find(),
    ]);
    $globalWord = CoitiesData::find()->where(['global' => '1'])->all();
    $globalArray = ArrayHelper::getColumn($globalWord, 'cities_id');
    $globalCity = Cities::find()->where(['id' => $globalArray])->all();
    return $this->render('index', [
      'dataProvider' => $dataProvider,
      'globalCity' => $globalCity,
      'visible' => SiteSetting::find()->where(['param' => 'site-hide'])->one()
    ]);
  }

  public function actionAddCountry()
  {
    $model = new Countries();
    $lang = LanguageSetting::find()->all();
    if ($this->request->isPost) {
      $data = $this->request->post();
      if ($model->load($data)) {
        if (!$model->save()) {
          return var_dump($model->getErrors());
        }
      }
      if (isset($data['lang']) && !empty($data['lang'])) {
        foreach ($data['lang'] as $elem => $item) {
          if (!empty($item['name'])) {
            $couLang = new CountriesLang([
              'parent_id' => $model->id,
              'name' => $item['name'],
              'tag' => $elem
            ]);
            if (!$couLang->save()) {
              return var_dump($couLang->getErrors());
            }
          }
        }
      }
      return $this->redirect(['index']);
    }
    return $this->render('add-country', [
      'model' => $model,
      'lang' => $lang
    ]);
  }
  public function actionAddCity($id)
  {
    $model =  new Cities();
    $this->title = 'Новый город';
    $country = Countries::findOne($id);
    $lang = LanguageSetting::find()->where(['!=', 'tag', $country->tag])->all();
    if ($this->request->isPost) {
      $data = $this->request->post();
      // echo "<pre>";
      // print_r($data);
      // echo "</pre>";
      if ($model->load($data)) {
        if (!$model->save()) {
          return var_dump($model->getErrors());
        }
      }
      if (isset($data['lang']) && !empty($data['lang'])) {
        foreach ($data['lang'] as $elem => $item) {
          if (!empty($item['name'])) {
            $couLang = new CitiesLang([
              'parent_id' => $model->id,
              'name' => $item['name'],
              'tag' => $elem,
              'postscript' => $item['postscript']
            ]);
            if (!$couLang->save()) {
              return var_dump($couLang->getErrors());
            }
          }
        }
      }
      return $this->redirect(['index']);
    }
    return $this->render('add-city', ['id' => $id, 'model' => $model, 'lang' => $lang]);
  }

  public function actionCity($id)
  {
    $country = Countries::findOne($id);
    $this->title = $country->name;
    $dataProvider = new ActiveDataProvider([
      'query' => Cities::find()->where(['counries_id' => $id]),
    ]);
    return $this->render('city', [
      'dataProvider' => $dataProvider
    ]);
  }

  public function actionUpdate($id)
  {
    $city = Cities::findOne($id);
    $cityLang = CitiesLang::find()->where(['parent_id' => $id])->all();
    $listTag = ArrayHelper::getColumn($cityLang, 'tag');
    $country = Countries::find()->where(['id' => $city->counries_id])->one();
    $langer = LanguageSetting::find()->where(['!=', 'tag', $country->tag])->all();

    $langerNew = LanguageSetting::find()->where(['!=', 'tag', $country->tag]);
    foreach ($listTag as $am => $mov) {
      $langerNew = $langerNew->andWhere(['!=', 'tag', $mov]);
    }
    $langerNew = $langerNew->all();

    $this->title = $city->name;
    $socialData = null;
    if (CoitiesData::find()->where(['cities_id' => $id])->exists()) {
      $model = CoitiesData::find()->where(['cities_id' => $id])->one();
      $socialData = json_decode($model->kontakty, true);
    } else {
      $model = new CoitiesData();
    }

    if ($this->request->isPost) {
      $data = $this->request->post();
      if ($city->load($data)) {
        if (!$city->save()) {
          var_dump($city->getErrors(), '1');
        }
      }
      if (isset($data['lang']) && !empty($data['lang'])) {
        foreach ($data['lang'] as $efer => $ruer) {
          if (CitiesLang::find()->where(['id' => $efer])->exists()) {
            $citLang = CitiesLang::find()->where(['id' => $efer])->one();
            $citLang->name = $ruer['name'];
            $citLang->postscript = $ruer['postscript'];
            if (!$citLang->save()) {
              var_dump($citLang->getErrors());
            }
          }

          if (isset($data['langnew']) && !empty($data['langnew'])) {
            foreach ($data['langnew'] as $efer => $ruer) {
              if (!empty($ruer['name'])) {
                $citLang = new CitiesLang([
                  'parent_id' => $id,
                  'name' => $ruer['name'],
                  'postscript' => $ruer['postscript'],
                  'tag' => $efer
                ]);
                if (!$citLang->save()) {
                  var_dump($citLang->getErrors(), '2');
                }
              }
            }
          }
        }
      } else {
        if (isset($data['langer']) && !empty($data['langer'])) {
          foreach ($data['langer'] as $efer => $ruer) {
            if (!empty($ruer['name'])) {
              $citLang = new CitiesLang([
                'parent_id' => $id,
                'name' => $ruer['name'],
                'postscript' => $ruer['postscript'],
                'tag' => $efer
              ]);
              if (!$citLang->save()) {
                var_dump($citLang->getErrors(), '2');
              }
            }
          }
        }
      }
      if (!empty($data['social'])) {
        $model->kontakty = json_encode($data['social']);
      }
      $model->cities_id = $id;
      $model->adress = $data['CoitiesData']['adress'];
      $model->main = $data['CoitiesData']['main'];
      $model->global = $data['CoitiesData']['global'];
      if ($model->save()) {
        if ($data['CoitiesData']['global'] == '1') {
          Yii::$app->db->createCommand()->update('coities_data', ['global' => '0'], 'id!=' . $model->id)->execute();
        }
        if ($data['CoitiesData']['main'] == '1') {
          $cityList = Cities::find()->where(['counries_id' => $country->id])->all();
          $ciLisId = ArrayHelper::getColumn($cityList, 'id');
          foreach ($ciLisId as $yu => $vb) {
            if ($vb != $model->cities_id) {
              Yii::$app->db->createCommand()->update('coities_data', ['main' => '0'], 'cities_id=' . $vb)->execute();
            }
          }
          //Yii::$app->db->createCommand()->update('coities_data', ['main' => '1'], 'id!=' . $ciLisId)->execute();
          //print_r($ciLisId);
          //exit();
          //CoitiesData::updateAll(['main' => '0'],[['id'=> $ciLisId], ['!=', 'id', $model->id]]);
        }
        return $this->refresh();
      }
    }

    return $this->render('update', [
      'model' => $model,
      'social' => $this->social,
      'socialData' => $socialData,
      'cityLang' => $cityLang,
      'langer' => $langer,
      'city' => $city,
      'langerNew' => $langerNew,
      'id' => $id

    ]);
  }

  public function actionDelete($id)
  {
    if (CoitiesData::find()->where(['cities_id' => $id])->exists()) {
      $data = CoitiesData::find()->where(['cities_id' => $id])->one();
      $data->delete();
    }
    CitiesLang::deleteAll(['parent_id' => $id]);
    $model = Cities::findOne($id);
    if ($model->delete()) {
      return $this->redirect(['index']);
    }
  }
  public function actionDeleteCor($id)
  {
    $citys = Cities::find()->where(['counries_id' => $id])->all();
    $cityIds = ArrayHelper::getColumn($citys, 'id');
    CoitiesData::deleteAll(['cities_id' => $cityIds]);
    CitiesLang::deleteAll(['parent_id' => $cityIds]);
    Cities::deleteAll(['counries_id' => $id]);
    CountriesLang::deleteAll(['parent_id' => $id]);
    $model = Countries::findOne($id);
    $model->delete();
    return $this->redirect(['index']);
  }

  public function actionSortSoc($id)
  {
    $data = null;
    $array = null;
    $sortis = null;

    $this->title = "Сортировка иконок в шапке";
    $model = SortHeader::find()->where(['parent_id' => $id])->asArray()->one();
  
    $this->view->registerJsFile('/js/sort-social.js', ['depends' => AdminAsset::className()]);
    $this->view->registerCssFile("/css/sort-social.css");

    if (CoitiesData::find()->where(['cities_id' => $id])->exists()) {
      $data = CoitiesData::find()->where(['cities_id' => $id])->one();
    }
    
    if (!empty($data->kontakty)) {
      $sortis = json_decode($data->kontakty, true);
      unset($sortis['phone']);
    }

    if (!empty($model['value'])) {
      $array = json_decode($model['value'], true);
    }
    // echo "<pre>";
    // print_r($array);
    // print_r($sortis);
    // echo "</pre>";
    if(!empty($array)){
      foreach($array as $key => $item){
        if($sortis[$item['id']] == ''){
          unset($array[$key]);
        }
        foreach($sortis as $el => $ve){
          if($el == $item['id']){
            unset($sortis[$item['id']]);
          }
        }
        
      }
    }


    return $this->render('sort', ['data' => $data, 'id' => $id, 'model' => $model, 'array' => $array, 'sortis' => $sortis]);
  }

  public function actionSortSave()
  {
    if (Yii::$app->request->isAjax) {
      $data = Yii::$app->request->post();
      if ($data['id']) {
        if (SortHeader::find()->where(['parent_id' => $data['id']])->exists()) {
          $model = SortHeader::find()->where(['parent_id' => $data['id']])->one();
          $model->value = json_encode($data['result']);
        } else {
          $model = new SortHeader([
            'parent_id' => $data['id'],
            'value' => json_encode($data['result'])
          ]);
        }
        if ($model->save()) {
          return '111';
        } else {
          print_r($model->getErrors());
        }
      }
    }
  }

  public function actionHideCountry(){
    if(SiteSetting::find()->where(['param' => 'site-hide'])->exists()){
      $model = SiteSetting::find()->where(['param' => 'site-hide'])->one();
      if($model->value == 'show'){
        $model->value = 'hide';
      }else{
        $model->value = 'show';
      }
    }else{
      $model = new SiteSetting([
        'param' => 'site-hide',
        'value' => 'show'
      ]);
    }
    if($model->save()){
      return $this->redirect('index');
    }
    
  }
}

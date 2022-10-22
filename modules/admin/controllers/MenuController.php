<?php

namespace app\modules\admin\controllers;

use app\assets\AdminAsset;
use app\models\Articles;
use app\models\Heading;
use app\models\LanguageSetting;
use app\models\MainOption;
use app\models\MenuImg;
use app\models\MenuParam;
use app\models\Pages;
use app\models\SiteSetting;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\UploadedFile;

class MenuController extends MainController
{
  public $title;
  public function actionIndex()
  {
    $model = MainOption::find()->where(['key_param' => 'menu_list'])->one();
    $this->title = 'Настройка пунктов меню';
    $array = array();
    $listMenu = array();
    $keyArray = array();
    if (!empty($model->value)) {
      $listMenu = json_decode($model->value, true);
      foreach ($listMenu['data'] as $item) {
        $array[] = $item['id'];
        if (isset($item['children'])) {
          foreach ($item['children'] as $el) {
            $array[] = $el['id'];
          }
        }
      }
      foreach ($array as $key => $value) {
        $keyArray[] = (int)preg_replace('/[^0-9]/', '', $value);
      }
    }
    $pages = Pages::find()->where(['not in', 'id', $keyArray])->andWhere(['top_menu' => '1'])->all();
    $modelBt = MainOption::find()->where(['key_param' => 'menu_bottom'])->one();
    $arrayBt = array();
    $listMenuBt = array();
    $keyArrayBt = array();
    if (!empty($modelBt->value)) {
      $listMenuBt = json_decode($modelBt->value, true);
      foreach ($listMenuBt['data'] as $item) {
        $array[] = $item['id'];
        if (isset($item['children'])) {
          foreach ($item['children'] as $el) {
            $arrayBt[] = $el['id'];
          }
        }
      }
      foreach ($arrayBt as $key => $value) {
        $keyArrayBt[] = (int)preg_replace('/[^0-9]/', '', $value);
      }
    }
    $pagesBt = Pages::find()->where(['not in', 'id', $keyArrayBt])->andWhere(['bottom_menu' => '1'])->all();

    $this->view->registerJsFile('/adminStyle/adminMenu.js', ['depends' => AdminAsset::className()]);
    return $this->render('index', [
      'listMenu' => $listMenu,
      'pages' => $pages,
      'listMenuBt' => $listMenuBt,
      'pagesBt' => $pagesBt,
      'menuPages' => new Pages()
    ]);
  }


  public function actionSaveMenu()
  {
    if (Yii::$app->request->isAjax) {
      $data = Yii::$app->request->post();
      $str = json_encode($data);
      $model = MainOption::find()->where(['key_param' => 'menu_list'])->one();
      $model->value = $str;
      if ($model->save()) {
        Yii::$app->session->setFlash('success', "Изменения сохранены");
        return true;
      }
    }
  }

  public function actionSaveMenuBtn()
  {
    if (Yii::$app->request->isAjax) {
      $data = Yii::$app->request->post();
      $str = json_encode($data);
      $model = MainOption::find()->where(['key_param' => 'menu_bottom'])->one();
      $model->value = $str;
      if ($model->save()) {
        Yii::$app->session->setFlash('success', "Изменения сохранены");
        return true;
      }
    }
  }

  public function actionMenuParam()
  {
    $array = array();
    if (Yii::$app->request->isAjax) {
      $data = Yii::$app->request->post();
      if (MenuImg::find()->where(['parent_id' => $data['data']])->exists()) {
        $model = MenuImg::find()->where(['parent_id' => $data['data']])->asArray()->one();
      } else {
        $model = new MenuImg();
      }
      if(!empty($model['active_lang'])){
        $array = json_decode($model['active_lang'], true);
      }

      $lang = LanguageSetting::find()->asArray()->all();
      $pages = new Pages();
      $menuParam = new MenuParam();
      return $this->renderAjax('param', [
        'model' => $model,
        'id' => $data['data'],
        'lang' => $lang,
        'pages' => $pages,
        'menuParam' => $menuParam,
        'array' => $array
      ]);
    }
  }

  public function actionMenuParamBtn()
  {
    if (Yii::$app->request->isAjax) {
      $data = Yii::$app->request->post();
      return $this->renderPartial('paramBtn', [
        'id' => $data['data']
      ]);
    }
  }
  public function actionSaveIcon()
  {
    if (Yii::$app->request->isAjax) {
      $key = Yii::$app->request->post();
      $file = $_FILES;

      $ref = $this->SaveParam($key['titleMenu'], $key['thisId']);
      
      if (MenuImg::find()->where(['parent_id' => $key['thisId']])->exists()) {
        $model = MenuImg::find()->where(['parent_id' => $key['thisId']])->one();
        $model->image = UploadedFile::getInstanceByName('myFiles');
        if (!empty($model->image)) {
          $model->link = $model->upload();
        }
        $model->color = $key['colorMenu'];
        if ($model->save(false)) {
          Yii::$app->session->setFlash('success', "Изменения сохранены");
          return 'Ok';
        } else {
          return 'No';
        }
      } else {
        $model = new MenuImg();
        $model->image = UploadedFile::getInstanceByName('myFiles');
        if (!empty($model->image)) {
          $model->link = $model->upload();
        }
        $model->parent_id = $key['thisId'];
        $model->color = $key['colorMenu'];
        if ($model->save(false)) {
          Yii::$app->session->setFlash('success', "Изменения сохранены");
          return 'Ok';
        } else {
          return 'No';
        }
      }

      // if ($model->myUpload()) {
      //   $model->save(false);
      // }

    }
  }

  public function SaveParam($arra, $id)
  {
    $varSet = array();
    foreach ($arra as $key => $val) {
      if(isset($val['active'])){
        $varSet[$key] = $val['active'];
      }else{
        $varSet[$key] = '0';
      }
      if (MenuParam::find()->where(['parent_id' => $id])->andwhere(['tag' => $key])->exists()) {
        $model = MenuParam::find()->where(['parent_id' => $id])->andwhere(['tag' => $key])->one();
      } else {
        $model = new MenuParam([
          'parent_id' => $id,
        ]);
        $model->tag = $key;
      }

      $model->value = $val['name'];
      $model->ex_link = $val['ex_link'];

      if (!$model->save()) {
        return var_dump($model->getErrors());
      }else{
        $var = 'Oki';
      };
    }
    
    if(MenuImg::find()->where(['parent_id' => $id])->exists()){
      $moc = MenuImg::find()->where(['parent_id' => $id])->one();
      $moc->active_lang = json_encode($varSet);
      if(!$moc->save()){
        return false;
      }
    }
    return $var;
  }

  public function actionDelete($id)
  {
    $model = MainOption::find()->where(['key_param' => 'menu_list'])->one();
    $menu = json_decode($model->value, true);
    foreach ($menu['data'] as $key => $value) {
      if ($value['id'] == $id) {
        unset($menu['data'][$key]);
      } else {
        if (isset($value['children']) && !empty($value['children'])) {
          foreach ($value['children'] as $item => $elem) {
            if ($elem['id'] == $id) {
              unset($menu['data'][$key]['children'][$item]);
            }
          }
        }
      }
    }

    $model->value = json_encode($menu);
    if (stristr($id, '_', true) == 'item') {
      $idFind = str_replace('item_', '', $id);
      $pages = Pages::findOne($idFind);
      $pages->top_menu = '0';
      $pages->save();
    }
    if ($model->save()) {
      return $this->redirect(['index']);
    }
  }

  public function actionDeletes($id)
  {
    $model = MainOption::find()->where(['key_param' => 'menu_bottom'])->one();
    $menu = json_decode($model->value, true);
    foreach ($menu['data'] as $key => $value) {
      if ($value['id'] == $id) {
        unset($menu['data'][$key]);
      }
    }
    $model->value = json_encode($menu);
    $idFind = str_replace('item_', '', $id);

    if (stristr($id, '_', true) == 'item') {
      $pages = Pages::findOne($idFind);
      $pages->bottom_menu = '0';
      $pages->save();
    }
    if ($model->save()) {
      return $this->redirect(['index']);
    } else {
      var_dump($model->getErrors(), $pages->getErrors());
    }
  }

  public function actionAddMenu()
  {
    if (Yii::$app->request->isAjax) {
      $model = MainOption::find()->where(['key_param' => 'menu_list'])->one();
      $menu = json_decode($model->value, true);
      $array = array();
      foreach ($menu['data'] as $item) {
        $array[] = str_replace('item_', '', $item['id']);
      }

      $pages = Pages::find()->where(['not in', 'id', $array])->andWhere(['!=', 'id', '5'])->asArray()->select(['id', 'title'])->all();
      $articles = Articles::find()->asArray()->all();
      $heading = Heading::find()->asArray()->all();

      return $this->renderPartial('punkt_menu', [
        'pages' => $pages,
        'articles' => $articles,
        'heading' => $heading
      ]);
    }
    if (Yii::$app->request->post()) {

      $data = Yii::$app->request->post();

      if (isset($data['param']) && !empty($data['param'])) {
        $menuList = MainOption::find()->where(['key_param' => 'menu_list'])->one();
        $menu = json_decode($menuList->value, true);
        $order = '';
        foreach ($menu['data'] as $val) {
          $order = $val['order'];
        }
        foreach ($data['param'] as $key => $value) {
          if (isset($value['id']) && !empty($value['id'])) {
            $order = $order + 1;

            if ($value['type'] == 'item') {
              $model = Pages::findOne($value['id']);
              $model->top_menu = '1';
              $model->save();
            }

            $menu['data'][] = array(
              'id' => $value['type'] . '_' . $value['id'],
              'order' => $order,
            );
          }
        }
        $menuList->value = json_encode($menu);
        if ($menuList->save()) {
          return $this->redirect(['index']);
        }
      }
    }
  }


  public function actionAddMenuBtn()
  {
    if (Yii::$app->request->isAjax) {
      $model = MainOption::find()->where(['key_param' => 'menu_bottom'])->one();
      $menu = json_decode($model->value, true);
      $array = array();
      foreach ($menu['data'] as $item) {
        $array[] = str_replace('item_', '', $item['id']);
      }

      $pages = Pages::find()->where(['not in', 'id', $array])->andWhere(['!=', 'id', '5'])->asArray()->select(['id', 'title'])->all();
      $articles = Articles::find()->asArray()->all();
      return $this->renderPartial('punkt_menu', [
        'pages' => $pages,
        'articles' => $articles
      ]);
    }
    if (Yii::$app->request->post()) {
      $data = Yii::$app->request->post();
      if (isset($data['param']) && !empty($data['param'])) {
        $menuList = MainOption::find()->where(['key_param' => 'menu_bottom'])->one();
        $menu = json_decode($menuList->value, true);
        $order = '';
        foreach ($menu['data'] as $val) {
          $order = $val['order'];
        }
        $order = $order + 1;
        foreach ($data['param'] as $key => $value) {
          if (isset($value['id']) && !empty($value['id'])) {
            $order = $order + 1;

            if ($value['type'] == 'item') {
              $model = Pages::findOne($value['id']);
              $model->top_menu = '1';
              $model->save();
            }

            $menu['data'][] = array(
              'id' => $value['type'] . '_' . $value['id'],
              'order' => $order,
            );
          }
        }
        $menuList->value = json_encode($menu);
        if ($menuList->save()) {
          return $this->redirect(['index']);
        }
      }
    }
  }



  public function actionShop()
  {
    $this->title = 'Настройка пункта магазина';
    $lang = LanguageSetting::find()->all();
    $list = SiteSetting::find()->where(['param' => 'shop-attr'])->all();
    $listArra = ArrayHelper::map($list, 'tag', 'value');
    $link = SiteSetting::find()->where(['param' => 'shop-link'])->all();
    $listLink = ArrayHelper::map($link, 'tag', 'value');
    if ($this->request->isPost) {
      $data = $this->request->post();
      // echo "<pre>";
      // print_r($data);
      // echo "</pre>";
      // exit();
      if (!empty($data['form'])) {
        foreach ($data['form'] as $key => $val) {
          if (!empty($val)) {
            if (SiteSetting::find()->where(['param' => 'shop-attr'])->andWhere(['tag' => $key])->exists()) {
              $model = SiteSetting::find()->where(['param' => 'shop-attr'])->andWhere(['tag' => $key])->one();
              $model->value = trim($val['name']);
            } else {
              $model = new SiteSetting([
                'param' => 'shop-attr',
                'value' => trim($val['name']),
                'tag' => $key
              ]);
            }
            if (!$model->save()) {
              var_dump($model->getErrors());
            }



            if (SiteSetting::find()->where(['param' => 'shop-link'])->andWhere(['tag' => $key])->exists()) {
              $ls = SiteSetting::find()->where(['param' => 'shop-link'])->andWhere(['tag' => $key])->one();
              $ls->value = trim($val['link']);
            } else {
              $ls = new SiteSetting([
                'param' => 'shop-link',
                'value' => trim($val['link']),
                'tag' => $key
              ]);
            }
            if (!$ls->save()) {
              var_dump($ls->getErrors());
            }
          }
        }
      }
      // if (isset($data['link']) && !empty($data['link'])) {
      //   if (SiteSetting::find()->where(['param' => 'shop-link'])->where(['tag' => $data['tag']])->exists()) {
      //     $ls = SiteSetting::find()->where(['param' => 'shop-link'])->where(['tag' => $data['tag']])->one();
      //     $ls->value = $data['link'];
      //   } else {
      //     $ls = new SiteSetting([
      //       'param' => 'shop-link',
      //       'value' => trim($data['link']),
      //       'tag' => trim($data['tag'])
      //     ]);
      //   }
      //   if (!$ls->save()) {
      //     var_dump($ls->getErrors());
      //   }
      // }
      return $this->refresh();
    }
    return $this->render('shop', [
      'lang' => $lang,
      'listArra' => $listArra,
      'listLink' => $listLink

    ]);
  }

  public function actionRemoveIcon(){
    if(Yii::$app->request->isAjax){
      $data = Yii::$app->request->post();
      if(MenuImg::find()->where(['id' => $data['id']])->exists()){
        $model = MenuImg::find()->where(['id' => $data['id']])->one();
        $model->link = null;
        if($model->save()){
          return 'ok';
        }
      }
    }
  }
}

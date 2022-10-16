<?php

namespace app\modules\admin\controllers;

use app\assets\AdminAsset;
use app\models\Articles;
use yii;
use app\models\Heading;
use app\models\LanguageSetting;
use app\models\MainOption;
use app\models\Pages;
use app\models\PagesLang;
use app\models\PagesOption;
use app\models\SliderList;
use app\models\Widget;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;

class PagesController extends MainController
{
  public $title;
  public function actionIndex()
  {
    $model = new Pages();
    $pages = Pages::find()->orderBy(['sort' => SORT_DESC])->all();
    $this->view->registerJsFile('/adminStyle/adminPages.js', ['depends' => AdminAsset::className()]);
    $menu = MainOption::find()->where(['key_param' => 'menu_list'])->one();

    if (Yii::$app->request->post()) {
      $data = Yii::$app->request->post();
      if (empty($data['link'])) {
        Yii::$app->session->setFlash('warning', "Укажите ссылку");
      }
      if (empty($data['Pages']['title'])) {
        Yii::$app->session->setFlash('warning', "Укажите заголовок");
      }
      if (Pages::find()->where(['link' => $data['link']])->exists()) {
        Yii::$app->session->setFlash('warning', "Ссылкa уже есть в базе, измените ссылку");
      }
      if (PagesLang::find()->where(['link' => $data['link']])->exists()) {
        Yii::$app->session->setFlash('warning', "Ссылкa уже есть в базе, измените ссылку");
      }
      $model->title = $data['Pages']['title'];
      $model->link = $data['link'];
      $seoParam = array(
        'desc' => $data['Seo']['desc'],
        'key' => $data['Seo']['key']
      );
      $model->link = $data['link'];
      $model->seo = json_encode($seoParam);
      if ($model->save()) {
        if (isset($data['Pages']['top_menu']) && $data['Pages']['top_menu'] == '1') {
          $thisListManu = json_decode($menu->value, true);
          $order = '';
          foreach ($thisListManu['data'] as $item) {
            $order = $item['order'];
          }
          $newOrder = $order + 1;
          $thisListManu['data'][] = array(
            'id' => 'item_' . $model->id,
            'order' => $newOrder
          );
          $menu->value = json_encode($thisListManu);
          $menu->save();
        }
        return $this->redirect(['setting', 'id' => $model->id]);
      }
    }
    $this->title = "Список страниц";
    return $this->render('index', [
      'pages' => $pages,
      'model' => $model
    ]);
  }

  public function actionRemove($id)
  {
    if (Pages::find()->where(['id' => $id])->exists()) {
      $model = Pages::find()->where(['id' => $id])->one();
      $model->delete();
    }

    if (PagesOption::find()->where(['pages_id' => $id])->exists()) {
      PagesOption::deleteAll(['pages_id' => $id]);
    }
    $menu = MainOption::find()->where(['key_param' => 'menu_list'])->one();
    $paramMenu = json_decode($menu->value, true);
    foreach ($paramMenu['data'] as $key => $val) {
      if ($val['id'] == 'item_' . $id) {
        unset($paramMenu['data'][$key]);
      }
    }
    $menu->value = json_encode($paramMenu);
    $menu->save();

    return $this->redirect(['index']);
  }

  public function actionSetting($id)
  {
    $this->title = 'Настройка страницы';
    $widgetList = Widget::find()->all();
    $model = Pages::findOne($id);
    $desc = '';
    $key = '';
    $slider = SliderList::find()->all();
    $optParam = array();
    $optParam['widget'] = PagesOption::find()
      ->where(['pages_id' => $id])
      ->andWhere(['option_param' => 'widget'])
      ->asArray()
      ->one();
    $optParam['slider'] = PagesOption::find()
      ->where(['pages_id' => $id])
      ->andWhere(['option_param' => 'slide'])
      ->asArray()
      ->one();
    $optParam['type'] = PagesOption::find()
      ->where(['pages_id' => $id])
      ->andWhere(['option_param' => 'type'])
      ->asArray()
      ->one();
    if (Yii::$app->request->post()) {
      $data = Yii::$app->request->post();

      $model->link = $data['Pages']['link'];
      $model->title = $data['Pages']['title'];
      $model->top_menu = $data['Pages']['top_menu'];
      $model->ex_link = $data['Pages']['ex_link'];
      $model->seo = json_encode($data['Seo']);
      if (!empty($data['slider'])) {
        $this->saveOptions($id, 'slide', $data['slider']);
      }
      if (isset($data["Widget"])) {
        if (isset($data["Widget"]["widgetList"]) && !empty($data["Widget"]["widgetList"])) {
          $widgetList = json_encode($data["Widget"]["widgetList"]);
          $this->saveOptions($id, 'widget', $widgetList);
        }
      }
      if (isset($data["type"])) {
        if (isset($data["type"]["Page"]) && !empty($data["type"]["Page"]) && $data["type"]["Page"] == "artic") {

          if (isset($data["type"]["Articles"])  && !empty($data["type"]["Articles"])) {
            $arctic = array(
              '0' => 'arcticles',
              '1' => $data["type"]["Articles"]
            );
            $this->saveOptions($id, 'type', json_encode($arctic));
          }
        }

        if (isset($data["type"]["Page"])  && $data["type"]["Page"] == "categ" && !empty($data["type"]["Headings"])) {
          $arctic = array(
            '0' => 'categ',
            '1' => $data["type"]["Headings"]
          );
          $this->saveOptions($id, 'type', json_encode($arctic));
        }
      }
      if (isset($data['Lang']) && !empty($data['Lang'])) {
        $res = $this->saveLang($data['Lang'], $id);
        if ($res != '200') {
          Yii::$app->session->setFlash('error', 'Для ' . $res[1] . ' ' . $res[0]);
          return $this->refresh();
        }
      }
      if ($model->save()) {
        Yii::$app->session->setFlash('success', 'Все хорошо!');
        return $this->refresh();
      }
    }

    if (!empty($model->seo)) {
      $seoArray = json_decode($model->seo, true);
      $desc = $seoArray['desc'];
      $key = $seoArray['key'];
    }
    $this->view->registerJsFile('/adminStyle/adminPages.js', ['depends' => AdminAsset::className()]);
    $lang = LanguageSetting::find()->where(['!=', 'tag', 'ru'])->asArray()->all();
    $pageLang = PagesLang::find()->where(['parent_id' => $id])->asArray()->all();



    return $this->render('settitng', [
      'model' => $model,
      'desc' => $desc,
      'key' => $key,
      'slider' => $slider,
      'widgetList' => $widgetList,
      'optParam' => $optParam,
      'lang' => $lang,
      'pageLang' => $pageLang
    ]);
  }



  public function saveLang($data, $id)
  {
    foreach ($data as $item => $val) {
      if (!empty($val['title'])) {
        if (PagesLang::find()->where(['parent_id' => $id])->andWhere(['tag' => $item])->exists()) {
          $langer = PagesLang::find()->where(['parent_id' => $id])->andWhere(['tag' => $item])->one();
          $langer->parent_id = $id;
          $langer->title = $val['title'];
          $langer->descript = $val['desc'];
          $langer->keyword = $val['key'];
          $langer->tag = $item;
          $langer->link = $val['link'];
          $langer->ex_link = $val['ex_link'];
        } else {
          $langer = new PagesLang([
            'parent_id' => $id,
            'title' => $val['title'],
            'descript' => $val['desc'],
            'keyword' => $val['key'],
            'tag' => $item,
            'link' => $val['link'],
            'ex_link' => $val['ex_link']
          ]);
        }
        if (!$langer->save()) {
          return array(
            0 => Html::errorSummary($langer, ['encode' => false]),
            1 => $item
          );
        }
      }
    }
    return '200';
  }

  public function Translit($value)
  {
    $converter = array(
      'а' => 'a',    'б' => 'b',    'в' => 'v',    'г' => 'g',    'д' => 'd',
      'е' => 'e',    'ё' => 'e',    'ж' => 'zh',   'з' => 'z',    'и' => 'i',
      'й' => 'y',    'к' => 'k',    'л' => 'l',    'м' => 'm',    'н' => 'n',
      'о' => 'o',    'п' => 'p',    'р' => 'r',    'с' => 's',    'т' => 't',
      'у' => 'u',    'ф' => 'f',    'х' => 'h',    'ц' => 'c',    'ч' => 'ch',
      'ш' => 'sh',   'щ' => 'sch',  'ь' => '',     'ы' => 'y',    'ъ' => '',
      'э' => 'e',    'ю' => 'yu',   'я' => 'ya',
    );

    $value = mb_strtolower($value);
    $value = strtr($value, $converter);
    $value = mb_ereg_replace('[^-0-9a-z]', '-', $value);
    $value = mb_ereg_replace('[-]+', '-', $value);
    $value = trim($value, '-');
    return $value;
  }



  public function saveOptions($id, $type, $data)
  {
    if (PagesOption::find()->where(['pages_id' => $id])->andWhere(['option_param' => $type])->exists()) {
      $pagesOption = PagesOption::find()->where(['pages_id' => $id])->andWhere(['option_param' => $type])->one();
    } else {
      $pagesOption = new PagesOption();
    }
    $pagesOption->pages_id = $id;
    $pagesOption->value = $data;
    $pagesOption->option_param = $type;
    $pagesOption->save();
  }

  public function actionSelectArticles()
  {
    if (Yii::$app->request->isAjax) {
      $data = Yii::$app->request->post();
      if (isset($data['id']) && !empty($data['id'])) {
        $id = $data['id'];
      } else {
        $id = '';
      }
      //'all' => 'Все статьи'
      if ($data['val'] == 'artic') {
        return $this->renderPartial('select-articles', [
          'model' => Articles::find()->select(['id', 'text'])->asArray()->all(),
          'id' => $id
        ]);
      }
      if ($data['val'] == 'categ') {
        return $this->renderPartial('select-heading', [
          'model' => Heading::find()->select(['id', 'title'])->asArray()->all(),
          'id' => $id
        ]);
      }
    }
  }
  // public function actionCreate()
  // {
  //     $model = new Heading();
  //     $list = Heading::find()->asArray()->all();
  //     if(Yii::$app->request->post()){
  //         if($model->load(Yii::$app->request->post()) && $model->validate()){
  //             if($model->save()){
  //                 return $this->refresh();    
  //             }else{
  //                 var_dump($model->getErrors());    
  //             }
  //         }else{
  //             var_dump($model->getErrors());
  //         }
  //     }
  //     return $this->render('create',[
  //         'model' => $model,
  //         'list' => $list
  //     ]);
  // }
  public function actionValidateForm()
  {
    if (Yii::$app->request->isAjax) {
      //echo ActiveForm::validate($model);
      $model = Yii::$app->request->post();
      if (empty($model['link'])) {
        Yii::$app->session->setFlash('warning', "Укажите ссылку");
        Yii::$app->end();
      }
      

      Yii::$app->response->format = Response::FORMAT_JSON;
      return ActiveForm::validate($model);
    }
  }
}

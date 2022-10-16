<?php

namespace app\modules\admin\controllers;

use app\assets\AdminAsset;
use yii;
use app\models\Heading;
use app\models\HeadingLang;
use app\models\HeadingOption;
use app\models\LanguageSetting;
use yii\web\Controller;

/**
 * Default controller for the `admin` module
 */
class HeadingsController extends MainController
{
  public $title;

  public function actionIndex($id = null)
  {
    $list = Heading::find()->asArray()->orderBy(['sort' => SORT_DESC])->all();
    $tree = $this->form_tree($list);
    $this->title = 'Рубрики';
    $this->view->registerJsFile('/adminStyle/adminKart.js', ['depends' => AdminAsset::className()]);
    $model = new Heading();
    $modelLang = new HeadingLang();
    $lang = LanguageSetting::find()->all();
    
    if (Yii::$app->request->post()) {
      $data = Yii::$app->request->post();
      
      // debug($data);
      // exit();
      if(empty($data['Heading']['title'])){
        Yii::$app->session->setFlash('success', "Не заполнен заголовок");
        return $this->refresh();
      }
      $model->title = $data['Heading']['title'];
      $model->descript = $data['Heading']['descript'];
      $model->key_meta = $data['Heading']['key_meta'];
      $model->col = $data['Heading']['col'];
      $model->text = $data['Heading']['text'];
      if(empty($data['Heading']['link'])){
        $model->link = $this->Translit($data['Heading']['title']);
      }else{
        $model->link = $data['Heading']['link'];
      }

      if ($model->save()) {
        if (isset($data['HeadingLang']) && !empty($data['HeadingLang'])) {
          foreach ($data['HeadingLang'] as $key => $val) {
            $optHeading = new HeadingLang([
              'heading_id' => $model->id,
              'title' => $val['name'],
              'descript' => $val['descript'],
              'key_meta' => $val['key_meta'],
              'text' => $val['text'],
              'tag' => $key,
            ]);
            if(empty($val['link'])){
              $optHeading->link = $this->Translit($val['name']);
            }else{
              $optHeading->link = $val['link'];
            }
            $optHeading->save();
          }
        }
        Yii::$app->session->setFlash('success', "Изменения сохранены");
        return $this->redirect(['index', 'id' => $model->id]);
      } else {
        return var_dump($model->getErrors());
      }
    }

    return $this->render('index', [
      'tree' => $this->build_tree($tree, 0),
      'id' => $id,
      'model' => $model,
      'lang' => $lang,
      'modelLang' => $modelLang,
      'list' => $list,
    ]);
  }

  public function actionCreate()
  {
    $model = new Heading();
    $list = Heading::find()->asArray()->all();
    if (Yii::$app->request->post()) {
      $data = Yii::$app->request->post();
      if(empty($data["Heading"]["title"])){
        return $this->refresh();
      }
      if ($model->load(Yii::$app->request->post()) && $model->validate()) {
        if ($model->save()) {
          return $this->redirect(['index']);
        } else {
          var_dump($model->getErrors());
        }
      } else {
        var_dump($model->getErrors());
      }
    }

    $this->title = 'Новая рубрика';
    return $this->render('create', [
      'model' => $model,
      'list' => $list,

    ]);
  }

  public function form_tree($mess)
  {
    if (!is_array($mess)) {
      return false;
    }
    $tree = array();
    foreach ($mess as $value) {
      $tree[$value['parent_id']][] = $value;
    }
    return $tree;
  }



  public function build_tree($cats, $parent_id)
  {
    if (is_array($cats) && isset($cats[$parent_id])) {
      $tree = '<ul>';

      foreach ($cats[$parent_id] as $cat) {

        $tree .= '<li><span class="list-trab list-olf-' . $cat['id'] . '" data-id="' . $cat['id'] . '">' . $cat['title'] . '<span class="dels" data-id="' . $cat['id'] . '"><i class="fa fa-trash"></i></span></span>';
        $tree .= $this->build_tree($cats, $cat['id']);
        $tree .= '</li>';
      }
      $tree .= '</ul>';
    } else {
      return false;
    }
    return $tree;
  }

  public function actionHeadingUpdate()
  {
    if (Yii::$app->request->isAjax) {
      $list = Heading::find()->asArray()->orderBy(['sort' => SORT_DESC])->all();
      $data = Yii::$app->request->post();

      $lang = LanguageSetting::find()->all();
      $model = Heading::find()->where(['id' => $data['id']])->one();
      if (!empty($lang)) {
        return $this->renderAjax('update_lang', [
          'model' => $model,
          'lang' => $lang,
          'modelLang' => HeadingLang::find()->where(['heading_id' => $data['id']])->all(),
          'list' => $list
        ]);
      }
      return $this->renderAjax('update', [
        'model' => $model
      ]);
    }

    if (Yii::$app->request->post()) {
      $data = Yii::$app->request->post();
      //var_dump($this->Translit($data['Heading']['title']));
      //debug($data);
      //exit();

      if(!isset($data['Heading']['title']) || empty($data['Heading']['title'])){
        Yii::$app->session->setFlash('success', "Не указан заголовок");
        return $this->refresh();
      }

      if (isset($data['HeadingLang']) && !empty($data['HeadingLang'])) {
        foreach ($data['HeadingLang'] as $key => $val) {
          if (HeadingLang::find()->where(['heading_id' => $data['Heading']['id']])->andWhere(['tag' => $key])->exists()) {
            $optHeading = HeadingLang::find()->where(['heading_id' => $data['Heading']['id']])->andWhere(['tag' => $key])->one();
            $optHeading->title = $val['name'];
            $optHeading->descript = $val['descript'];
            $optHeading->key_meta = $val['key_meta'];
            $optHeading->text = $val['text'];
            
          } else {
            $optHeading = new HeadingLang([
              'heading_id' => $data['Heading']['id'],
              'title' => $val['name'],
              'descript' => $val['descript'],
              'key_meta' => $val['key_meta'],
              'text' => $val['text'],
              'tag' => $key,
            ]);
          }
          if(empty($val['link']) && !empty($val['name'])){
            $optHeading->link = $this->Translit($val['name']);
          }else{
            $optHeading->link = $val['link'];
          }

          if(!isset($data['Heading']['parent_id']) || empty($data['Heading']['parent_id'])){
            $optHeading->parent_id = '0';
          }else{
            $optHeading->parent_id = $data['Heading']['parent_id'];
          }
          $optHeading->save();
        }
      }

      if (isset($data['ArticlesType']) && !empty($data['ArticlesType'])) {
        foreach ($data['ArticlesType'] as $esr => $emr) {
          if (HeadingOption::find()->where(['heading_id' => $data['Heading']['id']])->andWhere(['option_param' => $esr])->exists()) {
            $kb1Model = HeadingOption::find()->where(['heading_id' => $data['Heading']['id']])->andWhere(['option_param' => $esr])->one();
            $kb1Model->value = json_encode($emr);
          } else {
            $kb1Model = new HeadingOption([
              'heading_id' => $data['Heading']['id'],
              'option_param' => $esr,
              'value' => json_encode($emr)
            ]);
          }
          if(!$kb1Model->save()){
            return var_dump($kb1Model->getErrors());
          }
        }
      }

      if (Heading::find()->where(['id' => $data['Heading']['id']])->exists()) {
        $heading = Heading::find()->where(['id' => $data['Heading']['id']])->one();
        $heading->title = $data['Heading']['title'];
        $heading->descript = $data['Heading']['descript'];
        $heading->key_meta = $data['Heading']['key_meta'];
        $heading->col = $data['Heading']['col'];
        $heading->text = $data['Heading']['text'];

        if(empty($data['Heading']['link'])){
          $heading->link = $this->Translit($data['Heading']['title']);
        }else{
          $heading->link = $data['Heading']['link'];
        }
        if(!isset($data['Heading']['parent_id']) || empty($data['Heading']['parent_id'])){
          $heading->parent_id = '0';
        }else{
          $heading->parent_id = $data['Heading']['parent_id'];
        }

        $heading->parent_id = $data['Heading']['parent_id'];
        if ($heading->save()) {
          Yii::$app->session->setFlash('success', "Изменения сохранены");
          return $this->redirect(['index', 'id' => $data['Heading']['id']]);
        } else {
          return var_dump($heading->getErrors());
        }
      }
    }
  }

  public function actionDelete()
  {
    if (Yii::$app->request->isAjax) {
      $data = Yii::$app->request->post();
      $model = Heading::findOne($data['id']);
      if ($model->delete()) {
        if (Heading::find()->where(['parent_id' => $data['id']])->exists()) {
          $arrty = Heading::find()->where(['parent_id' => $data['id']])->all();
          foreach ($arrty as $item) {
            $item->parent_id = '0';
            $item->save();
          }
          return true;
        } else {
          return true;
        }
      }
    }
  }

  public function actionSaveImage()
  {
    if (Yii::$app->request->isAjax) {
      $input_name = 'file';
      if (!isset($_FILES[$input_name])) {
        $error = 'Файл не загружен.';
        $data = array(
          'error'   => $error,
          'success' => '',
          'path' => '',
          'dataTag' => ''
        );
        return  json_encode($data, JSON_UNESCAPED_UNICODE);
      } else {
        $file = $_FILES[$input_name];
        $path = Yii::getAlias('@webroot') . '/headings/';
        $result = $this->saveImage($path, $file);
        return $result;
      }
    }
  }

  public function actionSaveImageHead()
  {
    if (Yii::$app->request->isAjax) {
      $data = Yii::$app->request->post();
      if (Heading::find()->where(['id' => $data['id']])->exists()) {
        $model = Heading::find()->where(['id' => $data['id']])->one();
        $model->img = $data['img'];
        if ($model->save()) {
          return 'Ok';
        } else {
          var_dump($model->getErrors());
        }
      }
    }
  }
  //image
  public function saveImage($path, $file)
  {
    $error = $success = '';
    $allow = array('jpg', 'jpeg', 'png', 'svg', 'gif');
    $deny = array(
      'phtml', 'php', 'php3', 'php4', 'php5', 'php6', 'php7', 'phps', 'cgi', 'pl', 'asp',
      'aspx', 'shtml', 'shtm', 'htaccess', 'htpasswd', 'ini', 'log', 'sh', 'js', 'html',
      'htm', 'css', 'sql', 'spl', 'scgi', 'fcgi', 'exe'
    );
    if (!empty($file['error']) || empty($file['tmp_name'])) {
      $error = 'Не удалось загрузить файл.';
    } elseif ($file['tmp_name'] == 'none' || !is_uploaded_file($file['tmp_name'])) {
      $error = 'Не удалось загрузить файл.';
    } else {
      $pattern = "[^a-zа-яё0-9,~!@#%^-_\$\?\(\)\{\}\[\]\.]";
      $name = mb_eregi_replace($pattern, '-', $file['name']);
      $name = mb_ereg_replace('[-]+', '-', $name);
      $name = rand(0, 999) . $name;
      $parts = pathinfo($name);
      if (empty($name) || empty($parts['extension'])) {
        $error = 'Недопустимый тип файла';
      } elseif (!empty($allow) && !in_array(strtolower($parts['extension']), $allow)) {
        $error = 'Недопустимый тип файла';
      } elseif (!empty($deny) && in_array(strtolower($parts['extension']), $deny)) {
        $error = 'Недопустимый тип файла';
      } else {
        if (move_uploaded_file($file['tmp_name'], $path . $name)) {
          $success = '<p style="color: green">Файл «' . $name . '» успешно загружен.</p>';
        } else {
          $error = 'Не удалось загрузить файл.';
        }
      }
    }
    $data = array(
      'error'   => $error,
      'success' => $success,
      'path' => $name,
      'dataTag' => rand(0, 999) . 'img' . rand(0, 999)
    );
    return  json_encode($data, JSON_UNESCAPED_UNICODE);
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
}

<?php

namespace app\modules\admin\controllers;

use app\assets\AdminAsset;
use app\models\ArticleLang;
use app\models\Articles;
use app\models\ArticlesOption;
use app\models\ArticlesOptionLang;
use app\models\Authors;
use app\models\GqlleryHtml;
use app\models\Heading;
use app\models\LanguageSetting;
use app\models\LinkRels;
use app\models\PagesOption;
use app\models\VideoList;
use app\models\Widget;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class ArticlesController extends MainController
{
  public $title;
  public $size = array(
    // '1920',
    '1680',
    '1440',
    '1280',
    '375'
  );
  public function actionList()
  {
    $mainArt = null;
    $model = Articles::find()->all();
    $this->title = "Список статей";
    $pages = PagesOption::find()->where(['pages_id' => '5'])->andWhere(['option_param' => 'type'])->asArray()->one();
    if (!empty($pages)) {
      if (!empty($pages['value'])) {
        $arraTp = json_decode($pages['value'], true);
        if ($arraTp['0'] == 'arcticles') {
          $mainArt = $arraTp['1'];
        }
      }
    }

    return $this->render('list', [
      'model' => $model,
      'mainArt' => $mainArt
    ]);
  }

  public function actionIndex()
  {
    $this->title = 'Новая статья';

    $this->view->registerJsFile('/adminStyle/adminImage.js', ['depends' => AdminAsset::className()]);
    $this->view->registerJsFile('/adminStyle/adminText.js', ['depends' => AdminAsset::className()]);
    $this->view->registerCssFile('/adminStyle/customTextParam.css');
    $this->view->registerCssFile('//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css');
    $this->view->registerCssFile('/css/defaultStyle1680.css');

    $widget = Widget::find()->select(['id', 'title'])->asArray()->all();
    $langue = LanguageSetting::find()->all();
    $this->layout = 'dashbord';
    return $this->render('index', [
      'heading' => Heading::find()->asArray()->all(),
      'articlesOption' => null,
      'widget' => $widget,
      'langue' => $langue,
      'size' => $this->size
    ]);
  }

  public function actionNewTextBlock()
  {
    if (Yii::$app->request->isAjax) {
      $randId = rand(0, 99999);
      return $this->renderAjax('text-block', [
        'randId' => $randId
      ]);
    }
  }

  public function actionUpdate($id)
  {
    $model = '';
    $defaultModel = Articles::findOne($id);
    if (Articles::find()->where(['id' => $id])->exists()) {
      $model = Articles::findOne($id);
    }
    $articlesOption = ArticlesOption::find()->where(['articles_id' => $id])->asArray()->all();
    $this->title = 'Редактировать статью ';
    $this->view->registerJsFile('/adminStyle/adminImage.js', ['depends' => AdminAsset::className()]);
    $this->view->registerJsFile('/adminStyle/adminText.js', ['depends' => AdminAsset::className()]);
    $this->view->registerJsFile('/adminStyle/updateArticles.js', ['depends' => AdminAsset::className()]);
    $widget = Widget::find()->select(['id', 'title'])->asArray()->all();
    $this->view->registerCssFile('/adminStyle/customTextParam.css');
    $this->view->registerCssFile('//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css');
    $this->view->registerCssFile('/css/defaultStyle1680.css');
    $widtVal = ArticlesOption::find()->where(['articles_id' => $id])->andWhere(['option_param' => 'widget_articles'])->asArray()->one();
    $widgetVal = null;
    if (!empty($widtVal)) {
      $widgetVal = json_decode($widtVal['value'], true);
    }

    if (!empty($widgetVal)) {
      $listWg = $this->GetWidgetList($widgetVal);
    } else {
      $listWg = null;
    }
    $langue = LanguageSetting::find()->all();
    $this->layout = 'dashbord';
    return $this->render('update', [
      'model' => $model,
      'articlesOption' => ArrayHelper::map($articlesOption, 'option_param', 'value'),
      'heading' => Heading::find()->asArray()->all(),
      'widget' => $widget,
      'widgetVal' => $widgetVal,
      'langue' => $langue,
      'size' => $this->size,
      'tag' => 'ru',
      'mot' => null,
      'defaultModel' => $defaultModel,
      'id' => $id,
      'listWg' => $listWg

    ]);
  }

  public function actionTemplates()
  {
    return $this->render('templates');
  }

  public function actionNewTitleBlock()
  {
    if (Yii::$app->request->isAjax) {
      $data = Yii::$app->request->post();
      return $this->renderAjax('NewTitleBlock', [
        'data' => $data
      ]);
    }
  }
  public function actionNewTitleBlockInCol()
  {
    if (Yii::$app->request->isAjax) {
      $data = Yii::$app->request->post();
      return $this->renderAjax('NewTitleBlockInCol', [
        'data' => $data
      ]);
    }
  }

  public function actionParamTitle()
  {
    if (Yii::$app->request->isAjax) {
      $data = Yii::$app->request->post();
      $color = $data['color'];
      $id = $data['id'];

      return $this->renderAjax('ParamTitle', [
        'color' => $color,
        'id' => $id,
        'data' => $data
      ]);
    }
  }

  public function actionTempalteAutor()
  {
    return $this->render('autor-templates');
  }
  public function actionAdAuthor()
  {
    return $this->renderAjax('autor-default');
  }

  public function actionAdShare()
  {
    return $this->renderAjax('share-default');
  }

  public function saveImage($path, $file)
  {
    $error = $success = '';
    $allow = array('jpg', 'jpeg', 'png', 'svg', 'gif', 'webp');
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


  public function actionSaveArtclesImage()
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
        $path = Yii::getAlias('@webroot') . '/articles/';
        $result = $this->saveImage($path, $file);
        return $result;
      }
    }
  }

  public function actionAddImage()
  {
    if (Yii::$app->request->isAjax) {

      $input_name = 'file';
      if (!isset($_FILES[$input_name])) {
        $error = 'Файл не загружен.';
      } else {
        $file = $_FILES[$input_name];
        $path = Yii::getAlias('@webroot') . '/gallery/';
        $result = $this->saveImage($path, $file);
        return $result;
      }
    }
  }


  public function actionImgParam()
  {
    if (Yii::$app->request->isAjax) {
      $data = Yii::$app->request->post();

      return $this->renderAjax('param-img', [
        'tag' => $data['tag'],
        'data' => $data
      ]);
    }
  }
  //endimage

  public function actionTemplateGalery()
  {
    // $this->view->registerJsFile();
    $dataProvider = new ActiveDataProvider([
      'query' => GqlleryHtml::find(),
      /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            */
    ]);
    $this->view->registerJsFile('/adminStyle/adminGal.js', ['depends' => AdminAsset::className()]);
    $this->view->registerCssFile('/adminStyle/adminGal.css');
    return $this->render('template-galery', [
      'dataProvider' => $dataProvider
    ]);
  }

  public function actionSaveArtic()
  {
    if (Yii::$app->request->isAjax) {
      $ids = null;
      $data = Yii::$app->request->post();
      if (empty($data['id'])) {
        $model = new Articles();
      } else {
        $ids = $data['id'];
        if (empty($data['lang'])) {
          $model = Articles::find()->where(['id' => $data['id']])->one();
        } else {
          if ($data['lang'] == 'ru' && $data['size'] == '1680') {
            $model = Articles::find()->where(['id' => $data['id']])->one();
          } else {
            if (ArticleLang::find()->where(['lang' => $data['lang']])->andWhere(['parent_id' => $data['id']])->andWhere(['size' => $data['size']])->exists()) {
              $model = ArticleLang::find()
                ->where(['lang' => $data['lang']])
                ->andWhere(['size' => $data['size']])
                ->andWhere(['parent_id' => $data['id']])
                ->one();
            } else {
              $model = new ArticleLang([
                'parent_id' => $data['id'],
                'lang' => $data['lang'],
                'size' => $data['size']
              ]);
            }
          }
        }
      }
      if (empty($data['title'])) {
        if (!empty($data['texter'])) {
          $model->text = trim($data['texter']);
        } else {
          $model->text = 'Статья ' . date('Y-m-d H:s');
        }
      } else {
        $model->text = trim($data['title']);
      }

      $model->content = $data['html'];
      if ($model->save()) {
        if (empty($ids)) {
          $ids = $model->id;
        }
        $moter = $this->SetOptions($data, $ids, $data['lang'], $data['texter'], $data['title']);
        if ($moter == "200") {
          return $model->id;
        } else {
          return $moter;
        }
      } else {
        return var_dump($model->getErrors());
      }
    }
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

  public function SetOptions($data, $id, $lang, $texter, $title)
  {
    $array = array('articleSiblid', 'botomBanner', 'mainHeading', 'heading', 'text', 'title', 'img_articles', 'widget_articles', 'videoArticles', 'noindexArticles', 'link', 'description', 'keywords');
    foreach ($array as $item => $val) {
      if (!empty($lang) && $lang != 'ru') {
        if (ArticlesOptionLang::find()->where(['option_param' => $val])->andWhere(['articles_id' => $id])->andWhere(['tag' => $lang])->exists()) {
          $model = ArticlesOptionLang::find()
            ->where(['option_param' => $val])
            ->andWhere(['articles_id' => $id])
            ->one();
        } else {
          $model = new ArticlesOptionLang([
            'articles_id' => $id,
            'option_param' => $val,
            'tag' => $lang
          ]);
        }
      } else {
        if (ArticlesOption::find()->where(['option_param' => $val])->andWhere(['articles_id' => $id])->exists()) {
          $model = ArticlesOption::find()
            ->where(['option_param' => $val])
            ->andWhere(['articles_id' => $id])
            ->one();
        } else {
          $model = new ArticlesOption([
            'articles_id' => $id,
            'option_param' => $val,
          ]);
        }
      }

      if (!empty($data[$val])) {
        if (is_array($data[$val])) {
          $value = json_encode($data[$val]);
        } else {
          $value = $data[$val];
        }
        if($val == 'link'){
          $model->value = $this->Translit($value);
        }else{
          $model->value = $value;
        }
      }else{
        if ($val == 'link') {

            if (empty($title)) {
              if (!empty($texter)) {
                $link = $this->Translit($texter);
              } else {
                $link = 'link-' . rand(0, 999) . '-' . rand(0, 999) . '-id-' . $id;
              }
            } else {
              $link = $this->Translit($title);
            }

          if (isset($model->value) && !empty($model->value) && $model->value != $link) {
            if (LinkRels::find()->where(['old' => $model->value])->exists()) {
              $linkRels = LinkRels::find()->where(['old' => $model->value])->one();
              $linkRels->old = $model->value;
              $linkRels->new = $link;
            } else {
              $linkRels = new LinkRels([
                'old' => $model->value,
                'new' => $link
              ]);
            }
            $linkRels->save();
          }

          $model->value = $link;
        }
      }

      if (!$model->save()) {
        return var_dump($model->getErrors());
      }
    }
    return "200";
  }

  public function actionAuthorSerring()
  {
    if (Yii::$app->request->isAjax) {
      $model = Authors::find()->asArray()->all();
      $data = Yii::$app->request->post();
      return $this->renderAjax('author-setting', [
        'model' => $model,
        'data' => $data
      ]);
    }
  }

  public function actionSelcetAuthors()
  {
    if (Yii::$app->request->isAjax) {
      $data = Yii::$app->request->post();
      if (Authors::find()->where(['id' => $data['val']])->exists()) {
        $model = Authors::find()->where(['id' => $data['val']])->asArray()->select(['name', 'photo', 'link'])->one();
        return json_encode($model);
      } else {
        return false;
      }
    }
  }

  public function actionRenderImage()
  {
    if (Yii::$app->request->isAjax) {
      $data = Yii::$app->request->post();
      $dataTag = rand(0, 999) . 'img' . rand(0, 999);
      return $this->renderAjax('render-image', [
        'data' => $data['src'],
        'dataTag' => $dataTag
      ]);
    }
  }

  public function actionRemoveImage()
  {
    if (Yii::$app->request->isAjax) {
      $data = Yii::$app->request->post();
      $dataTag = rand(0, 999) . 'img' . rand(0, 999);
      return '/gallery/' . $data;
    }
  }

  public function actionParamSocial()
  {
    if (Yii::$app->request->isAjax) {
      $data = Yii::$app->request->post();
      return $this->renderAjax('ParamSocial', [
        'data' => $data
      ]);
    }
  }

  public function actionSaveGall()
  {
    if (Yii::$app->request->isAjax) {
      $data = Yii::$app->request->post();
      $model = new GqlleryHtml([
        'value' => $data['html'],
        'name' => $data['name'],
      ]);
      if ($model->save()) {
        return true;
      }
    }
  }

  public function actionVideoSave()
  {
    if (Yii::$app->request->isAjax) {
      $data = Yii::$app->request->post();
      $title = '';
      if (!empty($data['key_id'])) {
        $pos = strripos($data['key_id'], "v=",);
        if ($pos !== false) {
          $key = stristr($data['key_id'], "v=");
          $key = str_replace("v=", "", $key);
          trim($key);
        } else {
          $posTwo = strrchr($data['key_id'], "/");
          if ($posTwo !== false) {
            $key = str_replace("/", "", $posTwo);
          } else {
            $key = $data['key_id'];
          }
        }
        if (VideoList::find()->where(['key_id' => $key])->exists()) {
          $model = VideoList::find()->where(['key_id' => $key])->one();
          $model->key_id = $key;
        } else {
          $model = new VideoList([
            'key_id' => $key
          ]);
        }


        if ($model->save()) {
          $url = $this->CheckVideo($key);

          if ($url) {
            $file = "https://www.googleapis.com/youtube/v3/videos?id=" . $key . "&key=AIzaSyCEmhV8WOoINq7oUjeLQA-DSU6N9EQEDPk&part=snippet&fields=items(snippet(title))";
            $content = @file_get_contents($file, true);
            if ($content === false) {
            } else {
              $map = json_decode($content, true);
              if (isset($map['items'][0]['snippet']['title']) && !empty($map['items'][0]['snippet']['title'])) {
                $title = $map['items'][0]['snippet']['title'];
              }
            }

            return $this->renderPartial('video-block', [
              'url' => $url,
              'key_id' => $model->key_id,
              'title' => $title,
              'type' => $data['type']
            ]);
          } else {
            return $url;
          }
        } else {
          var_dump($model->getErrors());
        }
      }
    }
  }

  public function CheckVideo($param)
  {
    $obj = array(
      'maxresdefault.jpg',
      'sddefault.jpg',
      'hqdefault.jpg',
      'mqdefault.jpg',
      'default.jpg'
    );
    foreach ($obj as $key => $val) {
      $url = "https://img.youtube.com/vi/" . $param . "/" . $val;
      if (file_exists($url)) {
        ini_set('default_socket_timeout', '12');
        $fp = fopen($url, "r");
        $res = fread($fp, 500);
        fclose($fp);
        if (strlen($res) > 0) {
          return $url;
        }
      } else {
        return $url;
      }
    }
    return false;
  }

  public function actionAddUl()
  {
    if (Yii::$app->request->isAjax) {
      $data = Yii::$app->request->post();
      return $this->renderAjax('list-param', [
        'id' => $data['id'],
        'array' => $data['array'],
        'output' => $data['output']
      ]);
    }
  }

  public function actionArrayUl()
  {
    if (Yii::$app->request->isAjax) {
      $data = Yii::$app->request->post();

      if (isset($data['array']) && !empty($data['array'])) {
        $map = ArrayHelper::map($data['array'], 'name', 'value');
        unset($map['_csrf']);
        return $this->renderPartial('render-ul', ['map' => $map, 'data' => $data]);
      }
    }
  }
  public function actionArticlesVersion($id, $tag, $size)
  {
    $model = '';
    $defaultModel = Articles::findOne($id);
    if ($tag == 'ru') {
      if ($size == '1680') {
        $model = Articles::findOne($id);
      } else {
        if (ArticleLang::find()->where(['lang' => $tag])->andWhere(['parent_id' => $id])->andWhere(['size' => $size])->exists()) {
          $model = ArticleLang::find()->where(['lang' => $tag])->andWhere(['parent_id' => $id])->andWhere(['size' => $size])->one();
        } else {
          $model = Articles::findOne($id);
        }
      }
    } else {
      if (ArticleLang::find()->where(['lang' => $tag])->andWhere(['parent_id' => $id])->exists()) {
        if (ArticleLang::find()->where(['lang' => $tag])->andWhere(['parent_id' => $id])->andWhere(['size' => $size])->exists()) {
          $model = ArticleLang::find()->where(['lang' => $tag])->andWhere(['parent_id' => $id])->andWhere(['size' => $size])->one();
        } else {
          if (ArticleLang::find()->where(['lang' => $tag])->andWhere(['parent_id' => $id])->andWhere(['size' => 1680])->exists()) {
            $model = ArticleLang::find()->where(['lang' => $tag])->andWhere(['parent_id' => $id])->andWhere(['size' => 1680])->one();
          } else {
            if (Articles::find()->where(['id' => $id])->exists()) {
              $model = Articles::findOne($id);
            }
          }
        }
      } else {
        if (Articles::find()->where(['id' => $id])->exists()) {
          $model = Articles::findOne($id);
        }
      }
    }
    if ($tag != 'ru') {
      $articlesOption = ArticlesOptionLang::find()->where(['articles_id' => $id])->andWhere(['tag' => $tag])->asArray()->all();
    } else {
      $articlesOption = ArticlesOption::find()->where(['articles_id' => $id])->asArray()->all();
    }


    $this->title = 'Редактировать статью';
    $this->view->registerJsFile('/adminStyle/adminImage.js', ['depends' => AdminAsset::className()]);
    $this->view->registerJsFile('/adminStyle/adminText.js', ['depends' => AdminAsset::className()]);
    $this->view->registerJsFile('/adminStyle/updateArticles.js', ['depends' => AdminAsset::className()]);
    $widget = Widget::find()->select(['id', 'title'])->asArray()->all();
    $this->view->registerCssFile('/adminStyle/customTextParam.css');
    $this->view->registerCssFile('//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css');
    if ($size == '1680') {
      $this->view->registerCssFile('/css/defaultStyle1680.css');
    }
    if ($size == '1440') {
      $this->view->registerCssFile('/css/defaultStyle1440.css');
    }
    if ($size == '1280') {
      $this->view->registerCssFile('/css/defaultStyle1280.css');
    }
    if ($size == '375') {
      $this->view->registerCssFile('/adminStyle/styleCss375.css');
      $this->view->registerCssFile('/css/defaultStyle375.css');
    }
    $widtVal = ArticlesOption::find()->where(['articles_id' => $id])->andWhere(['option_param' => 'widget_articles'])->asArray()->one();
    $widgetVal = null;
    if (!empty($widtVal)) {
      $widgetVal = json_decode($widtVal['value'], true);
    }
    if (!empty($widgetVal)) {
      $listWg = $this->GetWidgetList($widgetVal);
    } else {
      $listWg = null;
    }

    $langue = LanguageSetting::find()->all();
    $this->layout = 'dashbord';
    return $this->render('update', [
      'model' => $model,
      'articlesOption' => ArrayHelper::map($articlesOption, 'option_param', 'value'),
      'heading' => Heading::find()->asArray()->all(),
      'widget' => $widget,
      'widgetVal' => $widgetVal,
      'langue' => $langue,
      'size' => $this->size,
      'mot' => $size,
      'tag' => $tag,
      'defaultModel' => $defaultModel,
      'id' => $id,
      'listWg' => $listWg
    ]);
  }




  public function actionSliderGel()
  {
    if (Yii::$app->request->isAjax) {
      $ids = rand(0, 999) . rand(0, 999);
      return $this->renderPartial('slider-gal', [
        'ids' => $ids
      ]);
    }
  }

  public function actionParamSlider()
  {
    if (Yii::$app->request->isAjax) {
      $data = Yii::$app->request->post();
      return $this->renderPartial('slider-param', [
        'id' => $data['id'],
        'data' => $data
      ]);
    }
  }
  public function actionAddSliderField()
  {
    if (Yii::$app->request->isajax) {
      $data = Yii::$app->request->post();
      $id = stristr($data['id'], '-', true);
      $name = stristr($data['id'], '-');
      $res = $id + 1;
      return $this->renderPartial('filed-slider', [
        'name' => $name,
        'res' => $res
      ]);
      return $res;
    }
  }
  public function actionGenSlider()
  {
    if (Yii::$app->request->isAjax) {
      $data = Yii::$app->request->post();
      $array = array();
      foreach ($data['array'] as $k => $v) {
        $array[$v['name']] = $v['value'];
      }
      foreach ($data['array'] as $key => $val) {
        if ($val['name'] == '_csrf' || $val['name'] == 'id') {
          unset($data['array'][$key]);
        }
        if ($val['name'] == 'main') {
          $data['main'] = $val['value'];
        }
        if ($val['name'] == 'main-in-modal') {
          $data['modal'] = $val['value'];
        }
      }

      return $this->renderPartial('gen-slider', [
        'data' => $data,
        'array' => $array
      ]);
    }
  }
  public function actionMainHeading()
  {
    if (Yii::$app->request->isAjax) {
      $data = Yii::$app->request->post();
      $model = Heading::find()->where(['id' => $data['val']])->all();
      return $this->renderPartial('heading-select', [
        'model' => $model
      ]);
    }
  }

  public function actionGetWidget()
  {
    if (Yii::$app->request->isAjax) {
      $data = Yii::$app->request->post();
      if (!empty($data['val'])) {
        $widget = new Widget();
        $lang = 'ru';
        $model = Widget::find()->where(['id' => $data['val']])->asArray()->all();
        return $this->renderPartial('left-aside', [
          'model' => $model,
          'widget' => $widget,
          'lang' => $lang
        ]);
      }
    }
  }



  public function GetWidgetList($array)
  {
    if (!empty($array)) {
      $widget = new Widget();
      $lang = 'ru';
      $model = Widget::find()->where(['id' => $array])->asArray()->all();
      return $this->renderPartial('left-aside', [
        'model' => $model,
        'widget' => $widget,
        'lang' => $lang
      ]);
    }
  }
  public function actionRenderImageGal()
  {
    if (Yii::$app->request->isAjax) {
      return $this->renderAjax('image-render-gal');
    }
  }

  public function actionDelVer($id, $tag, $size){
    if(ArticleLang::find()->where(['parent_id' => $id])->andWhere(['size' => $size])->andWhere(['lang' => $tag])->exists()){
      $model = ArticleLang::find()->where(['parent_id' => $id])->andWhere(['size' => $size])->andWhere(['lang' => $tag])->one();
      
      if($model->delete()){
          return $this->redirect(['/admin/articles/articles-version', 'id' => $id, 'tag' => $tag, 'size' => '1680']);
        
        // return $this->redirect(['/admin/articles/update', 'id' => $id]);
      }
      
    }
  }
}

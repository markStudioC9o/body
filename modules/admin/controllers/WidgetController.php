<?php

namespace app\modules\admin\controllers;

use app\assets\AdminAsset;
use app\models\Articles;
use app\models\LanguageSetting;
use app\models\Widget;
use app\models\WidgetBanner;
use app\models\WidgetLang;
use app\models\WidgetParam;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * WidgetController implements the CRUD actions for Widget model.
 */
class WidgetController extends MainController
{
  /**
   * @inheritDoc
   */
  public $title;

  public function behaviors()
  {
    return array_merge(
      parent::behaviors(),
      [
        'verbs' => [
          'class' => VerbFilter::className(),
          'actions' => [
            'delete' => ['POST'],
          ],
        ],
      ]
    );
  }

  /**
   * Lists all Widget models.
   *
   * @return string
   */
  public function actionIndex()
  {
    $dataProvider = new ActiveDataProvider([
      'query' => Widget::find(),
    ]);
    $this->title = "Боковые виджеты";
    return $this->render('index', [
      'dataProvider' => $dataProvider,
    ]);
  }

  public function actionView($id)
  {
    return $this->render('view', [
      'model' => $this->findModel($id),
    ]);
  }

  public function actionCreate()
  {
    $model = new Widget();

    if ($this->request->isPost) {
      $model->image = UploadedFile::getInstance($model, 'image');
      if (!empty($model->image)) {
        $model->img = $model->upload();
      }
      if ($model->load($this->request->post()) && $model->save()) {
        return $this->redirect(['index']);
      }
    } else {
      $model->loadDefaultValues();
    }
    $lang = LanguageSetting::find()->where(['!=', 'tag', 'ru'])->all();
    $this->title = 'Новый виджет';
    $this->view->registerJsFile('/adminStyle/adminWidget.js', ['depends' => AdminAsset::className()]);
    return $this->render('create', [
      'model' => $model,
      'lang' => $lang
    ]);
  }

  public function actionUpdate($id)
  {
    $model = $this->findModel($id);
    if (WidgetBanner::find()->where(['parent_id' => $id])->exists()) {
      return $this->redirect(['update-baners', 'id' => $id]);
    }
    if ($model->img == 'widget-articles') {
      return $this->redirect(['update-articles', 'id' => $model->id]);
    }
    if ($this->request->isPost) {
      $data = Yii::$app->request->post();
      $model->image = UploadedFile::getInstance($model, 'image');
      if (!empty($model->image)) {
        $model->img = $model->upload();
      }
      if (isset($data['Lang']) && !empty($data['Lang'])) {
        foreach ($data['Lang'] as $elem => $value) {
          if (WidgetLang::find()->where(['parent_id' => $id])->andWhere(['tag' => $elem])->exists()) {
            $widgetLang = WidgetLang::find()->where(['parent_id' => $id])->andWhere(['tag' => $elem])->one();
          } else {
            $widgetLang = new WidgetLang();
          }
          $param = array(
            'title' => $value['title'],
            'content' => $value['content']
          );
          $widgetLang->param = json_encode($param);
          $widgetLang->parent_id = $id;
          $widgetLang->tag = $elem;
          if (!$widgetLang->save()) {
            return var_dump($widgetLang->getErrors());
          }
        }
      }

      if ($model->load($data) && $model->save()) {
        return $this->redirect(['index']);
      } else {
        return var_dump($model->getErrors());
      }
    } else {
      $model->loadDefaultValues();
    }
    $lang = LanguageSetting::find()->where(['!=', 'tag', 'ru'])->all();
    $mapLang = '';
    if (!empty($lang)) {
      $mapLang = ArrayHelper::getColumn($lang, 'tag');
    }
    $widgetLangContent = WidgetLang::find()->where(['parent_id' => $id])->andWhere(['tag' => $mapLang])->asArray()->all();
    $dataProvider = new ActiveDataProvider([
      'query' => WidgetParam::find()->where(['parent_id' => $id]),
    ]);
    $this->view->registerJsFile('/adminStyle/adminWidget.js', ['depends' => AdminAsset::className()]);
    $this->title = 'Настройки виджета';
    return $this->render('update', [
      'model' => $model,
      'lang' => $lang,
      'parent' => $id,
      'dataProvider' => $dataProvider,
      'widgetLangContent' => $widgetLangContent
    ]);
  }

  public function actionUpdateBaners($id)
  {
    $model = Widget::findOne($id);
    $dataProvider = new ActiveDataProvider([
      'query' => WidgetBanner::find()->where(['parent_id' => $id])
    ]);

    if (Yii::$app->request->isPost) {
      $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
      if (!empty($model->imageFiles)) {
        $res = $model->uploads();
        if (!empty($res)) {
          if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
              foreach ($res as $key => $val) {
                $banners = new WidgetBanner([
                  'parent_id' => $model->id,
                  'img' => $val
                ]);
                if (!$banners->save()) {
                  return var_dump($banners->getErrors());
                }
              }
              return $this->refresh();
            } else {
              return var_dump($model->getErrors());
            }
          }
        }
      } else {
        if ($model->load(Yii::$app->request->post())) {
          if ($model->save()) {
            return $this->refresh();
          }else{
            return var_dump($model->getErrors());
          }
        }
      }
    }

    $this->title = "Редактировать баннеоый виджет";
    return $this->render('update-banners', [
      'model' => $model,
      'dataProvider' => $dataProvider
    ]);
  }

  public function actionDelete($id)
  {
    $this->findModel($id)->delete();

    return $this->redirect(['index']);
  }

  protected function findModel($id)
  {
    if (($model = Widget::findOne(['id' => $id])) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }

  public function actionCreateParam($id)
  {
    $this->title = 'Параметры виджета';
    $model = new WidgetParam();
    if ($this->request->isPost) {
      $data = Yii::$app->request->post();
      $model->image = UploadedFile::getInstance($model, 'image');
      if (!empty($model->image)) {
        $model->img = $model->upload();
      }
      if ($model->load($data)) {
        if ($model->save()) {
          return $this->redirect(['update', 'id' => $id]);
        } else {
          var_dump($model->getErrors());
        }
      }
    }
    return $this->render('add-param', [
      'model' => $model,
      'id' => $id
    ]);
  }

  public function actionParamDelete($id, $parent)
  {
    if (WidgetParam::find()->where(['id' => $id])->exists()) {
      $model = WidgetParam::find()->where(['id' => $id])->one();
      if ($model->delete()) {
        return $this->redirect(['/admin/widget/update', 'id' => $parent]);
      }
    }
  }
  public function actionCreateBanners()
  {
    $this->title = 'Новый баннерый виджет';
    $model = new Widget();
    $lang = LanguageSetting::find()->where(['!=', 'tag', 'ru'])->all();
    if (Yii::$app->request->isPost) {
      $data = Yii::$app->request->post();
      $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
      if (!empty($model->imageFiles)) {
        $res = $model->uploads();
        if (!empty($res)) {
          if ($model->load($data)) {
            if ($model->save()) {
              foreach ($res as $key => $val) {
                $banners = new WidgetBanner([
                  'parent_id' => $model->id,
                  'img' => $val
                ]);
                if (!$banners->save()) {
                  return var_dump($banners->getErrors());
                }else{
                  return $this->redirect(["/admin/widget/update-baners", "id" => $model->id]);
                }
              }
            } else {
              return var_dump($model->getErrors());
            }
          }
        }
        //print_r($res);
      } else {
        var_dump($model->getErrors());
      }
    }
    return $this->render('create-banners', [
      'lang' => $lang,
      'model' => $model
    ]);
  }
  public function actionBannerDelete($id, $widget)
  {
    $model = WidgetBanner::findOne($id);
    $model->delete();
    return $this->redirect(['update-baners', 'id' => $widget]);
  }

  public function actionCreateArticles()
  {
    $model = new Widget();
    $articles = Articles::find()->asArray()->all();
    foreach ($articles as $key => $val) {
      $articles[$key]['text'] = $val['id'] . '-' . $val['text'];
    }
    if (Yii::$app->request->isPost) {
      $data = Yii::$app->request->post();
      if (isset($data['Widget']['widgetArticles']) && !empty($data['Widget']['widgetArticles'])) {
        $result = json_encode($data['Widget']['widgetArticles']);
        $model->title = $data['Widget']['title'];
        $model->img = 'widget-articles';
        $model->content = $result;
        if ($model->save()) {
          return $this->redirect(['update-articles', 'id' => $model->id]);
        }
      }
    }
    $this->title = 'Виджет статей';
    return $this->render('articles-widget', [
      'articles' => $articles,
      'model' => $model
    ]);
  }

  public function actionUpdateArticles($id)
  {
    $model = Widget::findOne($id);
    $articles = Articles::find()->asArray()->all();
    foreach ($articles as $key => $val) {
      $articles[$key]['text'] = $val['id'] . '-' . $val['text'];
    }
    if (Yii::$app->request->isPost) {
      $data = Yii::$app->request->post();
      if (isset($data['Widget']['widgetArticles']) && !empty($data['Widget']['widgetArticles'])) {
        $result = json_encode($data['Widget']['widgetArticles']);
        $model->title = $data['Widget']['title'];
        $model->img = 'widget-articles';
        $model->content = $result;
        if ($model->save()) {
          return $this->redirect(['update-articles', 'id' => $model->id]);
        }
      }
    }
    $this->title = 'Виджет статей';
    return $this->render('articles-widget', [
      'articles' => $articles,
      'model' => $model
    ]);
  }
}

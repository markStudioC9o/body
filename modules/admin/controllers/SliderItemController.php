<?php

namespace app\modules\admin\controllers;

use app\assets\AdminAsset;
use app\models\LanguageSetting;
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
class SliderItemController extends MainController
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

  public function actionIndex($id)
  {
    $dataProvider = new ActiveDataProvider([
      'query' => SliderItem::find()->where(['slider_id' => $id]),
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

    return $this->render('index', [
      'dataProvider' => $dataProvider,
      'id' => $id
    ]);
  }

  public function actionView($id)
  {
    return $this->render('view', [
      'model' => $this->findModel($id),
    ]);
  }

  public function actionCreate($id)
  {
    $model = new SliderItem();
    $slider = SliderList::findOne($id);
    if ($this->request->isPost) {


      if ($model->load($this->request->post())) {
        $model->image = UploadedFile::getInstance($model, 'image');
        if (!empty($model->image)) {
          $ids = $id;
          $model->img = $model->upload($ids);
        }
        if ($model->save(false)) {
          return $this->redirect(['/admin/slider/update', 'id' => $id]);
        }
      }
    } else {
      $model->loadDefaultValues();
    }
    $this->title = 'Новый слайд для слайдера';
    $this->view->registerJsFile('/adminStyle/adminSlider.js', ['depends' => AdminAsset::className()]);
    return $this->render('create', [
      'slider' => $slider,
      'model' => $model,
      'id' => $id
    ]);
  }
  public function actionUpdate($id, $slider, $tag = null)
  {
    if(empty($tag)){
      $model = $this->findModel($id);
    }else{
      if(SliderLang::find()->where(['parent_id' => $id])->andWhere(['tag' => $tag])->exists()){
        $model = SliderLang::find()->where(['parent_id' => $id])->andWhere(['tag' => $tag])->one();
      }else{
        $model = new SliderLang();
      }
    }
    if ($this->request->isPost) {
      
        if ($model->load($this->request->post())) {
          $model->image = UploadedFile::getInstance($model, 'image');
          if (!empty($model->image)) {
            $ids = $id;
            $model->img = $model->upload($ids);
          }
          if(!empty($tag)){
            $model->parent_id = $id;
          }
          if ($model->save(false)) {
            return $this->refresh();
          }else{
            var_dump($model->getErrors());
          }
        }
    } else {
      $model->loadDefaultValues();
    }
    $lang = LanguageSetting::find()->where(['!=', 'tag', 'ru'])->asArray()->all();
    $this->view->registerJsFile('/adminStyle/adminSlider.js', ['depends' => AdminAsset::className()]);
    $this->title = 'Изменить слайд';
    return $this->render('update', [
      'lang' => $lang,
      'model' => $model,
      'slider' => $slider,
      'id' => $id,
      'tag' => $tag
    ]);
  }

  public function actionDelete($id, $slider)
  {
    $this->findModel($id)->delete();
    return $this->redirect(['/admin/slider/update', 'id'=>$slider]);
  }

  protected function findModel($id)
  {
    if (($model = SliderItem::findOne(['id' => $id])) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }
}

<?php

namespace app\modules\admin\controllers;

use app\models\Authors;
use app\models\AuthorsLang;
use app\models\LanguageSetting;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * AuthorsController implements the CRUD actions for Authors model.
 */
class AuthorsController extends MainController
{

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
   * Lists all Authors models.
   *
   * @return string
   */
  public function actionIndex()
  {
    $dataProvider = new ActiveDataProvider([
      'query' => Authors::find(),
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

    $this->title = 'Авторы';
    return $this->render('index', [
      'dataProvider' => $dataProvider,
    ]);
  }

  public function actionCreate()
  {
    $model = new Authors();
    $lang = LanguageSetting::find()->where(['!=', 'tag', 'ru'])->all();

    if ($this->request->isPost) {
      $data = Yii::$app->request->post();
      $model->image = UploadedFile::getInstance($model, 'image');
      if (!empty($model->image)) {
        $model->photo = $model->upload();
      }

      if ($model->load($data) && $model->save()) {
        if (isset($data['Lang']) && !empty($data['Lang'])) {
          $this->SaveLangAuthors($model->id, $data['Lang']);
        }
        return $this->redirect(['index']);
      }
    } else {
      $model->loadDefaultValues();
    }
    $this->title = 'Добавить нового автора';
    return $this->render('create', [
      'model' => $model,
      'lang' => $lang
    ]);
  }

  public function actionUpdate($id)
  {
    $model = $this->findModel($id);
    
    if ($this->request->isPost) {
      $data = Yii::$app->request->post();
      $model->image = UploadedFile::getInstance($model, 'image');
      if (!empty($model->image)) {
        $model->photo = $model->upload();
      }
      if ($model->load($data) && $model->save()) {
        if (isset($data['Lang']) && !empty($data['Lang'])) {
          $this->SaveLangAuthors($model->id, $data['Lang']);
        }
        return $this->redirect(['index']);
      }
    } else {
      $model->loadDefaultValues();
    }
    $lang = LanguageSetting::find()->where(['!=', 'tag', 'ru'])->asArray()->all();
    $langer = AuthorsLang::find()->where(['parent_id' => $id])->asArray()->all();
    $this->title = 'Редактирование автора: ' . $model->name;
    return $this->render('update', [
      'model' => $model,
      'langer' => $langer,
      'lang' => $lang
    ]);
  }

  public function SaveLangAuthors($id, $data)
  {
    foreach ($data as $item => $value) {
      if (AuthorsLang::find()->where(['parent_id' => $id])->andWhere(['tag' => $item])->exists()) {
        $model = AuthorsLang::find()->where(['parent_id' => $id])->andWhere(['tag' => $item])->one();
        $model->param = json_encode($value);
      } else {
        $model = new AuthorsLang([
          'parent_id' => $id,
          'tag' => $item,
          'param' => json_encode($value)
        ]);
      }
      if (!$model->save()) {
        return false;
      }
    }
  }



  public function actionDelete($id)
  {
    $this->findModel($id)->delete();

    return $this->redirect(['index']);
  }

  protected function findModel($id)
  {
    if (($model = Authors::findOne(['id' => $id])) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }
}

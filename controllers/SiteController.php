<?php

namespace app\controllers;

use app\models\ArticleLang;
use app\models\Articles;
use app\models\ArticlesOption;
use app\models\ArticlesOptionLang;
use app\models\Cities;
use app\models\CitiesLang;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Countries;
use app\models\PagesOption;
use app\models\SliderItem;
use yii\helpers\ArrayHelper;

class SiteController extends MainController
{
  /**
   * {@inheritdoc}
   */
  public function behaviors()
  {
    return [
      'access' => [
        'class' => AccessControl::className(),
        'only' => ['logout'],
        'rules' => [
          [
            'actions' => ['logout'],
            'allow' => true,
            'roles' => ['@'],
          ],
        ],
      ],
      'verbs' => [
        'class' => VerbFilter::className(),
        'actions' => [
          //'logout' => ['post'],
        ],
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function actions()
  {
    return [
      // 'error' => [
      //     'class' => 'yii\web\ErrorAction',
      // ],
      'captcha' => [
        'class' => 'yii\captcha\CaptchaAction',
        'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
      ],
    ];
  }

  public function actionIndex()
  {
    
    $session = Yii::$app->session;
    $lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : null;
    
    $sizeSes = isset($_SESSION['size']) ? $_SESSION['size'] : null;
    //print_r($sizeSes);
    if (!empty($sizeSes)) {
      if ($sizeSes > '1600') {
        
        $stecSize = "1680";
        
      } elseif ($sizeSes < 1599 && $sizeSes > 1366) {
        $stecSize = "1440";
      } elseif ($sizeSes < 1365 && $sizeSes > 1024) {
        $stecSize = "1280";
      } elseif ($sizeSes < 1023) {
        $stecSize = "375";
      } else {
        $stecSize = "1680";
      }
    }else{
      $stecSize = "1680";
    }



    //print_r($sizeSes);
    $sliderLang = '';
    $viewSlider = '';
    
    
    $slider = PagesOption::find()->where(['pages_id' => '5'])->andWhere(['option_param' => 'slide'])->asArray()->one();
    if (!empty($slider)) {
      $viewSlider = SliderItem::find()->where(['slider_id' => $slider['value']])->asArray()->all();
    }
    
    if (!empty($lang) && $lang != 'ru') {
    }
    $pagesParam = PagesOption::find()->where(['pages_id' => '5'])->andWhere(['option_param' => 'type'])->one();

    $content = json_decode($pagesParam->value, true);
    //return var_dump($sizeSes,$lang,$stecSize, $content);
    if ($content[0] == 'arcticles') {
      if ($lang == 'ru' || empty($lang)) {
        if (isset($stecSize) && !empty($stecSize)) {
          if (ArticleLang::find()->where(['parent_id' => $content[1]])->andWhere(['lang' => 'ru'])->andWhere(['size' => $stecSize])->exists()) {
            $model = ArticleLang::find()->where(['parent_id' => $content[1]])->andWhere(['lang' => 'ru'])->andWhere(['size' => $stecSize])->one();
          } else {
            $model = Articles::find()->where(['id' => $content[1]])->one();
          }
        }else{
          $model = Articles::find()->where(['id' => $content[1]])->one();
        }
      } else {
        if (ArticleLang::find()->where(['parent_id' => $content[1]])->andWhere(['lang' => $lang])->andWhere(['size' => $stecSize])->exists()) {
          
          $model = ArticleLang::find()->where(['parent_id' => $content[1]])->andWhere(['lang' => $lang])->andWhere(['size' => $stecSize])->one();
        } else {
          
          $model = Articles::find()->where(['id' => $content[1]])->one();
        }
      }
    }

    $param = PagesOption::find()->where(['pages_id' => '5'])->asArray()->all();
    $param = ArrayHelper::map($param, 'option_param', 'value');

    if($lang == 'ru'){
      $options = ArticlesOption::find()->where(['articles_id' => $model->id])->asArray()->all();
    }else{
      $options = ArticlesOptionLang::find()->where(['articles_id' => $model->id])->andWhere(['tag' => $lang])->asArray()->all();
    }
    
    $paramArticles = array();
    if (!empty($options)) {
      $paramArticles = ArrayHelper::map($options, 'option_param', 'value');
    }
    if(isset($paramArticles['shipet']) && !empty($paramArticles['shipet'])){
      Yii::$app->params['shipet'] = '/shipet/'.$paramArticles['shipet'];
    }
    if(isset($paramArticles['keywords']) && !empty($paramArticles['keywords'])){
      Yii::$app->params['keywords'] = $paramArticles['keywords'];
    }
    if(isset($paramArticles['description']) && !empty($paramArticles['description'])){
      Yii::$app->params['description'] = $paramArticles['description'];
    }
    if(isset($paramArticles['title']) && !empty($paramArticles['title'])){
      Yii::$app->params['title'] = $paramArticles['title'];
    }


    return $this->render('index', [
      'viewSlider' => $viewSlider,
      'model' => $model,
      'param' => $param
    ]);
  }

  // public function actionLogin()
  // {
  //   if (!Yii::$app->user->isGuest) {
  //     return $this->goHome();
  //   }

  //   $model = new LoginForm();
  //   if ($model->load(Yii::$app->request->post()) && $model->login()) {
  //     return $this->goBack();
  //   }

  //   $model->password = '';
  //   return $this->render('login', [
  //     'model' => $model,
  //   ]);
  // }

  public function actionLogout()
  {
    Yii::$app->user->logout();

    return $this->goHome();
  }

  public function actionContact()
  {
    $model = new ContactForm();
    if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
      Yii::$app->session->setFlash('contactFormSubmitted');

      return $this->refresh();
    }
    return $this->render('contact', [
      'model' => $model,
    ]);
  }

  public function actionAbout()
  {
    return $this->render('about');
  }

  public function actionError()
  {
    $exception = Yii::$app->errorHandler->exception;
    if ($exception !== null) {
      if ($exception->statusCode == 404)
        return $this->render('error404', ['exception' => $exception]);
      else
        return $this->render('error', ['exception' => $exception]);
    }
  }

  public function actionDefPage()
  {
    return $this->render('error404');
  }

  public function actionSearch($search)
  {
    return $this->render('search', [
      'search' => $search
    ]);
  }

  public function actionSizeLoad()
  {
    if (Yii::$app->request->isAjax) {
      $data = Yii::$app->request->post();
      $session = Yii::$app->session;
      $size = isset($_SESSION['size']) ? $_SESSION['size'] : null;
      if ($data["windowWidth"] != $size) {
        $session->set('size', $data["windowWidth"]);
        return "203";
        // if (1680 < $data["windowWidth"] && 1680 < $size) {
        //   return false;
        // } elseif (
        //   1680 > $data["windowWidth"] &&
        //   1440 < $data["windowWidth"] &&
        //   1440 < $size &&
        //   1680 > $size
        // ) {
        //   return false;
        // } elseif (
        //   1440 > $data["windowWidth"] &&
        //   1280 < $data["windowWidth"] &&
        //   1440 < $size &&
        //   1280 > $size
        // ) {
        //   return false;
        // } elseif (
        //   1280 > $data["windowWidth"] &&
        //   375 < $data["windowWidth"] &&
        //   1280 < $size &&
        //   1028 > $size
        // ) {
        //   return false;
        // } else {
        //   $session->set('size', $data["windowWidth"]);
        //   return "203";
        // }
      } else {
        return false;
      }
    }
  }

  public function actionImagePopup()
  {
    if (Yii::$app->request->isajax) {
      $data = Yii::$app->request->post();
      return $this->renderPartial('gen-pop', ['data' => $data]);
    }
  }

  public function actionLocationCity()
  {
    if (Yii::$app->request->isAjax) {
      $data = Yii::$app->request->post();
      $session = Yii::$app->session;
      if (Cities::find()->where(['like', 'name', $data['city']])->exists()) {
        $city = Cities::find()->where(['like', 'name', $data['city']])->one();
        $country = Countries::find()->where(['id' => $city->counries_id])->one();
        $lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : null;
        $citys = isset($_SESSION['city']) ? $_SESSION['city'] : null;
        if (!empty($lang)) {
          //$session->set('lang', $country->tag);
        } else {
          //$session['lang'] = $country->tag;
        }
        if (!empty($citys)) {
          $session->set('city', $city->name);
        } else {
          $session['city'] = $city->name;
        }
      } else {
        if (CitiesLang::find()->where(['like', 'name', $data['city']])->exists()) {
          $model = CitiesLang::find()->where(['like', 'name', $data['city']])->one();
          $city = Cities::find()->where(['id' => $model->parent_id])->one();
          $country = Countries::find()->where(['id' => $city->counries_id])->one();
          if (!empty($lang)) {
            //$session->set('lang', $country->tag);
          } else {
            //$session['lang'] = $country->tag;
          }
          if (!empty($citys)) {
            $session->set('city', $city->name);
          } else {
            $session['city'] = $city->name;
          }
        }
      }
    }
  }
}

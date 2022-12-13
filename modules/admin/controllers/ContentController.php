<?php


namespace app\modules\admin\controllers;

use app\models\CallbacField;
use app\models\CallbacFieldLang;
use app\models\CallbackParam;
use app\models\CallbackParamLang;
use app\models\CallbacOption;
use app\models\CallbacWidget;
use app\models\CallbacWidgetLang;
use app\models\CillbacOptionLang;
use app\models\LanguageSetting;
use app\models\SiteSetting;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;

/**
 * Default controller for the `admin` module
 */
class ContentController extends MainController
{
  public $title = 'Наполнение и переводы';

  public $structure = array(
    1 => array(
      'name' => '',
      'text' => ''
    ),
    2 => array(
      'name' => '',
      'text' => ''
    ),
    3 => array(
      'name' => '',
      'text' => ''
    ),
  );
  public function actionIndex($tag = null)
  {
    if(empty($tag)){
      $tag = 'ru';
    }
    $lang = LanguageSetting::find()->all();
    if ($tag == null || $tag == 'ru') {
      $model = $this->getModelFooter('ru');
    } else {
      $model = $this->getModelFooter($tag);
    }
    if (isset($model->value) && !empty($model->value)) {
      $tells = json_decode($model->value, true);
    } else {
      $tells = $this->structure;
    }




    if ($tag == null || $tag == 'ru') {
      $modelAut = $this->getAuthors('ru');
    } else {
      $modelAut = $this->getAuthors($tag);
    }

    if ($tag == null || $tag == 'ru') {
      $modelActiveBannersTitle = $this->activeBannersTitle('ru');
    } else {
      $modelActiveBannersTitle = $this->activeBannersTitle($tag);
    }

    

    if ($tag == null || $tag == 'ru') {
      $modelSearch = $this->getSearch('ru');
    } else {
      $modelSearch = $this->getSearch($tag);
    }
    if (isset($modelSearch->value) && !empty($modelSearch->value)) {
      $search = $modelSearch->value;
    } else {
      $search = null;
    }
    

    if (isset($modelAut->value) && !empty($modelAut->value)) {
      $athors = $modelAut->value;
    } else {
      $athors = null;
    }

    if ($tag == null || $tag == 'ru') {
      $modal = $this->getModal('ru');
    } else {
      $modal = $this->getModal($tag);
    }
    if (isset($modal->value) && !empty($modal->value)) {
      $modalTitle = $modal->value;
    } else {
      $modalTitle = null;
    }


    // asdasdasd
    if ($tag == null || $tag == 'ru') {
      $crambs = $this->getBreadcrambs('ru');
    } else {
      $crambs = $this->getBreadcrambs($tag);
    }
    if (isset($crambs->value) && !empty($crambs->value)) {
      $crambsTitle = $crambs->value;
    } else {
      $crambsTitle = null;
    }
    //asdasdasdasd



    if ($tag == null || $tag == 'ru') {
      $banners = $this->getBanners('ru');
    } else {
      $banners = $this->getBanners($tag);
    }
    if (isset($banners->value) && !empty($banners->value)) {
      $bannersTitle = $banners->value;
    } else {
      $bannersTitle = null;
    }





    if ($tag == null || $tag == 'ru') {
      $FooterTitle = $this->getFooterTitle('ru');
    } else {
      $FooterTitle = $this->getFooterTitle($tag);
    }
    if (isset($FooterTitle->value) && !empty($FooterTitle->value)) {
      $Ftitle = json_decode($FooterTitle->value, true);
    } else {
      $Ftitle = array('1' => '', '2' => '');
    }

    

    if ($this->request->isPost) {
      $data = $this->request->post();
      // echo "<pre>";
      // print_r($data);
      // echo "</pre>";
      // exit();
      
      if (isset($data['search']) && !empty($data['search'])) {
        $modelSearch->value = $data['search'];
        $modelSearch->param = 'search';
        $modelSearch->tag = $tag;
        if (!$modelSearch->save()) {
          var_dump($modelSearch->getErrors());
        }
      }

      if (isset($data['tells']) && !empty($data['tells'])) {
        $model->value = json_encode($data['tells']);
        $model->param = 'pre_footer';
        $model->tag = $tag;
        if (!$model->save()) {
          var_dump($model->getErrors());
        }
      }

      if(isset($data['atrouk']) && !empty($data['atrouk'])){
        $modelAut->value = $data['atrouk'];
        $modelAut->param = 'val_authors';
        $modelAut->tag = $tag;
        if (!$modelAut->save()) {
          var_dump($modelAut->getErrors());
        }
      }

      // breadcrambs
      if(isset($data['breadcrambs']) && !empty($data['breadcrambs'])){
        $crambs->value = $data['breadcrambs'];
        $crambs->param = 'breadcrambs';
        $crambs->tag = $tag;
        if (!$crambs->save()) {
          var_dump($crambs->getErrors());
        }
      }

      if(isset($data['bannersTitle']) && !empty($data['bannersTitle'])){
        $banners->value = $data['bannersTitle'];
        $banners->param = 'banners';
        $banners->tag = $tag;
        if (!$banners->save()) {
          var_dump($banners->getErrors());
        }
        
      }

      if(isset($data['activeBannersTitle']) && !empty($data['activeBannersTitle'])){
        $modelActiveBannersTitle->value = $data['activeBannersTitle'];
        $modelActiveBannersTitle->param = 'activeBannersTitle';
        $modelActiveBannersTitle->tag = $tag;
      }else{
        $modelActiveBannersTitle->value = '0';
        $modelActiveBannersTitle->param = 'activeBannersTitle';
        $modelActiveBannersTitle->tag = $tag;
      }
      if (!$modelActiveBannersTitle->save()) {
        var_dump($modelActiveBannersTitle->getErrors());
      }


      if(isset($data['modalTitle']) && !empty($data['modalTitle'])){
        $modal->value = $data['modalTitle'];
        $modal->param = 'modal-title';
        $modal->tag = $tag;
        if (!$modal->save()) {
          var_dump($modal->getErrors());
        }
        
      }


      if (isset($data['footertitle']) && !empty($data['footertitle'])) {
        $FooterTitle->value = json_encode($data['footertitle']);
        $FooterTitle->param = 'footer-title';
        $FooterTitle->tag = $tag;
        if (!$FooterTitle->save()) {
          var_dump($FooterTitle->getErrors());
        }
      }
      return $this->refresh();
    }
    return $this->render('index', [
      'lang' => $lang,
      'tag' => $tag,
      'model' => $model,
      'tells' => $tells,
      'athors' => $athors,
      'Ftitle' => $Ftitle,
      'modalTitle' => $modalTitle,
      'bannersTitle' => $bannersTitle,
      'search' => $search,
      'crambsTitle' => $crambsTitle,
      'modelActiveBannersTitle' => $modelActiveBannersTitle
    ]);
  }



  public function getModelFooter($tag)
  {
    if (SiteSetting::find()->where(['param' => 'pre_footer'])->andWhere(['tag' => $tag])->exists()) {
      $model = SiteSetting::find()->where(['param' => 'pre_footer'])->andWhere(['tag' => $tag])->one();
    } else {
      $model = new SiteSetting();
    }
    return $model;
  }

  public function getAuthors($tag)
  {
    if (SiteSetting::find()->where(['param' => 'val_authors'])->andWhere(['tag' => $tag])->exists()) {
      $model = SiteSetting::find()->where(['param' => 'val_authors'])->andWhere(['tag' => $tag])->one();
    } else {
      $model = new SiteSetting();
    }
    return $model;
  }

  public function getFooterTitle($tag)
  {
    if (SiteSetting::find()->where(['param' => 'footer-title'])->andWhere(['tag' => $tag])->exists()) {
      $model = SiteSetting::find()->where(['param' => 'footer-title'])->andWhere(['tag' => $tag])->one();
    } else {
      $model = new SiteSetting();
    }
    return $model;
  }

  public function getModal($tag)
  {
    if (SiteSetting::find()->where(['param' => 'modal-title'])->andWhere(['tag' => $tag])->exists()) {
      $model = SiteSetting::find()->where(['param' => 'modal-title'])->andWhere(['tag' => $tag])->one();
    } else {
      $model = new SiteSetting();
    }
    return $model;
  }

  public function getBanners($tag)
  {
    if (SiteSetting::find()->where(['param' => 'banners'])->andWhere(['tag' => $tag])->exists()) {
      $model = SiteSetting::find()->where(['param' => 'banners'])->andWhere(['tag' => $tag])->one();
    } else {
      $model = new SiteSetting();
    }
    return $model;
  }

  public function getBreadcrambs($tag)
  {
    if (SiteSetting::find()->where(['param' => 'breadcrambs'])->andWhere(['tag' => $tag])->exists()) {
      $model = SiteSetting::find()->where(['param' => 'breadcrambs'])->andWhere(['tag' => $tag])->one();
    } else {
      $model = new SiteSetting();
    }
    return $model;
  }

  public function getSearch($tag)
  {
    if (SiteSetting::find()->where(['param' => 'search'])->andWhere(['tag' => $tag])->exists()) {
      $model = SiteSetting::find()->where(['param' => 'search'])->andWhere(['tag' => $tag])->one();
    } else {
      $model = new SiteSetting();
    }
    return $model;
  }

  public function activeBannersTitle($tag)
  {
    if (SiteSetting::find()->where(['param' => 'activeBannersTitle'])->andWhere(['tag' => $tag])->exists()) {
      $model = SiteSetting::find()->where(['param' => 'activeBannersTitle'])->andWhere(['tag' => $tag])->one();
    } else {
      $model = new SiteSetting();
    }
    return $model;
  }

}

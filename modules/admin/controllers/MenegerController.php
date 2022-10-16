<?php

namespace app\modules\admin\controllers;

use app\assets\AdminAsset;
use app\models\Articles;
use app\models\ArticlesOption;
use app\models\CityList;
use app\models\FooterHeaderParam;
use yii;
use app\models\Heading;
use app\models\LanguageSetting;
use app\models\MainOption;
use app\models\Pages;
use Faker\Provider\Lorem;
use yii\web\Controller;


/**
 * Default controller for the `admin` module
 */
class MenegerController extends MainController
{
  public $title;
  public function actionIndex()
  {
    $this->title = 'Файловый менеджер';
    $path = Yii::getAlias('@webroot').'/'.'file';
    $dirGall = scandir($path);
    $cat = array();
    foreach($dirGall as $key => $item){
        if($item !='.' && $item !='..' && !is_dir($path.$item)){
            $cat[] = $item;
        }
    }
    return $this->render('index', [
      'path' => $path,
      'dirGall' => $dirGall
    ]);
  }
}

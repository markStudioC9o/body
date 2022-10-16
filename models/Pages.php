<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "pages".
 *
 * @property int $id
 * @property string|null $title
 * @property int|null $parent_id
 * @property int|null $sort
 */
class Pages extends \yii\db\ActiveRecord
{
  //public $idP;
  public static function tableName()
  {
    return 'pages';
  }

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['parent_id', 'sort'], 'integer'],
      [['title'], 'string', 'max' => 500],
      [['link'], 'string', 'max' => 255],
      [['ex_link'], 'string', 'max' => 255],
      [['seo'], 'string'],
      [['link'], 'unique'],
      [['link', 'title'], 'required'],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function attributeLabels()
  {
    return [
      'title' => 'Заголовок',
      'parent_id' => 'Parent ID',
      'sort' => 'Sort',
      'link' => 'Внутренняя ссылка',
      'ex_link' => 'Внешние ссылки'
    ];
  }

  public function findId($id)
  {
    $idObj = preg_replace('/[^0-9]/', '', $id);
    $lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : null;
    if ($lang == 'ru' || empty($lang)) {
      $result = $this->find()->where(['id' => $idObj])->asArray()->one();
    } else {
      $result = PagesLang::find()->where(['parent_id' => $idObj])->andWhere(['tag' => $lang])->asArray()->one();
    }

    return $result;
  }

  public function findNameFromId($id)
  {
    $idObj = preg_replace('/[^0-9]/', '', $id);
    $lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : null;

    if ($lang == 'ru' || empty($lang)) {
      $result = $this->find()->where(['id' => $idObj])->asArray()->one();
    } else {
      $result = PagesLang::find()->where(['parent_id' => $idObj])->andWhere(['tag' => $lang])->asArray()->one();
    }

    $link = $result['link'];
    $exlink = $result['ex_link'];
    $title = $result['title'];


    if (MenuParam::find()->where(['parent_id' => $id])->andWhere(['tag' => $lang])->exists()) {
      $menuParam = MenuParam::find()->where(['parent_id' => $id])->andWhere(['tag' => $lang])->asArray()->one();
      if (isset($menuParam['link']) && !empty($menuParam['link'])) {
        $link = $menuParam['link'];
      }
      if (isset($menuParam['value']) && !empty($menuParam['value'])) {
        $title = $menuParam['value'];
      }
      if (isset($menuParam['ex_link']) && !empty($menuParam['ex_link'])) {
        $exlink = $menuParam['ex_link'];
      }
    } else {
      $menuParam = 'asd';
    }
    $elem = array(
      'title' => $title,
      'link' => $link,
      'ex_link' => $exlink,
      'tag' => $lang,
      'array' => $menuParam,
      'id' => $id

    );

    return $elem;
  }

  public function findIds($id)
  {
    if (stristr($id, '_', true) == 'item') {
      $idObj = preg_replace('/[^0-9]/', '', $id);
      $result = $this->find()->where(['id' => $idObj])->asArray()->one();
      return $result;
    }

    if (stristr($id, '_', true) == 'artic') {
      $idObj = preg_replace('/[^0-9]/', '', $id);
      $result = Articles::find()->where(['id' => $idObj])->asArray()->one();
      return $result;
    }
    if (stristr($id, '_', true) == 'heading') {
      $idObj = preg_replace('/[^0-9]/', '', $id);
      $result = Heading::find()->where(['id' => $idObj])->asArray()->one();
      return $result;
    }
  }

  public function findImg($id)
  {
    if (MenuImg::find()->where(['parent_id' => $id])->exists()) {
      $obj = MenuImg::find()->where(['parent_id' => $id])->asArray()->one();
      return $obj;
    } else {
      return null;
    }
  }

  public function findArticId($id)
  {
    $result = array();
    if (stristr($id, '_', true) == 'artic') {
      $lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'en';
      $idObj = preg_replace('/[^0-9]/', '', $id);
      if ($lang == 'ru') {
        $result['artic'] = Articles::find()->where(['id' => $idObj])->asArray()->one();
        $option = ArticlesOption::find()->where(['articles_id' => $idObj])->asArray()->all();
        $result['option'] = ArrayHelper::map($option, 'option_param', 'value');
      } else {
        $result['artic'] = ArticleLang::find()->where(['parent_id' => $idObj])->andWhere(['lang' => $lang])->asArray()->one();
        $option = ArticlesOptionLang::find()->where(['articles_id' => $idObj])->andWhere(['tag' => $lang])->asArray()->all();
        $result['option'] = ArrayHelper::map($option, 'option_param', 'value');
      }
      return $result;
    }
  }


  public function findArticFromId($id)
  {

    $result = array();
    if (stristr($id, '_', true) == 'artic') {
      $lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'en';
      $idObj = str_replace("artic_", "", $id);

      if ($lang == 'ru') {
        $result['artic'] = Articles::find()->where(['id' => $idObj])->asArray()->one();
        $option = ArticlesOption::find()->where(['articles_id' => $idObj])->asArray()->all();
        $result['option'] = ArrayHelper::map($option, 'option_param', 'value');
      } else {
        $result['artic'] = ArticleLang::find()->where(['parent_id' => $idObj])->andWhere(['lang' => $lang])->asArray()->one();
        $option = ArticlesOptionLang::find()->where(['articles_id' => $idObj])->andWhere(['tag' => $lang])->asArray()->all();
        $result['option'] = ArrayHelper::map($option, 'option_param', 'value');
      }
      return $result;
    }
  }



  public function findHeadingId($id)
  {
    $objId = str_replace("heading_", "", $id);
    $lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'en';
    if ($lang == 'ru') {
      $model = Heading::find()->where(['id' => $objId])->asArray()->one();
    } else {
      $model = HeadingLang::find()->where(['heading_id' => $objId])->andWhere(['tag' => $lang])->asArray()->one();
    }
    return $model;
  }

  public function findSubMobId($id){
    $lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'en';
    $idObj = preg_replace('/[^0-9]/', '', $id);
    $result = array(
      'title' => '',
      'link' => '',
      'ex_link' => '',
      'type' => ''
    );
    if (stristr($id, '_', true) == 'artic') {
      if ($lang == 'ru') {
        $artic = Articles::find()->where(['id' => $idObj])->asArray()->one();
        $option = ArticlesOption::find()->where(['articles_id' => $idObj])->asArray()->all();
        $articOption = ArrayHelper::map($option, 'option_param', 'value');
      } else {
        $artic = ArticleLang::find()->where(['parent_id' => $idObj])->andWhere(['lang' => $lang])->asArray()->one();
        $option = ArticlesOptionLang::find()->where(['articles_id' => $idObj])->andWhere(['tag' => $lang])->asArray()->all();
        $articOption = ArrayHelper::map($option, 'option_param', 'value');
      }

      $title = isset($artic['text']) && !empty($artic['text']) ? $artic['text'] : null; 
      $link = isset($articOption['link']) && !empty($artic['link']) ? $artic['link'] : null; 
      $type = 'articles';
    }



    if (stristr($id, '_', true) == 'heading') {
      if ($lang == 'ru') {
        $model = Heading::find()->where(['id' => $idObj])->asArray()->one();
      } else {
        $model = HeadingLang::find()->where(['heading_id' => $idObj])->andWhere(['tag' => $lang])->asArray()->one();
      }
      
      $title = isset($model['title']) && !empty($model['title']) ? $model['title'] : null; 
      $link = isset($model['link']) && !empty($model['link']) ? $model['link'] : null;
      $type = 'page';
    }


    if(stristr($id, '_', true) == 'item'){
      if ($lang == 'ru') {
        $model = Pages::find()->where(['id' => $idObj])->asArray()->one();
      } else {
        $model = PagesLang::find()->where(['parent_id' => $idObj])->andWhere(['tag' => $lang])->asArray()->one();
      }
      $title = isset($model['title']) && !empty($model['title']) ? $model['title'] : null; 
      $link = isset($model['link']) && !empty($model['link']) ? $model['link'] : null;
      $type = 'page';
    }
    $result['title'] = $title;
    $result['link'] = $link;
    $result['type'] = $type;
    $result['id'] = $idObj;

    return $result;
  }

  public function findLang($idP)
  {
    $session = Yii::$app->session;
    $lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : null;
    if (!empty($lang)) {
      if ($lang == 'ru') {
        return null;
      } else {
        $result = PagesLang::find()->where(['parent_id' => $idP])->andWhere(['tag' => $lang])->asArray()->one();
        if (!empty($result)) {
          return $result;
        } else {
          return '300';
        }
      }
    } else {
      return null;
    }
  }

  public function getObject($id, $tag)
  {
    $idObj = preg_replace('/[^0-9]/', '', $id);
    if (stristr($id, '_', true) == 'artic') {
      if ($tag == 'ru') {
        $mostes = Articles::find()->where(['id' => $idObj])->asArray()->one();
      } else {
        $mostes = ArticleLang::find()->where(['parent_id' => $idObj])->andWhere(['lang' => $tag])->asArray()->one();
      }
    }
    if (stristr($id, '_', true) == 'item') {
      if ($tag == 'ru') {
        $mostes = Pages::find()->where(['id' => $idObj])->asArray()->one();
      } else {
        $mostes = PagesLang::find()->where(['parent_id' => $idObj])->andWhere(['tag' => $tag])->asArray()->one();
      }
    }
    return $mostes;
  }
}

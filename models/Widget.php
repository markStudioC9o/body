<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "widget".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $img
 * @property string|null $content
 */
class Widget extends \yii\db\ActiveRecord
{

  public static function tableName()
  {
    return 'widget';
  }

  public $image;
  public $imageFiles;

  public function rules()
  {
    return [
      [['content'], 'string'],
      [['title', 'img'], 'string', 'max' => 255],
      ['image', 'file', 'extensions' => 'png, jpg, jpeg, gif, pdf, webp'],
      [['imageFiles'], 'file', 'extensions' => 'png, jpg', 'maxFiles' => 8, 'checkExtensionByMimeType' => false],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function attributeLabels()
  {
    return [
      'image' => 'Изображение',
      'id' => 'ID',
      'title' => 'Заголовок*',
      'img' => 'Картинка',
      'content' => 'Основной текст',
    ];
  }

  public function upload()
  {

    $file = "widget-" . rand(0, 999) . "-" . date('Y-m-d') . "." . $this->image->extension;
    $url = Yii::getAlias('@webroot') . "/widget/" . $file;
    if ($this->image->saveAs($url)) {
      return $file;
    } else {
      return false;
    }
  }

  public function uploads()
  {
    if ($this->validate()) {
      $res = array();
      foreach ($this->imageFiles as $file) {
        $filename = Yii::$app->getSecurity()->generateRandomString(15);
        $name = $filename . '.' . $file->extension;
        $url = Yii::getAlias('@webroot') . "/widget/" . $name;
        $file->saveAs($url);
        $res[] = $name;
      }

      return $res;
    } else {
      return false;
    }
  }

  public function findLang($id)
  {
    $session = Yii::$app->session;
    $lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : null;
    if ($lang == 'ru' || empty($lang)) {
      return null;
    } else {
      $result = WidgetLang::find()->where(['parent_id' => $id])->andWhere(['tag' => $lang])->asArray()->one();
      if (!empty($result)) {
        return $result;
      } else {
        return '300';
      }
    }
  }

  public function getArticles($list){
    
    $result = Articles::find()->where(['id' => $list])->asArray()->all();
    return $result;
  }
}

            
     
    // public function upload()
    // {
    //     if ($this->validate()) { 
    //         foreach ($this->imageFiles as $file) {
    //             $filename=Yii::$app->getSecurity()->generateRandomString(15);
    //             // echo $filename;
    //             $file->saveAs('uploads/' . $filename . '.' . $file->extension);
    //         }
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
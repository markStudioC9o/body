<?php

namespace app\widgets;

use app\models\MainOption;
use app\models\Pages;
use app\models\VideoList;
use Yii;

class OurVideo extends \yii\bootstrap4\Widget
{
  public function run()
  {
    $model = VideoList::find()->asArray()->all();
    $array = $this->ChekVideo($model);
    return $this->render('videoList', [
      'array' => $array
    ]);
  }

  public function ChekVideo($model)
  {
    $array = array();
    foreach ($model as $item) {
      if (!empty($item['key_id']) && $this->CheckVideo($item['key_id'])) {
        $array[] = array(
          'id' => $item['key_id'],
          'val' => $item['id'],
          'img' => $this->CheckVideo($item['key_id'])
        );
      }
    }
    return $array;
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
}

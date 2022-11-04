<?php

namespace app\widgets;

use Yii;

class DirWidget extends \yii\bootstrap4\Widget
{

  public $type = null;
  public function run()
  {
    $path = Yii::getAlias('@webroot') . '/gallery/';
    $pathTwo = Yii::getAlias('@webroot') . '/files/';
    $dirGall = scandir($path);
    
    $arrayFileImg = array();
    $listDir = array();
    foreach($dirGall as $key => $item){
      if($item != '.' && $item != '..' && is_dir($path.$item)){
        $listDir[] = array(
          'name' =>$item,
          'child' => $this->getChild($path, $item)
        );

      }
      if ($item != '.' && $item != '..' && !is_dir($path.$item)  && is_file($path.$item)) {
        $met = stat($path.$item);
        $arrayFileImg[] = array(
          'ino' => $met['ino'],
          'size' => $met['size'],
          'atime' => $met['atime'],
          'mtime' => $met['mtime'],
          'path' => $item
        );
      }
    }
  $array_name = [];
  foreach ($arrayFileImg as $key => $row)
  {
    $array_name[$key] = $row['mtime'];
  }

  array_multisort($array_name, SORT_DESC, $arrayFileImg);
  
    $dirGallTwo = scandir($pathTwo);
    $cat = array();
    $catTwo = array();
    if($this->type == 'renster'){
      return $this->render('directs',[
        'cat' => null,
        'catTwo' => $arrayFileImg,
        'listDir' => $listDir
      ]);
    }else{
      return $this->render('dirwidget', [
        'cat' => null,
        'catTwo' => $arrayFileImg,
        'listDir' => $listDir
      ]);
    }
  }



  public function getChild($path, $item){
    //return $path.$item."/";
    $dir = scandir($path.$item."/");
    $array = array();
    foreach($dir as $key => $elem){
      
      if($elem != '.' && $elem != '..' && is_dir($path.$item."/".$elem)){
        $array[] = array(
          'name' => $elem,
          'child' => $this->getChild($path.$item."/", $elem)
        );
      }
      
    }
    return $array;
  }
}

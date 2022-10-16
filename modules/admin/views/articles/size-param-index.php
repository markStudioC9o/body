<?

use yii\helpers\Html;

?>
<? if (!empty($size)) : ?>
  <ul class="nav nav-pills clabb">
  <? foreach ($size as $item => $val) : ?>
    <?
    
    $html = '';
          if ($defaultModel->getVersion($id, $val, $tag)) {
            $html ='<span class="green-lo">'.$tag.'</span>';
          } else {
            $html ='<span class="red-lo">'.$tag.'</span>';
          }
          if($val == '1680' && $tag == 'ru'){
            $html ='<span class="green-lo">'.$tag.'</span>';
          }
        ?>
    <li class="nav-item">
    <? if($val == $mot){
        $class = "active";
      }else{
        $class = "no-active";
      }?>
      <?= Html::a($val.$html, ['articles-version', 'id' => $id, 'tag' => $tag, 'size' => $val], ["class"=>"nav-link ".$class])?>
    </li>
  <? endforeach; ?>
  <ul class="nav nav-pills">
  <? endif; ?>
  
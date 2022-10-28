<?

use yii\helpers\Html;

?>
<? if (!empty($lang)) : ?>
  <ul class="nav nav-pills clabb">
    <? foreach ($lang as $item) : ?>
      <li class="nav-item">
        <? if ($item->tag == $tag) {
          $class = "active";
        } else {
          $class = "no-active";
        } ?>
        
        <?
        $html = '';
        if ($item->tag != 'ru') {
            $html ='<span class="red"></span>';
          if ($defaultModel->getVersion($id, '1680', $item->tag)) {
            $html ='<span class="green"></span>';
          }
          if ($defaultModel->getVersion($id, '1440', $item->tag)) {
            $html ='<span class="green"></span>';
          } 
          if ($defaultModel->getVersion($id, '1280', $item->tag)) {
            $html ='<span class="green"></span>';
          }
          if ($defaultModel->getVersion($id, '375', $item->tag)) {
            $html ='<span class="green"></span>';
          }
        } ?>
        <?= Html::a($item->name.$html, ['articles-version', 'id' => $id, 'tag' => $item->tag, 'size' => '1680'], ['class' => 'nav-link ' . $class]) ?>
      </li>
    <? endforeach; ?>
  </ul>
<? endif; ?>
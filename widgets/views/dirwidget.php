<?

use yii\widgets\Pjax;
?>
<div class="row">
  <div class="col-md-2">
    <? function ShestArray($array, $name)
    {
      $ns = $name . "/" . $array['name'];
      $rest = '<ul>';
      $rest .= "<li><span class=\"dir-tag\" data-dir=\"" . $ns . "\">" . $array['name'] . "</span></li>";
      if (isset($array['child']) && !empty($array['child'])) {
        $rest .= ShestArray($array['child'], $ns);
      }
      $rest .= '</ul>';
      return $rest;
    } ?>
    <ul class="directList">
      <li class="dir-home"><span>../</span></li>
      <? foreach ($listDir as $item) : ?>
        <li><span class="dir-tag" data-dir="<?= $item['name'] ?>"><?= $item['name'] ?></span>
          <?= ShestArray($item['child'], $item['name']) ?>
        </li>
      <? endforeach; ?>
    </ul>
  </div>
  <div class="col-md-10">
    <div class="pod_ht">
      <?php Pjax::begin([
        'id' => 'pajax-modal-img'
      ]); ?>
      <div class="row">
        <? if (isset($cat) && !empty($cat)) : ?>
          <? foreach ($cat as $key => $val) : ?>
            <div class="col-md-3">
              <div class="img_gal_pop">
                <?= $this->render('remderFile', [
                  'val' => $val
                ]) ?>
              </div>
            </div>
          <? endforeach; ?>
        <? endif; ?>
        <? if (isset($catTwo) && !empty($catTwo)) : ?>
          <? foreach ($catTwo as $val) : ?>
            <?= $this->render('remderFile', [
              'val' => $val
            ]) ?>
          <? endforeach; ?>
        <? endif; ?>
      </div>
      <?php Pjax::end(); ?>
    </div>
    <div class="pod_fd">

    </div>
  </div>

</div>
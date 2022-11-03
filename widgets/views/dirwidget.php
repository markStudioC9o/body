<div class="row">
  <div class="col-md-2">
    <? function ShestArray($array, $name)
    {
      $ns = $name . "/";
      $rest = '<ul>';
      foreach($array as $key => $item){
        $rest .= "<li><span class=\"dir-tag\" data-dir=\"" . $ns .$item['name']."\">" . $item['name'] . "</span></li>";
        if(isset($item['child']) && !empty($item['child'])){
          $rest .= ShestArray($item['child'], $ns.$item['name']);
        }
      }
      
      // if (isset($array['child']) && !empty($array['child'])) {
      //   $rest .= ShestArray($array['child'], $ns);
      // }
      $rest .= '</ul>';
      return $rest;
    } ?>
    <ul class="directList">
      <li class="dir-home"><span>../</span></li>
      <? foreach ($listDir as $item) : ?>
        <li><span class="dir-tag" data-dir="<?= $item['name'] ?>"><?= $item['name'] ?></span>
          <? if(isset($item['child']) && !empty($item['child'])):?>
          <?= ShestArray($item['child'], $item['name']) ?>
          <? endif;?>
        </li>
      <? endforeach; ?>
    </ul>
  </div>
  <div class="col-md-10">
    <div class="pod_ht">
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
    </div>
    <div class="pod_fd">

    </div>
  </div>

</div>
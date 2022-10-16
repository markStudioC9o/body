<?

use yii\helpers\Html;

?>
<div class="row mt-5">
  <? if(isset($data['output']) && !empty($data['output']) ){
    $output = $data['output'];
  }else{
    $output = '';
  }?>
  <?= $this->render('param-margin', ['type' => 'social', 'output' => $output]) ?>
  <div class="col-md-12">
    <label for="">Аудиоверсия</label>
    <ul class="nav nav-pills" id="hadAudio">
      <li class="nav-item">
        <a class="nav-link" data-da="y" href="#"><i class="fa fa-microphone" aria-hidden="true"></i></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-da="n" href="#"><i class="fa fa-microphone-slash" aria-hidden="true"></i></a>
      </li>
    </ul>
    <ul class="cos-list-param">
      <pre>
      <?
      if(isset($data['obj']['0']['vis']) && $data['obj']['0']['vis'] == '2'){
        $vk = true;
      }else{
        $vk = false;
      }
      if(isset($data['obj']['0']['col'])){
        $vk_col = $data['obj']['0']['col'];
      }else{
        $vk_col = 0;
      }


      if(isset($data['obj']['1']['vis']) && $data['obj']['1']['vis'] == '2'){
        $fb = true;
      }else{
        $fb = false;
      }
      if(isset($data['obj']['1']['col'])){
        $fb_col = $data['obj']['1']['col'];
      }else{
        $fb_col = 0;
      }

      if(isset($data['obj']['2']['vis']) && $data['obj']['2']['vis'] == '2'){
        $ok = true;
      }else{
        $ok = false;
      }
      if(isset($data['obj']['2']['col'])){
        $ok_col = $data['obj']['2']['col'];
      }else{
        $ok_col = 0;
      }

      if(isset($data['obj']['3']['vis']) && $data['obj']['3']['vis'] == '2'){
        $mail = true;
      }else{
        $mail = false;
      }

      if(isset($data['obj']['4']['vis']) && $data['obj']['4']['vis'] == '2'){
        $print = true;
      }else{
        $print = false;
      }
      ?>
      </pre>
      
      <li style="background-image: url(/img/share_vk2.svg);">
        <?= Html::checkbox('vk', $vk) ?>
        <?= Html::input('number', 'col-vk', $vk_col, ['min' => '0', 'max' => '99', 'step' => '1']) ?>
      </li>
      <li style="background-image: url(/img/share_fb2.svg);">
        <?= Html::checkbox('fb', $fb) ?>
        <?= Html::input('number', 'col-fb', $fb_col, ['min' => '0', 'max' => '99', 'step' => '1']) ?>
      </li>
      <li style="background-image: url(/img/share_ok2.svg);">
        <?= Html::checkbox('ok', $ok) ?>
        <?= Html::input('number', 'col-ok', $ok_col, ['min' => '0', 'max' => '99', 'step' => '1']) ?>
      </li>
      <li style="background-image: url(/img/share_mail2.svg);">
        <?= Html::checkbox('mail', $mail) ?>
      </li>
      <li style="background-image: url(/img/share_print2.svg);">
        <?= Html::checkbox('print', $print) ?>
      </li>
    </ul>
  </div>
</div>
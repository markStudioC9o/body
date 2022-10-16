<?

use vova07\imperavi\Widget;
use app\widgets\FormBlock;
use yii\bootstrap4\Modal;
?>

<? Modal::begin([
  'id' => 'modal-gal',
  'size' => 'modal-lg'
]) ?>
<div class="abbred-gal" data-img_id="">

</div>
<?
Modal::end();
?>
<? Modal::begin([
  'title' => '<h3>Добавить видео с YouTube на сайт</h3>',
  'id' => 'video',
  'size' => 'modal-lg'
]) ?>
<div class="abbred-video">
  <?= $this->render('form-add-video') ?>
</div>
<?
Modal::end();
?>


<? Modal::begin([
  'title' => '<h4>Добавить ссылку в список</h4>',
  'id' => 'link-ul',
  'size' => 'modal-sm'
]) ?>
<div class="abbred-link-ul">
  <input type="hidden" id="li_id">
  <div class="input-group" style="margin-bottom:10px">
    <input type="text" class="link-url form-control" placeholder="url">
  </div>
  <div class="input-group" style="margin-bottom:10px">
    <input type="text" class="link-title-ul form-control" placeholder="Текс ссылки">
  </div>
  <div class="input-group" style="margin-bottom:10px">
    <label>
      <input type="checkbox" class="blankLinkUl" checked>
      Открывать в новом окне
    </label>
  </div>
  <div class="input-group" style="text-align:center">
    <a href="" class="btn btn-info" id="addInLink">Добавить</a>
  </div>
</div>
<?
Modal::end();
?>

<? Modal::begin([
  'title' => '<h4>Добавить в тектс</h4>',
  'id' => 'link-text',
  'size' => 'modal-sm'
]) ?>
<div class="abbred-link-ul">
  <input type="hidden" id="li_id">
  <div class="input-group" style="margin-bottom:10px">
    <input type="text" class="link-url form-control" placeholder="url">
  </div>
  <div class="input-group" style="margin-bottom:10px">
    <input type="text" class="link-title-ul form-control" placeholder="Текс ссылки">
  </div>
  <div class="input-group" style="text-align:center">
    <a href="" class="btn btn-info" id="addInLink">Добавить</a>
  </div>
</div>
<?
Modal::end();
?>




<? Modal::begin([
  'title' => '<h4>Формы</h4>',
  'id' => 'modal-form',
  'size' => 'modal-lg'
]) ?>
<?= FormBlock::widget(); ?>
<?
Modal::end();
?>

<? Modal::begin([
  'id' => 'carding',
  'size' => 'modal-lg'
]) ?>
<div id="carding-body"></div>
<?
Modal::end();
?>


<div id="block-colum-left">
  <div class="row">
    <div class="col-md-2">
      <div class="kp">
        <i class="fa fa-times" aria-hidden="true"></i>
      </div>
    </div>
    <div class="col-md-2">
      <span id="ford-text-col">
        <i class="fa fa-sign-in" aria-hidden="true"></i>
      </span>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <input type="hidden" id="column">
      <div class="text-rebit texts-cols">
        <?
        echo Widget::widget([
          'id' => 'textarea-col',
          'name' => 'text-col',
          'settings' => [
            'lang' => 'ru',
            //'minHeight' => 200,
            'plugins' => [
              'fontcolor',
              'fontsize',
              'limiter',
              'counter',
            ]
          ],
        ]);
        ?>
      </div>
    </div>
    <div class="col-md-12">
      <label for="">Межстрочный интервал</label>
      <input type="number" class="form-control line-hg" step="1" min="5" max="35" value="25" data-type="line-height">
    </div>
  </div>
</div>



<div id="block-temp-left-d">
  <div class="row">
    <div class="col-md-1">
      <div class="kp">
        <i class="fa fa-times" aria-hidden="true"></i>
      </div>
    </div>
    <div class="col-md-1">
      <span id="ford">
        <i class="fa fa-sign-in" aria-hidden="true"></i>
      </span>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="text-rebit">
        <?
        echo Widget::widget([
          'id' => 'my-textarea',
          'name' => 'text-randId',
          'settings' => [
            'lang' => 'ru',
            //'minHeight' => 200,
            'font-size' => '18px',
            'plugins' => [
              'fontcolor',
              'fontsize',
              'limiter',
              'counter',
            ]
          ],
        ]);
        ?>
      </div>
    </div>
    <div class="col-md-12">
      <label for="">Межстрочный интервал</label>
      <input type="number" class="form-control line-hg" step="1" min="5" max="35" value="25" data-type="line-height">
    </div>
    <div class="col-md-12">
      <?
      if (!isset($id)) {
        $id = '';
      };
      echo $this->render('/articles/param-margin', ['type' => 'text-imger', 'id' => $id]) ?>
    </div>
  </div>
</div>
<?
use Yii;
?>
<div class="row">
  <? if (isset($catTwo) && !empty($catTwo)) : ?>
    <? foreach ($catTwo as $val) : ?>
      <?
      $pathTofile = Yii::getAlias('@app/web/gallery/' . $path . '/' . $val['path']) ?>
      <? if (file_exists($pathTofile)) : ?>
        <?
        $info = new \SplFileInfo($pathTofile);
        $format = $info->getExtension();
        ?>
        <? if ($format == 'mp4') : ?>
          <div class="col-md-3">
            <div class="video-pop" data-src="/gallery/<?= $path ?>/<?= $val['path'] ?>" data-type="mp4">
            <video width="100%" height="300" controls="controls">
              <source src="/gallery/<?= $path ?>/<?= $val['path'] ?>">
            </video>
            <div class="controll btn btn-info" data-src="/gallery/<?= $path ?>/<?= $val['path'] ?>">
              Добавить
            </div>
          </div>
          </div>
        <? else : ?>
          <div class="col-md-3">
            <div class="img_gal_pop">
              <span class="remove-img" data-src="/gallery/<?= $path ?>/<?= $val['path'] ?>" data-confirm="Вы уверены, что хотите удалить этот элемент?"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
              <ul class="date_info">
                <li>
                  <? if (isset($val['mtime'])) echo date("Y/m/d H:i", $val['mtime']); ?>
                </li>
                <li>
                  <? if (isset($val['atime'])) echo date("Y/m/d H:i", $val['atime']); ?>
                </li>
              </ul>

              <img src="/gallery/<?= $path ?>/<?= $val['path'] ?>" alt="" data-img="<?= $path ?>/<?= $val['path'] ?>" class="img-tag-prop">
            </div>
          </div>
        <? endif; ?>
      <? endif; ?>
    <? endforeach; ?>
  <? else : ?>
    <p>Пусто</p>
  <? endif; ?>
</div>
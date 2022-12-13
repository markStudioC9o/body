<? if (is_array($val)) : ?>
  <div class="col-md-3">
    <div class="img_gal_pop">
      <span class="remove-img" data-src="/gallery/<?= $val['path'] ?>" data-confirm="Вы уверены, что хотите удалить этот элемент?"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
      <ul class="date_info">
        <li>
          <? if (isset($val['mtime'])) echo date("Y/m/d H:i", $val['mtime']); ?>
        </li>
        <li>
          <? if (isset($val['atime'])) echo date("Y/m/d H:i", $val['atime']); ?>
        </li>
      </ul>
      <img src="/gallery/<?= $val['path'] ?>" alt="" data-img="<?= $val['path'] ?>" class="img-tag-prop">
    </div>
  </div>
<? else : ?>
  <span class="remove-img" data-src="/gallery/<?= $val ?>" data-confirm="Вы уверены, что хотите удалить этот элемент?"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
  <img src="/gallery/<?= $val ?>" alt="" data-img="<?= $val ?>" class="img-tag-prop">
<? endif; ?>
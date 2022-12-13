<?
$elem = explode(".", $icon);
?>
<div class="row">
  <? foreach ($elem as $key => $item) : ?>
    <div class="col-md-1">
      <div class="icon-revety" data-sub="<?= $item ?>">
        <i class="sui <?= $item ?>"></i>
      </div>
    </div>
  <? endforeach; ?>
</div>
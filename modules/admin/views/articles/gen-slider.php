<? $perems = ""; ?>
<? $i = 0; ?>

<? foreach ($data['array'] as $key => $val) : ?>
  <? if (strripos($val['name'], 'name') !== false) : ?>
    <? $subsing = str_replace("name-", "", $val['name']);
    $ster = $array["desc-".$subsing];
    ?>
    <? $perems .= "<div data-id=\"".$data['id']."\" class=\"".$data['id']." img-werst\" style=\"background-image: url('/gallery/" . $val['value'] . "');\" data-src=" . $val['value'] . "  data-subs=\"".$ster."\"></div>"; ?>
    <? if ($i == 0) {
      $prev = $val['value'];
    } ?>
    <? $i++; ?>
  <? endif; ?>
<? endforeach; ?>
  <div class="prew-img <?= (isset($data['modal']) && $data['modal'] == '1' ? 'open-in-modal': '')?>">
    <div class="left-slig">
    <img src="/icon/left-a.svg" alt="">
    </div>
    <img src="/gallery/<?= $prev; ?>" alt="" data-id="<?= $data['id']?>" data-src="<?= $prev?>">
    <div class="right-slig">
      <img src="/icon/right-a.svg" alt="">
    </div>
  </div>
<div class="flort no-port <?= (isset($data['modal']) && $data['modal'] == '1' ? 'open-in-modal': '')?>" <?= (isset($data['main']) && $data['main'] == '1' ? '': 'style="display:none"') ?>>

  <?= $perems; ?>
  
</div>
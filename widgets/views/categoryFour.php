

<? if (isset($col) && !empty($col) && $col == "3") : ?>
  <div class="block_pos_four_col">
    <div class="row-col">
      <? foreach ($category as $item) : ?>
        <?= $this->render('prevArticlesFourCol', [
          'param' => $item->getOption($item->articles_id),
          'id' => $item->articles_id,
          'color' => $color,
          'lang' => $lang

        ]) ?>
      <? endforeach; ?>
    </div>
  </div>
<? else : ?>
  <div class="hbl_content posts_view_2">
    <? foreach ($category as $item) : ?>
      <?= $this->render('prevArticles', [
        'param' => $item->getOption($item->articles_id),
        'id' => $item->articles_id
      ]) ?>
    <? endforeach; ?>
    <div class="divider"></div>
  </div>
<? endif; ?>
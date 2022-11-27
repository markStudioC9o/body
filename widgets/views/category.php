<?

use yii\helpers\ArrayHelper;
?>
<div class="hbl_title" style="<?= (isset($color) && !empty($color->color) ? "color:" . $color->color : "") ?>">

  <?= (isset($modelName->title) && !empty($modelName->title) ? $modelName->title : '') ?>
  <span class="liner" style="<?= (isset($color) && !empty($color->color) ? "background:" . $color->color : "") ?>"></span>
</div>
<div class="hbl_desc s2cols">
  <p>
  <?= (isset($modelName->text) && !empty($modelName->text) ? $modelName->text : '') ?>
  </p>
</div>

<?
if (isset($col) && !empty($col) && $col == "2") : ?>
  <? if (!empty($option)) {
    $sety = ArrayHelper::map($option, 'option_param', 'value');
    if (
      isset($sety['kb1_name']) &&
      isset($sety['kb1_data']) &&
      !empty($sety['kb1_name']) &&
      !empty($sety['kb1_data'])
    ) {
      $data1 = json_decode($sety['kb1_data'], true);
      $name1 = json_decode($sety['kb1_name'], true);
    }
    $arety1 = array();
    if (!empty($data1)) {
      foreach ($category as $item => $vel) {
        foreach ($data1 as $el => $em) {
          if ($vel->articles_id == $em) {
            $arety1[] = $vel;
            unset($category[$item]);
          }
        }
      }
    }

    if (
      isset($sety['kb2_name']) &&
      isset($sety['kb2_data']) &&
      !empty($sety['kb2_name']) &&
      !empty($sety['kb2_data'])
    ) {
      $data2 = json_decode($sety['kb2_data'], true);
      $name2 = json_decode($sety['kb2_name'], true);
    }
    $arety2 = array();
    if (!empty($data2)) {
      foreach ($category as $item => $vel) {
        foreach ($data2 as $el => $em) {
          if ($vel->articles_id == $em) {
            $arety2[] = $vel;
            unset($category[$item]);
          }
        }
      }
    }
  } ?>
  <? if (isset($arety1) && !empty($arety1)) : ?>
    <div class="slert">
      <? if (isset($name1) && !empty($name1)) : ?>
        <?= $name1; ?>
      <? endif; ?>
    </div>
    <div class="block_pos_two_col">
      <div class="row-col">

        <? foreach ($arety1 as $item) : ?>
          <?= $this->render('prevArticlesTwoCol', [
            'param' => $item->getOption($item->articles_id),
            'id' => $item->articles_id,
            'color' => $color,
            'model' => $model
          ]) ?>
        <? endforeach; ?>
      </div>
    </div>
  <? endif; ?>

  <? if (isset($arety2) && !empty($arety2)) : ?>
    <div class="slert">
      <? if (isset($name2) && !empty($name2)) : ?>
        <?= $name2; ?>
      <? endif; ?>
    </div>
    <div class="block_pos_two_col">
      <div class="row-col">
        <? foreach ($arety2 as $item) : ?>
          <?= $this->render('prevArticlesTwoCol', [
            'param' => $item->getOption($item->articles_id),
            'id' => $item->articles_id,
            'color' => $color,
            'model' => $model
          ]) ?>
        <? endforeach; ?>
      </div>
    </div>
  <? endif; ?>
  <div class="slert">
    Недавно добавленные
  </div>
  <div class="block_pos_two_col">
    <div class="row-col">
      <? foreach ($category as $item) : ?>
        <?= $this->render('prevArticlesTwoCol', [
          'param' => $item->getOption($item->articles_id),
          'id' => $item->articles_id,
          'color' => $color,
          'model' => $model
        ]) ?>
      <? endforeach; ?>
    </div>
  </div>
<? else : ?>
  <div class="hbl_content posts_view_2">


    <? foreach ($category as $item) : ?>
      <?= $this->render('prevArticles', [
        'param' => $item->getOption($item->articles_id),
        'id' => $item->articles_id,
        'color' => $color,
        'lang' => $lang,
        'model' => $model
      ]) ?>
    <? endforeach; ?>
    <div class="divider"></div>
  </div>
<? endif; ?>
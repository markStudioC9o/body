<?

use app\models\WidgetBanner;
?>

<div class="column">
  <? if (!empty($model)) : ?>
    
      <? foreach ($model as $el => $item) : ?>
        <? if (WidgetBanner::find()->where(['parent_id' => $item['id']])->exists()) : ?>
          <div class="slcik-block">
          <? $swiper = WidgetBanner::find()->where(['parent_id' => $item['id']])->asArray()->all() ?>
          <div class="slick_banner">
            <? foreach ($swiper as $elem) : ?>
              <div class="banner_item">
                <img src="/widget/<?= $elem['img'] ?>" alt="">
              </div>
            <? endforeach; ?>
          </div>
          <? unset($model[$el]); ?>
          </div>
        <? endif; ?>
      <? endforeach; ?>
    



    <? $widgetArticles = array(); ?>
    <? foreach ($model as $els => $val) {
      if ($val['img'] == 'widget-articles') {
        $widgetArticles[] = $val;
        unset($model[$els]);
      }
    } ?>
  <? endif; ?>

  <? if (!empty($model)) : ?>
    <div class="card-block">
      <? foreach ($model as $item) : ?>
        <? $baseParam = $widget->findLang($item['id']); ?>
        <? if (!empty($baseParam) && $baseParam != '300') : ?>
          <? $data = json_decode($baseParam['param'], true) ?>
          <div class="card">
            <? if (!empty($data['title'])) : ?>
              <div class="card-header">
                <h5><?= $data['title'] ?></h5>
              </div>
            <? endif; ?>
            <div class="card__wrapper">
              <div class="card-image">
                <img src="/widget/<?= $item['img'] ?>" alt="">
              </div>
              <? if (!empty($data['content'])) : ?>
                <div class="card-descr">
                  <?= $data['content'] ?>
                </div>
              <? endif; ?>
            </div>
          </div>
        <? else : ?>
          <?= $this->render('singel-widget', [
            'item' => $item
          ]) ?>
        <? endif; ?>
      <? endforeach; ?>
    </div>
  <? endif; ?>


  <? if (isset($widgetArticles) && !empty($widgetArticles)) : ?>
    <div class="list-art-block">
      <? foreach ($widgetArticles as $item) : ?>
        <? $baseParam = $widget->findLang($item['id']); ?>
        <? if (!empty($baseParam)) : ?>
          <div class="list-articles-w">
            <?= $this->render('articles-widget', [
              'item' => $item,
              'widget' => $widget,
              'lang' => $lang
            ]) ?>
          </div>
        <? else : ?>
          <div class="list-articles-w">
            <?= $this->render('articles-widget', [
              'item' => $item,
              'widget' => $widget,
              'lang' => $lang
            ]) ?>
          </div>
        <? endif; ?>
      <? endforeach; ?>
    </div>
  <? endif; ?>
</div>
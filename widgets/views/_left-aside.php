<?

use app\models\WidgetBanner;
?>
<pre>
  <? print_r($model)?>
</pre>
<? if (!empty($model)) : ?>
  <div class="column">
    <? foreach ($model as $el => $item) : ?>
      <? if (WidgetBanner::find()->where(['parent_id' => $item['id']])->exists()) : ?>
        <? $swiper = WidgetBanner::find()->where(['parent_id' => $item['id']])->asArray()->all() ?>
        <div class="slick_banner">
          <? foreach ($swiper as $elem) : ?>
            <div class="banner_item">
              <img src="/widget/<?= $elem['img'] ?>" alt="">
            </div>
          <? endforeach; ?>
        </div>
      <? else : ?>


        <? $baseParam = $widget->findLang($item['id']); ?>
        <? if (!empty($baseParam)) : ?>

          <? if ($baseParam != '300') : ?>
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

            <? if ($item['img'] == 'widget-articles') : ?>
              <div class="list-articles-w">
              <?= $this->render('articles-widget', [
                'item' => $item,
                'widget' => $widget
              ]) ?>
              </div>
            <? else : ?>

              <? //= $this->render('singel-widget',[
              //'item' => $item
              //])
              ?>

            <? endif; ?>

          <? endif; ?>
        <? else : ?>
          
          <? if ($item['img'] == 'widget-articles') : ?>
            <div class="list-articles-w">
            <?= $this->render('articles-widget', [
              'item' => $item,
              'widget' => $widget
            ]) ?>
            </div>
          <? else : ?>
            <?= $this->render('singel-widget', [
              'item' => $item
            ]) ?>
          <? endif; ?>

        <? endif; ?>
      <? endif; ?>
    <? endforeach; ?>
  </div>
<? endif; ?>


<? $this->registerJs('
  $(".slick_banner").slick({
    draggable: false,
    dots: false,
    autoplay: true,
    arrows: false,
    autoplaySpeed: 3500,
    slidesToShow: 1,
    slidesToScroll: 1,
    centerMode: false,
    adaptiveHeight: true,
  });
'); ?>
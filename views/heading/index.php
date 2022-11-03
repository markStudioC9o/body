<?

use app\models\BootomBanner;
use app\widgets\ContentWidget;
use app\widgets\LeftAside;
?>
<section class="page_view_one pv2">
  <div id="newhomebb">
    
    <div class="main">
      <div class="container">
        <div class="main__inner">
          <div class="content pt-40">
            <? if (!empty($heading)) : ?>
              <?= ContentWidget::widget(['type' => 'heading','content' => $heading, 'color' => $colorHex]); ?>
              <? if ($lang == 'ru' && isset($widgetArray['bottomBanner']['value']) && !empty($widgetArray['bottomBanner']['value'])) : ?>
            <? $bottomBanner = BootomBanner::findOne(json_decode($widgetArray['bottomBanner']['value'], true)); ?>
            <? if (!empty($bottomBanner)) : ?>
              <a href="<?= (isset($bottomBanner->link) && !empty($bottomBanner->link) ? $bottomBanner->link : '')?>" target="_blank">
              <img src="/botom-banner/<?= $bottomBanner->img ?>" alt="" style="width:100%">
              </a>
            <? endif; ?>
          <? endif; ?>
            <? endif; ?>
          </div>
          <? if (isset($widgetArray['widget']) && !empty($widgetArray['widget'])) {
            $listWidget = $widgetArray['widget'];
            
            echo LeftAside::widget(['listWidget' => $listWidget]);
          } else {
            $listWidget = '';
          }; ?>
            
          
        </div>
      </div>
    </div>
  </div>
</section>
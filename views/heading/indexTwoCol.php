<?

use app\widgets\ContentTwoColWidget;
use app\widgets\LeftAside;
 ?>
 <section class="page_view_one pv2">
<div id="newhomebb">
    <div class="main">
        <div class="container">
            <div class="main__inner">
                <div class="content pt-40">
                  <? if(!empty($pagesOption['type'])):?>
                    <?= ContentTwoColWidget::widget(['heading' => $heding,'type' => 'categ', 'content' => $pagesOption['type'], 'color' =>$colorHex,]);?>
                  <? endif;?>
                </div>
                <? if (isset($param['widget']) && !empty($param['widget'])) {
            $listWidget = $param['widget'];
            echo LeftAside::widget(['listWidget' => $listWidget]);
          } else {
            $listWidget = '';
          }; ?>
        <!-- leftaside -->
            </div>
        </div>
    </div>
</div>
 </section>
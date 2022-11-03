<?

use app\widgets\BulletItem;
use app\widgets\LeftAside;
?>
<?= BulletItem::widget(['viewSlider' => $viewSlider]) ?>
<section>
<div id="newhomebb">
  <div class="main">
    <div class="container">
      <div class="main__inner">
        <div class="content">
          <?= $model->content ?>
        </div>
        <? if (isset($param['widget']) && !empty($param['widget'])) {
          $listWidget['value'] = $param['widget'];
        } else {
          $listWidget = '';
        }; ?>
        <?= LeftAside::widget(['listWidget' => $listWidget]); ?>
        <!-- leftaside -->
      </div>
    </div>
  </div>
</div>
</section>
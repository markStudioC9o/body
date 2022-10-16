<?
use yii\helpers\Html;
?>
<?
function type($id){
  if(stristr($id, '_' , true) == 'heading'){
    return "<sub>Рубрика</sub>";
  };
  if(stristr($id, '_' , true) == 'item'){
    return "<sub>Страница</sub>";
  }
  if(stristr($id, '_' , true) == 'artic'){
    return "<sub>Статья</sub>";
  }
}
?>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 mt-2 mb-2">
      <a href="/admin/menu/shop">Настройка пунктов магазина</a>
    </div>
    <div class="col-md-12 mt-3 mb-3">
      <?php if (Yii::$app->session->hasFlash('success')) : ?>
        <div class="alert alert-success alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <?php echo Yii::$app->session->getFlash('success'); ?>
        </div>
      <?php endif; ?>
    </div>

    <section class="col-lg-12 connectedSortable">
      <div class="row up-menu">

        <div class="col-md-12">
          <h3>Верхнее меню</h3>
        </div>
        <div class="col-md-7 mt-3">
          <ul class="sTree2" id="sTree2">
            <? if (!empty($listMenu) && isset($listMenu['data'])) : ?>
              <? foreach ($listMenu['data'] as $item) : ?>
                <? $element = $menuPages->findIds($item['id']) ?>
                <li id="<?= $item['id'] ?>" data-id="<?= $item['id'] ?>">
                  <div>
                    <?= (isset($element['title']) && !empty($element['title']) ? $element['title'] : (isset($element['text']) && !empty($element['text'])? $element['text'] :"" ) ) ?>
                    <? echo type($item['id']);?>
                    <span class="shlot_trof" data-id="<?= $item['id'] ?>"><i class="fa fa-cog" aria-hidden="true"></i></span>
                  </div>
                  <? if (isset($item['children'])) : ?>
                    <ul class="postogh">
                      <? foreach ($item['children'] as $el) : ?>
                        <? $elm = $menuPages->findIds($el['id']) ?>
                        <li id="<?= $el['id'] ?>" data-id="<?= $el['id'] ?>">
                          <div>
                            <?= (isset($elm['title']) && !empty($elm['title']) ? $elm['title'] : (isset($elm['text']) && !empty($elm['text']) ? $elm['text'] : "")) ?>
                            <? echo type($el['id']);?>
                            <span class="shlot_trof" data-id="<?= $el['id'] ?>"><i class="fa fa-cog" aria-hidden="true"></i></span>
                          </div>
                        </li>
                      <? endforeach; ?>
                    </ul>
                  <? endif; ?>
                </li>
              <? endforeach ?>
            <? endif; ?>
            <?// if (!empty($pages)) : ?>
              <?// foreach ($pages as $item) : ?>
                <!-- <li id="item_<?//= $item['id'] ?>" data-id="<?//= $item['id'] ?>"> -->
                  <!-- <div><?//= $item['title'] ?></div> -->
                <!-- </li> -->
              <?// endforeach; ?>
            <?// endif; ?>
          </ul>
        </div>
        <div class="col-md-5 mt-3">
          <div id="reportCon">
          </div>
        </div>
        <div class="col-md-12">
          <button id="toArrBtn" class="btn btn-info">Сохранить</button>
          <?= Html::a('Добавить пункт меню', '', ['class' => 'asd_pnkt']) ?>
        </div>
        <br>
      </div>






      <div class="row up-menu mt-5">
        <div class="col-md-12">
          <h3>Нижнее меню</h3>
        </div>
        <div class="col-md-7 mt-3">
          <ul class="sTree3" id="sTree3">
            <? if (!empty($listMenuBt) && isset($listMenuBt['data'])) : ?>
              <? foreach ($listMenuBt['data'] as $item) : ?>
                <? $element = $menuPages->findIds($item['id']) ?>
                <li id="bt-<?= $item['id'] ?>">
                  <div>
                  <?= (isset($element['title']) && !empty($element['title']) ? $element['title'] : (isset($element['text']) && !empty($element['text'])? $element['text'] :"" ) ) ?>
                    <span class="shlot_trof_btn" data-id="<?= $item['id'] ?>"><i class="fa fa-cog" aria-hidden="true"></i></span>
                  </div>
                </li>
              <? endforeach ?>
            <? endif; ?>
          </ul>
        </div>
        <div class="col-md-5 mt-3">
        <div id="reportConBtn">

        </div>
        </div>
        <div class="col-md-12">
          <button id="toArrBtnBottom" class="btn btn-info">Сохранить</button>
          <?= Html::a('Добавить пункт меню', '', ['class' => 'asd_pnkt_btn']) ?>
        </div>
      </div>
    </section>
  </div>
</div>

<style>
  .shlot_trof_btn,
  .shlot_trof {
    position: absolute;
    top: 0px;
    right: 0px;
    height: 100%;
    width: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  #sTree3>li,
  #sTree2>li {
    position: relative;
  }
</style>
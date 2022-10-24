<?

use app\widgets\ContentFourColWidget;
use app\widgets\LeftAside;
?>
<section class="page_view_one pv2">
  <div id="newhomebb">
    
    <div class="main">
      <div class="container">
        <? if (isset($heading->img) && !empty($heading->img)) : ?>
          <div class="img_headihgs">
            <div class="img_banner">
              <div class="img_bb" style="background-image:url('/headings/<?= $heading->img ?>')"></div>
            </div>
          </div>
        <? endif; ?>
        <? if(isset($children) && !empty($children)):?>
        <div class="razdel-field">
          <div id="selectRazdel">
            <span value="">Выберите раздел</span>
            <span class="galca">
                <span class="galca1" style="<?= (isset($colorHex->color) && !empty($colorHex->color) ? "background:".$colorHex->color : "")?>"></span>
                <span class="galca2" style="<?= (isset($colorHex->color) && !empty($colorHex->color) ? "background:".$colorHex->color : "")?>"></span>
                </span>
            <ul class="selectVarRazdel">
            <? foreach($children as $child):?>
              <li data-color="<?= (isset($colorHex->color) && !empty($colorHex->color) ? $colorHex->color : "")?>" value=""><?= $child['title']?></li>
            <? endforeach;?>
            </ul>
            </div>
          <a href="" class="clearRazdel" style="<?= (isset($colorHex->color) && !empty($colorHex->color) ? "background:".$colorHex->color : "")?>">Очистить</a>
        </div>
        <? endif;?>
        <div class="main__inner colum-derect">
          

          <div class="content no-aside pt-0 pr-pl-0">

          <div class="sortRazdel">
            <div class="blSort">
              <span style="<?= (isset($colorHex->color) && !empty($colorHex->color) ? "color:".$colorHex->color : "")?>">сортировать: </span>
              <div class="sortRazdelBlock">
                <span class="verSort">
                  Сначала новые
                </span>
                <span class="galca">
                <span class="galca1" style="<?= (isset($colorHex->color) && !empty($colorHex->color) ? "background:".$colorHex->color : "")?>"></span>
                <span class="galca2" style="<?= (isset($colorHex->color) && !empty($colorHex->color) ? "background:".$colorHex->color : "")?>"></span>
                </span>
                <ul class="variableSort">
                  <li data-color="<?= (isset($colorHex->color) && !empty($colorHex->color) ? $colorHex->color : "")?>" data-val="new">Сначала новые</li>
                  <li data-color="<?= (isset($colorHex->color) && !empty($colorHex->color) ? $colorHex->color : "")?>" data-val="old">Более давние</li>
                  <!-- <li data-color="<?= (isset($colorHex->color) && !empty($colorHex->color) ? $colorHex->color : "")?>" data-val="popul">По популярности</li> -->
                </ul>
              </div>
              <select id="sortRazdel" style="display:none">
                <option value="">Сначала новые</option>
                <option value="">Более давние</option>
                <option value="">По популярности</option>
              </select>
            </div>
          </div>
              <?= ContentFourColWidget::widget(['heading'=>$heading, 'type' => 'categ','content' => $pagesOption['type'], 'sort' => $sort, 'color' => (isset($colorHex->color) && !empty($colorHex->color) ? $colorHex->color : "#00A6CA")]); ?>
          </div>
          <!-- leftaside -->
        </div>
      </div>
    </div>
  </div>
</section>
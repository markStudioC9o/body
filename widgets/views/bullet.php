<?

use app\models\SliderLang;
use app\widgets\ColorWidget;

if (!empty($viewSlider)) : ?>
  <section id="home_top_slider">

    <? if (!empty($lang)) : ?>
      <? if ($lang == 'ru') : ?>
        <div class="slides_list">
          <div class="swiper-container">
            <div class="swiper-wrapper">
              <? $s = 1; ?>
              <? foreach ($viewSlider as $slide) : ?>
                <? if (isset($slide['img']) && !empty($slide['img'])) : ?>
                  <div class="swiper-slide" data-slide-item="<?= $s ?>">
                    <div class="img_slide_item" style="background-image: url('/slider/<?= $slide['img'] ?>')" data-link="<?= (isset($slide['link']) && !empty($slide['link']) ? $slide['link'] : "")?>"></div>
                  </div>
                  <? $s++ ?>
                <? endif; ?>
              <? endforeach; ?>
            </div>
          </div>
        </div>
        <div class="bullets">
          <? $i = 1; ?>
          <? foreach ($viewSlider as $slide) : ?>
            <div class="bullet to_slide <?= ($i == 1 ? 'active' : '')?>" data-bullet-item="<?= $i ?>" data-item-id="<?= $slide['id'] ?>" style="border-top:3px solid <?= ColorWidget::widget(['type' => 'dop'])?>;">
              <span class="bullet_title"><?= (isset($slide['bottom']) ? $slide['bottom'] : '') ?></span>
              <span class="bullet_text" style="color:<?= ColorWidget::widget(['type' => 'dop'])?>;"><?= $slide['end_str'] ?></span>
            </div>
            <? $i++; ?>
          <? endforeach; ?>
          <!-- <div class="bullet to_popap"><span class="bullet_btn">Смотреть все</span></div> -->
        </div>
      <? else : ?>
        <div class="slides_list">
          <div class="swiper-container">
            <div class="swiper-wrapper">
              <? $s = 1; ?>
              <? foreach ($viewSlider as $slide) : ?>
                <? if (SliderLang::find()->where(['parent_id' => $slide['id']])->andWhere(['tag' => $lang])->exists()) : ?>
                  <? $sdItem = SliderLang::find()->where(['parent_id' => $slide['id']])->andWhere(['tag' => $lang])->asArray()->one(); ?>
                  <? if (isset($sdItem['img']) && !empty($sdItem['img'])) : ?>
                    <div class="swiper-slide" data-slide-item="<?= $s ?>">
                      <div class="img_slide_item" style="background-image: url('/slider/<?= $sdItem['img'] ?>')" data-link="<?= (isset($sdItem['link']) && !empty($sdItem['link']) ? $sdItem['link'] : "")?>"></div>
                    </div>
                  <? endif; ?>
                <? endif; ?>
                <? $s++ ?>
              <? endforeach; ?>
            </div>
          </div>
        </div>

        <div class="bullets">
          <? $i = 1; ?>
          <? foreach ($viewSlider as $slide) : ?>
            <? if (SliderLang::find()->where(['parent_id' => $slide['id']])->andWhere(['tag' => $lang])->exists()) : ?>
              <? $sdItems = SliderLang::find()->where(['parent_id' => $slide['id']])->andWhere(['tag' => $lang])->asArray()->one(); ?>
              <div class="bullet to_slide <?= ($i == 1 ? 'active': '')?>" data-bullet-item="<?= $i ?>" data-item-id="<?= $sdItems['id'] ?>" style="border-top:3px solid #168cad;">
                <span class="bullet_title"><?= (isset($sdItems['bottom']) ? $sdItems['bottom'] : '') ?></span>
                <span class="bullet_text" style="color:#168cad;"><?= $sdItems['end_str'] ?></span>
              </div>
            <? endif; ?>
            <? $i++; ?>
          <? endforeach; ?>
          <!-- <div class="bullet to_popap"><span class="bullet_btn">Смотреть все</span></div> -->
        </div>






      <? endif; ?>
    <? else : ?>
    <? endif; ?>


    <div class="swiper-pagination">
    </div>
  </section>
<? endif; ?>

<style>
  #home_top_slider .bullets .bullet.to_slide {

    border: 1px solid <?= ColorWidget::widget(['type' => 'main'])?>;
  }
</style>
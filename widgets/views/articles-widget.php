<?

use app\models\Articles;
use app\models\ArticlesOption;
use app\models\ArticlesOptionLang;

$elem = json_decode($item['content'], true);
?>
<div class="widget-ar-title">
  <? if ($elem['type'] == 'video') : ?>
    <svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
      <g clip-path="url(#clip0)">
        <path d="M26.4437 7.0186C26.1325 5.86195 25.2205 4.95023 24.0641 4.63877C21.9512 4.06055 13.4997 4.06055 13.4997 4.06055C13.4997 4.06055 5.04847 4.06055 2.9356 4.61673C1.80141 4.92798 0.86723 5.86216 0.555975 7.0186C0 9.13127 0 13.5127 0 13.5127C0 13.5127 0 17.9162 0.555975 20.0069C0.867436 21.1633 1.77916 22.0752 2.93581 22.3867C5.07072 22.9649 13.4999 22.9649 13.4999 22.9649C13.4999 22.9649 21.9512 22.9649 24.0641 22.4087C25.2207 22.0975 26.1325 21.1856 26.4439 20.0291C26.9999 17.9162 26.9999 13.535 26.9999 13.535C26.9999 13.535 27.0221 9.13127 26.4437 7.0186Z" fill="#39a9f9"></path>
        <path d="M10.8086 17.5605L17.8365 13.5127L10.8086 9.46497V17.5605Z" fill="white"></path>
      </g>
      <defs>
        <clipPath id="clip0">
          <rect width="27" height="27" fill="white"></rect>
        </clipPath>
      </defs>
    </svg>
  <? else : ?>
    <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M12.5 6.15234C12.2305 6.15234 12.0117 6.37112 12.0117 6.64062C12.0117 6.91013 12.2305 7.12891 12.5 7.12891C12.7695 7.12891 12.9883 6.91013 12.9883 6.64062C12.9883 6.37112 12.7695 6.15234 12.5 6.15234Z" fill="#39a9f9"></path>
      <path d="M4.39453 14.9414C4.66404 14.9414 4.88281 14.7226 4.88281 14.4531C4.88281 14.1836 4.66404 13.9648 4.39453 13.9648C4.12502 13.9648 3.90625 14.1836 3.90625 14.4531C3.90625 14.7226 4.12502 14.9414 4.39453 14.9414Z" fill="#39a9f9"></path>
      <path d="M16.4062 1.26953C12.0104 1.26953 8.40244 4.30031 8.1234 8.11787C3.93696 8.32787 0 11.3466 0 15.4297C0 17.136 0.675201 18.7893 1.9043 20.0993C2.14748 21.1018 1.85223 22.1643 1.11961 22.897C0.979996 23.0366 0.938225 23.2466 1.01376 23.4291C1.08929 23.6115 1.26724 23.7305 1.46484 23.7305C2.8574 23.7305 4.19941 23.1844 5.19657 22.2221C6.16798 22.5533 7.43542 22.7539 8.59375 22.7539C12.989 22.7539 16.5966 19.7239 16.8764 15.9071C17.8988 15.8617 18.9621 15.6729 19.8034 15.3862C20.8006 16.3485 22.1426 16.8945 23.5352 16.8945C23.7328 16.8945 23.9107 16.7755 23.9862 16.5932C24.0618 16.4106 24.02 16.2006 23.8804 16.061C23.1478 15.3284 22.8525 14.2658 23.0957 13.2633C24.3248 11.9534 25 10.3001 25 8.59375C25 4.35123 20.7598 1.26953 16.4062 1.26953ZM8.59375 21.7773C7.44133 21.7773 6.12812 21.5511 5.24845 21.2011C5.06001 21.126 4.84467 21.1754 4.70753 21.3251C4.11797 21.9696 3.3514 22.419 2.51617 22.6255C2.97642 21.7438 3.09391 20.7043 2.81391 19.7193C2.79179 19.6417 2.75078 19.5707 2.69451 19.5129C1.58672 18.372 0.976562 16.9218 0.976562 15.4297C0.976562 11.9888 4.46472 9.08203 8.59375 9.08203C12.4928 9.08203 15.918 11.7933 15.918 15.4297C15.918 18.9299 12.6324 21.7773 8.59375 21.7773ZM22.3055 12.677C22.2492 12.735 22.2082 12.8059 22.1861 12.8834C21.9061 13.8683 22.0236 14.9078 22.4838 15.7896C21.6486 15.5832 20.882 15.1337 20.2925 14.4892C20.1553 14.3396 19.94 14.29 19.7515 14.3652C18.9892 14.6685 17.9016 14.8785 16.8749 14.9292C16.7322 13.0827 15.8112 11.3472 14.2365 10.0586H20.6055C20.8752 10.0586 21.0938 9.84001 21.0938 9.57031C21.0938 9.30061 20.8752 9.08203 20.6055 9.08203H12.7363C11.628 8.51784 10.3834 8.18882 9.10244 8.11977C9.38301 4.84028 12.5517 2.24609 16.4062 2.24609C20.5353 2.24609 24.0234 5.15289 24.0234 8.59375C24.0234 10.0859 23.4133 11.536 22.3055 12.677Z" fill="#39a9f9"></path>
      <path d="M12.5 13.9648H6.34766C6.07796 13.9648 5.85938 14.1834 5.85938 14.4531C5.85938 14.7228 6.07796 14.9414 6.34766 14.9414H12.5C12.7697 14.9414 12.9883 14.7228 12.9883 14.4531C12.9883 14.1834 12.7697 13.9648 12.5 13.9648Z" fill="#39a9f9"></path>
      <path d="M12.5 16.8945H4.39453C4.12483 16.8945 3.90625 17.1131 3.90625 17.3828C3.90625 17.6525 4.12483 17.8711 4.39453 17.8711H12.5C12.7697 17.8711 12.9883 17.6525 12.9883 17.3828C12.9883 17.1131 12.7697 16.8945 12.5 16.8945Z" fill="#39a9f9"></path>
      <path d="M20.6055 6.15234H14.4531C14.1834 6.15234 13.9648 6.37093 13.9648 6.64062C13.9648 6.91032 14.1834 7.12891 14.4531 7.12891H20.6055C20.8752 7.12891 21.0938 6.91032 21.0938 6.64062C21.0938 6.37093 20.8752 6.15234 20.6055 6.15234Z" fill="#39a9f9"></path>
    </svg>
  <? endif; ?>
  <? if ($lang == 'ru') : ?>
  <?= $item['title'] ?>
  <? else : ?>
    articles
    <? endif; ?>
</div>
<? if (!empty($elem['new'])) : ?>
  <ul class="slir">
    <? if ($lang == 'ru') : ?>
      <li class="active" data-href="1">Популярные</li>
    <? else : ?>
      <li class="active" data-href="1">Popular</li>
    <? endif; ?>
    <? if ($lang == 'ru') : ?>
      <li data-href="2">Новые</li>
    <? else : ?>
      <li data-href="2">New</li>
    <? endif; ?>
  </ul>
<? endif; ?>
<? if (!empty($elem['pop'])) : ?>
  <?
  $articlesPop = $widget->getArticles($elem['pop']);
  ?>
  <div class="iv-target active" data-href="1">
    <ul class="widget-ar">
      <? foreach ($articlesPop as $item) : ?>
        <? if ($lang == 'ru') : ?>
          <? $title = ArticlesOption::find()->where(['articles_id' => $item['id']])->andWhere(['option_param' => 'title'])->select(['value'])->asArray()->one(); ?>
          <? $img = ArticlesOption::find()->where(['articles_id' => $item['id']])->andWhere(['option_param' => 'img_articles'])
            ->select(['value'])
            ->asArray()->one(); ?>
        <? else : ?>
          <? $title = ArticlesOptionLang::find()->where(['articles_id' => $item['id']])
            ->andWhere(['tag' => $lang])
            ->andWhere(['option_param' => 'title'])
            ->select(['value'])->asArray()->one(); ?>
          <? $img = ArticlesOption::find()->where(['articles_id' => $item['id']])->andWhere(['option_param' => 'img_articles'])
            ->select(['value'])
            ->asArray()->one(); ?>
        <? endif; ?>
        <? if (isset($title['value']) && !empty($title['value'])) : ?>
          <li>
            <? if (!empty($img['value'])) : ?>
              <div class="image-wid-art" style="background-image: url('/articles/<?= $img['value'] ?>')">
              </div>
            <? else : ?>
              <div class="image-wid-art" style="background-image: url('/img/statistik_bg.jpg')">
              </div>
            <? endif; ?>
            <? if (isset($title['value']) && !empty($title['value'])) : ?>
              <div class="div-text">
                <?= $title['value']; ?>
              </div>

            <? endif; ?>
          </li>
        <? endif; ?>
      <? endforeach; ?>
    </ul>
  </div>
<? endif; ?>
<? if (!empty($elem['new'])) : ?>
  <? $articlesNew = $widget->getArticles($elem['new']); ?>
  <div class="iv-target" data-href="2">
    <ul class="widget-ar">
      <? foreach ($articlesNew as $item) : ?>
        <li>
          <? $title = ArticlesOption::find()->where(['articles_id' => $item['id']])->andWhere(['option_param' => 'title'])->select(['value'])->asArray()->one(); ?>
          <? $img = ArticlesOption::find()->where(['articles_id' => $item['id']])->andWhere(['option_param' => 'img_articles'])->select(['value'])->asArray()->one(); ?>
          <? if (!empty($img['value'])) : ?>
            <div class="image-wid-art" style="background-image: url('/articles/<?= $img['value'] ?>')">
            </div>
          <? else : ?>
            <div class="image-wid-art" style="background-image: url('/img/statistik_bg.jpg')">
            </div>
          <? endif; ?>
          <? if (empty($title['value'])) : ?>
            <div class="div-text">
              <?= $title['value']; ?>
            </div>
          <? else : ?>
            <div class="div-text">
              <?= $item['text']; ?>
            </div>
          <? endif; ?>
        </li>
      <? endforeach; ?>
    </ul>
  </div>
<? endif; ?>
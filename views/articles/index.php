<?

use app\models\Articles;
use app\models\ArticlesOption;
use app\models\BootomBanner;
use app\widgets\ContentWidget;
use app\widgets\LeftAside;
use yii\helpers\ArrayHelper;
?>

<section class="page_view_one pv2">
  <div id="newhomebb">
    <? // var_dump($stecSize);
    ?>
    <div class="main">
      <div class="container">
        <div class="main__inner">
          <div class="content">
            <div class="breadcrambs">
              <p>
                <? if ($lang == 'ru') : ?>
                  <a href="/ru">Главная</a>
                <? else : ?>
                  <a href="/<?= $lang ?>">
                    <? if (!empty($breadcrambs['value']) &&  isset($breadcrambs['value'])) : ?>
                      <?= $breadcrambs['value'] ?>
                    <? endif; ?>
                  </a>
                <? endif; ?>

                <? if (isset($param['mainHeading']) && !empty($param['mainHeading'])) : ?>
                  <? $head = $heading->getHeading($param['mainHeading']); ?>
                  <? if (!empty($head['title']) && !empty($head['link'])) : ?>
                    <a href="/<?= $lang ?>/heading/<?= $head['link'] ?>"><?= $head['title']; ?></a>
                  <? endif; ?>
                <? endif; ?>
                <? if (isset($param['breadcram']) && !empty($param['breadcram'])) : ?>
                  <span><?= $param['breadcram'] ?></span>
                <? else : ?>
                  <span><?= $model->text ?></span>
                <? endif; ?>
              </p>
            </div>
            <?
            echo \Yii::$app->shortcodes->parse($model->content);
            ?>




            <? //= $model->content 
            ?>
            <? if (isset($param['articleSiblid']) && !empty($param['articleSiblid'])) : ?>
              <div class="articleSiblid">
                <div class="tph_tt">
                  Еще статьи по теме
                </div>
                <? $sib = json_decode($param['articleSiblid'], true); ?>
                <? $siblid = Articles::find()->where(['id' => $sib])->asArray()->all(); ?>
                <div class="wrap-recof">
                  <? foreach ($siblid as $item) : ?>
                    <? $arOption = ArticlesOption::find()->where(['articles_id' => $item['id']])->asArray()->all(); ?>
                    <? $arraty = ArrayHelper::map($arOption, 'option_param', 'value') ?>
                    <div class="ferty-shert">
                      <div class="img-shert">
                        <? if (!empty($arraty['img_articles'])) : ?>
                          <img src="/articles/<?= $arraty['img_articles'] ?>" alt="">
                        <? else : ?>
                          <img src="/img/statistik_bg.jpg" alt="">
                        <? endif; ?>
                      </div>
                      <div class="text-shert">
                        <? if (!empty($arraty['title'])) : ?>
                          <p><?= mb_strimwidth($arraty['title'], 0, 60, "..."); ?></p>
                        <? else : ?>
                          <p><?= mb_strimwidth($arraty['text'], 0, 60, "..."); ?></p>
                        <? endif; ?>
                      </div>
                    </div>
                  <? endforeach; ?>
                </div>
              </div>
            <? endif; ?>
            <? if (isset($param['botomBanner']) && !empty($param['botomBanner'])) : ?>
              <? $bottomBanner = BootomBanner::findOne($param['botomBanner']); ?>
              <? if (!empty($bottomBanner)) : ?>
                <a href="<?= (isset($bottomBanner->link) && !empty($bottomBanner->link) ? $bottomBanner->link : '') ?>" target="_blank">
                  <img src="/botom-banner/<?= $bottomBanner->img ?>" alt="" style="width:100%">
                </a>
              <? endif; ?>
            <? else : ?>
              <?$heads = $model->getMHeading()?>
              <? if (isset($heads)) : ?>
                <? $banners = $heads->getBootomBanner() ?>
                <? if (isset($banners) && !empty($banners)) : ?>
                  <? $bottomBanner = BootomBanner::findOne(json_decode($banners['value'], true)); ?>
                  <? if (!empty($bottomBanner)) : ?>
                    <a href="<?= (isset($bottomBanner->link) && !empty($bottomBanner->link) ? $bottomBanner->link : '') ?>" target="_blank">
                      <img src="/botom-banner/<?= $bottomBanner->img ?>" alt="" style="width:100%">
                    </a>
                  <? endif; ?>
                <? endif; ?>
              <? endif; ?>
            <? endif; ?>
          </div>

          <? if (isset($param['widget_articles']) && !empty($param['widget_articles'])) {

            $listWidget['value'] = $param['widget_articles'];
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
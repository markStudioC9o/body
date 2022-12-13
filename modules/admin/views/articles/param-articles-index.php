<?

use app\models\Articles;
use app\models\BootomBanner;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

?>
<div class="row">
  <div class="col-md-12">
    <div class="row">
      <div class="col-md-6 mt-3">
        <label for="">Заголовок</label>
        <input value="<?= (isset($model->text) && !empty($model->text) ? htmlspecialchars($model->text) : '') ?>" type="text" class="form-control" id="titleArticles">

      </div>
      <div class="col-md-6 mt-3">
        <label for="">Ссылка</label>
        <input value="<?= (isset($articlesOption['link']) && !empty($articlesOption['link']) ? $articlesOption['link'] : '') ?>" name="link" type="text" class="form-control" id="linkArticles">
      </div>
      <div class="col-md-12 mt-3">
        <label for="">Заголовок таксономия</label>
        <input value="<?= (isset($articlesOption['breadcram']) && !empty($articlesOption['breadcram']) ? $articlesOption['breadcram'] : '') ?>" name="breadcram" type="text" class="form-control" id="breadcramArticles">
      </div>
      <div class="col-md-6 mt-3">
        <label for="">Рубрика</label>
        <? if (isset($articlesOption['heading']) && !empty($articlesOption['heading'])) {
          $val = json_decode($articlesOption['heading'], true);
        } else {
          $val = '';
        } ?>
        <?
        echo Select2::widget([
          'name' => 'state_10',
          'data' => ArrayHelper::map($heading, 'id', 'title'),
          'value' => $val,
          'options' => [
            'placeholder' => 'Рубрика',
            'multiple' => true,
            'class' => 'form-control selecter23 headingSelect'
          ],
        ]);
        ?>
      </div>
      <div class="col-md-6 mt-3">
        <div class="head-select-list">
          <? if (isset($articlesOption['heading']) && !empty($articlesOption['heading'])) {
            $val = json_decode($articlesOption['heading'], true);
            if (isset($articlesOption['mainHeading']) && !empty($articlesOption['mainHeading'])) {
              $selected = $articlesOption['mainHeading'];
            } else {
              $selected = '';
            }
            $array = array();
            $arraTwo = ArrayHelper::map($heading, 'id', 'title');
            if (is_array($val)) {
              foreach ($val as $key => $item) {
                $array[$item] = $arraTwo[$item];
              }
              echo "<label>Главная рубрика</label>";
              echo Html::dropDownList('select-headin', $selected, $array, ['class' => 'form-control select-main-heading']);
            } else {
              $array[$val] = $arraTwo[$val];
              echo "<label>Главная рубрика</label>";
              echo Html::dropDownList('select-headin', $selected, $array, ['class' => 'form-control select-main-heading']);
            }
          }
          ?>
        </div>
      </div>
      <div class="col-md-12 mt-3 mb-3">
        <label for="">Текст превью</label>
        <textarea id="textPrevArticles" cols="20" rows=3" class="form-control"><?= (isset($articlesOption['text']) && !empty($articlesOption['text']) ? $articlesOption['text'] : '') ?></textarea>
      </div>
      <div class="col-md-12">
        <label for="">Нижний баннер</label>
        <?
        if (isset($articlesOption['botomBanner']) && !empty($articlesOption['botomBanner'])) {
          $selectedVal = $articlesOption['botomBanner'];
        } else {
          $selectedVal = '';
        }
        ?>
        
        <? $datas = array(
          'nans' => 'без баннера',
          'Список баннеров' => ArrayHelper::map(BootomBanner::find()->asArray()->all(), 'id', 'name')
          )?>
        <?= Html::dropDownList('bottom-banner', $selectedVal, $datas, ['class' => 'form-control', 'prompt' => 'Выберите баннер']) ?>
      </div>
      <div class="col-md-12 mt-3">
        <label for="">Статьи по теме</label>
        <?

        if (isset($articlesOption['articleSiblid']) && !empty($articlesOption['articleSiblid'])) {
          $artiSbl = json_decode($articlesOption['articleSiblid'], true);
        } else {
          $artiSbl = '';
        }

        echo Select2::widget([
          'name' => 'article_siblid',
          'data' => ArrayHelper::map(Articles::find()->asArray()->all(), 'id', 'text'),
          'value' => $artiSbl,
          'options' => [
            'placeholder' => 'Статьи',
            'multiple' => true,
            'class' => 'form-control article_siblid'
          ],
        ]);
        ?>
      </div>
      <div class="col-md-12 mt-3">
        <label for="">
          <input type="checkbox" value="1" name="videoArticles" <?= (isset($articlesOption['videoArticles']) && $articlesOption['videoArticles'] && $articlesOption['videoArticles'] == '2' ? "checked" : "") ?>>
          Видео статья
        </label>
      </div>
      <div class="col-md-12 mt-3">
        <label for="">
          <input type="checkbox" value="1" name="noindexArticles" <?= (isset($articlesOption['noindexArticles']) && $articlesOption['noindexArticles'] && $articlesOption['noindexArticles'] == '2' ? "checked" : "") ?>>
          Скрыть от индексирования
        </label>
      </div>
      <div class="col-md-12 mt-3">
        <label for="">Seo Keywords</label>
        <textarea name="SeoKeywords" id="" cols="3" rows="3" class="form-control"><?= (isset($articlesOption['keywords']) && !empty($articlesOption['keywords']) ? $articlesOption['keywords'] : '' )?></textarea>
      </div>
      <div class="col-md-12 mt-3">
        <label for="">Seo Description</label>
        <textarea name="SeoDescription" id="" cols="3" rows="3" class="form-control"><?= (isset($articlesOption['description']) && !empty($articlesOption['description']) ? $articlesOption['description'] : '' )?></textarea>
      </div>
      <div class="col-md-12 mt-3">
        <?= Html::a('Настройка снипета статьи',['/admin/shipet', 'id' => $model->id, 'tag' => $tag])?>
      </div>
    </div>
  </div>

</div>
<?

use app\models\ArticlesOption;
use yii\helpers\Html;
?>
<div class="row">
  <div class="col-md-10">
    <? if (!empty($model)) : ?>
      <ul id="listArticlesD">
        <? foreach ($model as $item) : ?>
          <? $mainHeading = $item->getMainHeading(); ?>
          <li class="<?= (isset($mainArt) && !empty($mainArt) && $mainArt == $item->id ? 'active' : '')?>">
            <? if (!empty($item->text)) : ?>
              <?= Html::a($item->text, ['/admin/articles/update', 'id' => $item->id]) ?>
              <? if (!empty($mainHeading)) {
                echo "<span class='rubjk'>Главная рубрика: <span>" . $mainHeading['title'] . "</span></span>";
              } ?>
            <? else : ?>
              <? if (ArticlesOption::find()->where(['articles_id' => $item->id])->andWhere(['option_param' => 'title'])->exists()) {
                $title = ArticlesOption::find()->where(['articles_id' => $item->id])->andWhere(['option_param' => 'title'])->one();
                if (!empty($title->value)) {
                  echo Html::a($title->value, ['/admin/articles/update', 'id' => $item->id]);
                  if (!empty($mainHeading)) {
                    echo "<span class='rubjk'>Главная рубрика: <span>" . $mainHeading['title'] . "</span></span>";
                  }
                } else {
                  echo Html::a($item->id, ['/admin/articles/update', 'id' => $item->id]);
                  if (!empty($mainHeading)) {
                    echo "<span class='rubjk'>Главная рубрика: <span>" . $mainHeading['title'] . "</span></span>";
                  }
                }
              } else {
                if (!empty($item->date)) {
                  echo Html::a($item->date, ['/admin/articles/update', 'id' => $item->id]);
                  if (!empty($mainHeading)) {
                    echo "<span class='rubjk'>Главная рубрика: <span>" . $mainHeading['title'] . "</span></span>";
                  }
                } else {
                  echo Html::a($item->id, ['/admin/articles/update', 'id' => $item->id]);
                  if (!empty($mainHeading)) {
                    echo "<span class='rubjk'>Главная рубрика: <span>" . $mainHeading['title'] . "</span></span>";
                  }
                }
              } ?>
            <? endif; ?>
            <div class="right_set_block">
              <? $heading = $item->getHeading() ?>
              <? if (!empty($heading)) : ?>
                <ul class="headingList">
                  <? foreach ($heading as $elem) : ?>
                    <li>
                      <span style="font-size:12px"><?= $elem['title'] ?></span>
                    </li>
                  <? endforeach; ?>
                </ul>
                <!-- //echo ""; -->
              <? endif; ?>

              <span class="delet-arctic" data-id="<?= $item['id'] ?>" confirm="Удалить?"><i class="fa fa-trash" aria-hidden="true"></i></span>
            </div>
          </li>
        <? endforeach; ?>
      </ul>
    <? endif; ?>
  </div>
</div>
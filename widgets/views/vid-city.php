<?

use app\models\Cities;
use app\models\CitiesLang;
use app\models\Countries;
use yii\helpers\ArrayHelper;

?>
<!-- bb-arw-select_open -->
<div class="bb-arw-select bb-arw-card__field">
  <span class="bb-arw-select__value" data-placeholder="<?= $param['name'] ?><?= ($param['reqared'] == '1') ? "*" : "" ?>"></span>
  <span class="bb-astr"></span>
  <input type="hidden" name="choise-city" class="<?= ($param['reqared'] == '1') ? "sholm" : "" ?>">
  <svg class="bb-arw-select__arrow" viewBox="0 0 7 5">
    <path d="M3.5 5L0.468911 0.5L6.53109 0.5L3.5 5Z"></path>
  </svg>
  <?
  $session = Yii::$app->session;
  $city = isset($_SESSION['city']) ? $_SESSION['city'] : null;
  $lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'en';
  $countru = Countries::find()->where(['tag' => $lang])->one();
  if (!empty($countru)) {

    $city = Cities::find()->where(['counries_id' => $countru->id])->all();

    $idCity = ArrayHelper::getColumn($city, 'id');
    $cityLang = CitiesLang::find()->where(['tag' => $lang])->all();
  }else{
    $city = null;
    $cityLang = CitiesLang::find()->where(['tag' => $lang])->all();
  }

  ?>

  <ul class="bb-arw-select__list">
  <? if(isset($city) && !empty($city)):?>
    <? foreach ($city as $elems) : ?>
      <li class="bb-arw-select__item" data-val="<?= $elems->name ?>">
        <span class="bb-arw-select__item-label">
          <?= $elems->name ?>
        </span>
        <img class="bb-arw-select__item-flag" src="/lang/<?= $elems->flag->icon ?>" alt="">
      </li>
    <? endforeach; ?>
    <? endif;?>
    <? if(isset($cityLang) && !empty($cityLang)):?>
    <? foreach ($cityLang as $elems) : ?>
      <li class="bb-arw-select__item" data-val="<?= $elems->name ?>">
        <span class="bb-arw-select__item-label">
          <?= $elems->name ?>
        </span>
        <img class="bb-arw-select__item-flag" src="/lang/<?= $elems->flag->icon ?>" alt="">
      </li>
    <? endforeach; ?>
    <? endif;?>
  </ul>

</div>
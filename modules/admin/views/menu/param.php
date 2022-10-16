<?

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use kartik\color\ColorInput;
?>
<div class="row">
  <div class="col-md-12 mt-5">
    <div class="row">
      <div class="col-md-12">
        <?
        $form = ActiveForm::begin([
          'id' => 'form-id',
        ])
        ?>
        <div class="col-md-12">
          <input type="file" name="myFiles" id="myFiles">
          <input type="hidden" value="<?= $id ?>" name="thisId">
        </div>
        <div class="col-md-12 mt-3 mb-3">
          <?
          echo '<label class="control-label">Цвет пункта</label>';
          echo ColorInput::widget([
              'name' => 'colorMenu',
              'id'=>'colorMenu',
              'value' => (!empty($model['color']) ? $model['color'] : '#759523'),
              'options' => ['readonly' => true]
          ]);
          ?>
        </div>
        <? if (isset($lang) && !empty($lang)) : ?>
          <div id="accordion_menuFF">
            <? foreach ($lang as $item) : ?>
              <? $promp = $menuParam->Proms($id, $item['tag'])?>
              <h3><?= $item['tag'] ?></h3>
              <div>
                <div class="col-md-12 mt-3">
                  <label for="">
                    <? if(!empty($array)){
                      if(isset($array[$item['tag']]) && $array[$item['tag']] == '1'){
                        $chek = true;
                      }else{
                        $chek = false;
                      }
                    }?>
                    <input type="checkbox" name="titleMenu[<?= $item['tag']?>][active]" id="por-<?= $item['tag']?>" class="form" value="1"  <?= (isset($chek) && $chek == '1' ? "checked" : "")?>>
                    Отключить для версии "<?= $item['name']?>"
                  </label>
                </div>
                <div class="col-md-12 mt-3">
                  <label>Заголовок в меню</label>
                  <input type="text" value="<?= (isset($promp['value']) && !empty($promp['value']) ? $promp['value'] : '')?>" name="titleMenu[<?= $item['tag']?>][name]" class="form-control">
                </div>
                <div class="col-md-12 mt-3">
                  <label>Произвольная ссылка</label>
                  <input type="text" value="<?= (isset($promp['ex_link']) && !empty($promp['ex_link']) ? $promp['ex_link'] : '')?>" name="titleMenu[<?= $item['tag']?>][ex_link]" class="form-control">
                </div>
                <div class="col-md-12 mt-3">
                  <? $obj = $pages->getObject($id, $item['tag']) ?>
                  <? $defProm = (isset($obj['title']) && !empty($obj['title']) ? $obj['title'] : (isset($obj['text']) && !empty($obj['text']) ? $obj['text'] : ""))?>
                  <? if (!empty($obj)) : ?>
                    <label><strong>Оригинал :</strong></label>
                    <span>
                      <em><?=  $defProm?></em>
                    </span>
                  <? endif; ?>
                </div>
              </div>
            <? endforeach; ?>
          </div>
        <? endif; ?>
        <div class="col-md-12 mt-3">
          <?= Html::submitButton('Сохранить', ['class' => 'btn btn-info', 'id' => 'save_icon']); ?>
          <?= Html::a('Удалить', ['/admin/menu/delete', 'id' => $id], ['class' => 'btn btn-info']); ?>
        </div>
        <? ActiveForm::end(); ?>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
      <? if (!empty($model['link'])) : ?>
        <div class="wid-img">
            <img src="/icon/<?= $model['link'] ?>">
        </div>
        <i class="fa fa-times removeImgmenu" aria-hidden="true" data-id="<?= $model['id']?>"></i>
        <? endif; ?>
      </div>
    </div>
  </div>
</div>
<?= $this->registerJs('
 $( function(){
$("#accordion_menuFF").accordion({
  heightStyle: "content"
});
});');
?>
<?

use kartik\color\ColorInput;
use kartik\editors\Summernote;
use yii\bootstrap4\Html;
?>
<div class="row">
  <div class="col-md-12 mb-4">
    <? echo ColorInput::widget([
      'name' => 'colorMenu',
      'id' => 'colorMenu',
      'attribute' => 'color_1',
      'value' => (isset($data['data']['color']) && !empty($data['data']['color']) ? $data['data']['color'] : '#759523'),
      'options' => ['placeholder' => 'Choose your color ...']


    ]);
    ?>
  </div>
  <div class="col-md-8">
    <input type="text" class="form-control title-qut" placeholder="Заголовок" value="<?= (isset($data['data']['title']) && !empty($data['data']['title']) ? $data['data']['title'] : '') ?>">
  </div>
  <div class="col-md-4">
    <? //= Html::submitButton('Картинка', ['class' => 'btn btn-success img-quote'])
    ?>

    <?= Html::submitButton('Иконка', ['class' => 'btn btn-success icon-quote']) ?>
  </div>
  <div class="col-md-4 mt-1">
    <input type="text" readonly id="link-img" class="form-control">
  </div>
  <div class="col-md-4 mt-1">
    <input type="text" readonly id="link-icon" class="form-control" value="<?= (isset($data['data']['icon']) && !empty($data['data']['icon']) ? $data['data']['icon'] : '') ?>">
  </div>
  <div class="col-md-6"></div>
  <div class="col-md-6">
    <sub>Изображение должно быть пропорциональным</sub>
  </div>
  <div class="col-md-12 mt-4">
    <?
    //echo Summernote::widget([
    // 'name' => 'comments',
    // 'id' => 'quote-bodsy',
    // 'value' => (isset($data['data']['text']) && !empty($data['data']['text']) ? $data['data']['text'] : ''),
    // other widget settings
    //]);
    ?>
    <div id="quote-bodsy">
      <div class="content-text-redactor">
        <div contenteditable="true" class="contrel-text block-lest-atog7783430" id="dataRed-atog7783430" data-reb="atog7783430" style="<?= $data['cssStyle']?>">
          <? if (isset($data['data']['text']) && !empty($data['data']['text'])) : ?>
            <?= $data['data']['text'] ?>
          <? else : ?>
            <div>
              Вставьте текст...
            </div>
          <? endif; ?>
        </div>
      </div>
    
    <ul class="tool-sf" id="tool-sf-atog7783430" role="toolbar">
      <li><a href="#" class="re-icon lac re-bold" rel="bold" role="button" aria-label="Полужирный" data-reb="atog7783430"></a></li>
      <li><a href="#" class="re-icon lac re-italic" rel="italic" role="button" aria-label="Наклонный" data-reb="atog7783430"></a></li>
      <li><a href="#" class="re-icon lac re-deleted" rel="deleted" role="button" aria-label="Зачеркнутый" data-reb="atog7783430"></a></li>
      <li><a href="#" class="re-icon lac re-underline" rel="underline" role="button" aria-label="Подчеркнутый" data-reb="atog7783430"></a></li>
      <li><a href="#" class="re-icon lac re-link" rel="link" role="button" aria-label="ссылка" data-reb="atog7783430"></a></li>
      <li><a href="#" class="re-icon lac fa fa-unlink" rel="unlink" role="button" aria-label="ссылка" data-reb="atog7783430"></a></li>
      <li class="input-srif"><span>Цвет</span><input class="toolbar-color" type="color" value="#ff0000"></li>
      <li style="position: relative;"><a href="#" class="re-icon lac re-alignment" rel="alignment" role="button" aria-label="Выравнивание" tabindex="-1" aria-haspopup="true" data-reb="atog7783430"></a>
        <div class="redactor-dropdown custom-redactor edactor-dropdown-box-alignment" style="display:none">
          <a href="#" class="" role="button" data-type="left" data-reb="atog7783430">По левому краю</a>
          <a href="#" class="" role="button" data-type="center" data-reb="atog7783430">По центру</a>
          <a href="#" class="" role="button" data-type="right" data-reb="atog7783430">По правому краю</a>
          <a href="#" class="" role="button" data-type="justify" data-reb="atog7783430">Выровнять текст по ширине</a>
        </div>
      </li>
      <!-- //toolbar-unlink fas fa-unlink -->
      <!-- <li class="input-srif">
  <input type="text" class="form-link" data-reb="">
  </li> -->
      <li class="input-srif">
        <!-- <span>Fs</span> <input type="number" value="18" step="1" min="0" max="99" class="form-tip" data-reb=""> -->
        <select class="toolbar-size form-tip" data-reb="atog7783430">
          <option selected="selected" disabled="disabled">Размер</option>
          <option value="10">10px</option>
          <option value="12">12px</option>
          <option value="14">14px</option>
          <option value="16">16px</option>
          <option value="18">18px</option>
          <option value="20">20px</option>
          <option value="22">22px</option>
          <option value="24">24px</option>
          <option value="26">26px</option>
          <option value="26">26px</option>
          <option value="30">30px</option>
          <option value="45">45px</option>
        </select>
      </li>


      <li class="input-srif">
        <span>Lh</span> <input type="number" value="18" step="1" min="0" max="99" class="lh-tip" data-reb="atog7783430">
      </li>
      <li class="input-srif">
        <select id="wight-param" data-reb="atog7783430">
          <option value="300">300</option>
          <option value="400">400</option>
          <option value="500">500</option>
          <option value="600">600</option>
          <option value="700">700</option>
          <option value="800">800</option>
        </select>
      </li>
      <!-- <li class="input-srif">
    <span>Цвет</span>
    <input class="toolbar-color" type="color" value="#ff0000">
  </li> -->
      <!-- <li class="input-srif">
    <span>Фон</span> <input class="toolbar-bg" type="color" value="#ffff00">
  </li> -->
      <li class="input-srif">
        <input type="number" value="10" step="1" min="0" max="99" class="lh-gap" data-reb="atog7783430">
      </li>
    </ul>
    </div>
  </div>
</div>
</div>
<div class="col-md-12 mt-4">
  <?= Html::submitButton('Получить', ['class' => 'btn btn-success asd-fert']) ?>
</div>
</div>
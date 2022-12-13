<?

use kartik\color\ColorInput;

function rgbToHex($red, $green, $blue, $alpha = null)
{
  $result = '#';
  foreach (array($red, $green, $blue) as $row) {
    $result .= str_pad(dechex($row), 2, '0', STR_PAD_LEFT);
  }
  if (!is_null($alpha)) {
    $alpha = floor(255 - (255 * ($alpha / 127)));
    $result .= str_pad(dechex($alpha), 2, '0', STR_PAD_LEFT);
  }
  return $result;
}

if (isset($data['output']['background-color']) && !empty($data['output']['background-color'])) {
  preg_match('#\((.*?)\)#', $data['output']['background-color'], $match);
  if (isset($match) && isset($match[1]) && !empty($match[1])) {
    $color = $match[1];
    $colArray = explode(",", $color);
    if (isset($colArray[3]) && !empty($colArray[3])) {
      $alpha = $colArray[3];
    } else {
      $alpha = null;
    }

    $BackgroundColor = rgbToHex($colArray[0], $colArray[1], $colArray[2], $alpha);
  } else {
    $BackgroundColor = '#00a6ca';
  }
} else {
  $BackgroundColor = '#00a6ca';
}
?>



<?
$varSize = 0;
if (isset($data['addPadding']) && !empty($data['addPadding'])) {
  foreach ($data['addPadding'] as $item => $val) {
    if ((int) preg_replace('~[^0-9]+~', '', $val) != 0) {
      $varSize = (int) preg_replace('~[^0-9]+~', '', $val);
    }
  }
}
if (isset($data['imgMargin']) && !empty($data['imgMargin'])) {
  foreach ($data['imgMargin'] as $item => $val) {
    if ((int) preg_replace('~[^0-9]+~', '', $val) != 0) {
      $varSize = (int) preg_replace('~[^0-9]+~', '', $val);
    }
  }
}
?>
<div class="row">
  <input type="hidden" value="<?= 'rower-' . $tag ?>" id="idBlock">
  <div class="col-md-12 mt-2 mb-2">
    <span class="btn btn-info rever-img" data-id="<?= $tag ?>">Изменить картинку</span>
  </div>
  <div class="col-md-6 mt-2">
    <? if (isset($data['output']) && !empty($data['output'])) {
      $output = $data['output'];
    } else {
      $output = '';
    } ?>
    <?= $this->render('/articles/param-margin', ['type' => 'col-img-margin', 'id' => 'rower-' . $tag, 'output' => $output]) ?>

  </div>
  <?= $this->render('/articles/param-padding', ['type' => 'col-text-padding', 'id' => 'rower-' . $tag, 'output' => $output]) ?>
  <div class="col-md-12 mt-2">
    <label> Отступ от картинки</label>
    <?= $varSize ?>

    <input type="number" class="form-control changa-step" min="1" step="1" max="99" value="<?= $varSize; ?>" data-id="<?= $tag ?>">
  </div>
  <div class="col-md-12 mt-2">
    <label> Радиус</label>
    <input type="number" class="form-control radius-step" min="0" step="1" max="99" value="<? if (isset($data['output']['border-radius']) && !empty($data['output']['border-radius'])) {
                                                                                              echo preg_replace('~[^0-9]+~', '', $data['output']['border-radius']);
                                                                                            } else {
                                                                                              echo 0;
                                                                                            } ?>" data-id="<?= 'rower-' . $tag ?>">
  </div>
  <div class="col-md-12 mt-3 mb-2">
    <input type="text" class="img-link-tag form-control" data-tag="<?= $tag ?>" placeholder="Ссылка для изображение" value="<?= (isset($data['link']) ? $data['link'] : '') ?>">
  </div>
  <div class="col-md-12">
    <label for=""><input type="checkbox" class="blank_tar" value="blank" data-tag="<?= $tag ?>" <?= (isset($data['sert']) && !empty($data['sert']) ? $data['sert'] : '') ?>> Открывать в новом окне</label>
  </div>
  <div class="col-md-12">
    <label for=""><input type="checkbox" class="modal_open" value="blank" data-tag="<?= $tag ?>" <?= (isset($data['sert']) && !empty($data['modal']) ? $data['modal'] : '') ?>> Открывать изображение в модальном окне</label>
  </div>
  <div class="col-md-12 mb-3">
    <?
    echo '<label class="control-label">Цвет пункта</label>';
    echo ColorInput::widget([
      'name' => 'colorImageBg',
      'id' => 'colorImageBg',
      'value' => $BackgroundColor,
      'options' => ['readonly' => true]
    ]);
    ?>
  </div>
  <div class="col-md-6 mt-3">
    <label for="">
      Размер в %
    </label>
    <? if (isset($data['size']) && !empty($data['size'])) {
      $width = preg_replace('~[^0-9]+~', '', $data['size']);
    } else {
      $width = '40';
    } ?>
    <input type="number" class="imgSize form-control" value="<?= $width ?>" data-tag="<?= $tag ?>" min="1" max="100" step="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
  </div>
  <div class="col-md-6 mt-3">
    <label for="">
      Стиль
    </label>

    <? $array_param = [
      "img-left"=>"Изображение слева",
      "img-center"=>"Изображение по центру",
      "img-right"=>"Изображение справа",
      "tex-left"=>"Текст справа",
      "tex-right"=>"Текст слева",
      "tex-bot"=>"Текст с обтеканием справа",
      "tex-up"=>"Текст с обтеканием слева"
    ]?>
    <select class="form-control" id="par-im-st" class="st-im" data-tag="<?= $tag ?>">
      <option value="">---</option>
      <? foreach($array_param as $key => $value):?>
        <option value="<?= $key?>" <?= (isset($data['method']) && !empty($data['method']) && $data['method'] == $key ? 'selected': '')?>><?= $value?></option>
        <? endforeach;?>
    </select>
  </div>
  
  <div class="col-md-12 mt-2 param-tob-bottom" style="<?= ($data['method'] == 'tex-right' || $data['method'] == "tex-left"? 'display: block': 'display: none')?>">
    <div class="row">
      <div class="col-md-6">
        <label>top изображения</label>
        <input type="number" min="0" step="1" value="<?= (isset($data['marginTopImg']) && !empty($data['marginTopImg']) ? (int)preg_replace('~[^0-9]+~', '', $data['marginTopImg']): 0 )?>" data-tag="<?= $tag ?>" class="form-control tab-img-video">
      </div>
      <div class="col-md-6">
        <label>top текста</label>
        <input type="number" min="0" step="1" value="<?= (isset($data['marginTopText']) && !empty($data['marginTopText']) ? (int)preg_replace('~[^0-9]+~', '', $data['marginTopText']): 0 )?>" data-tag="<?= $tag ?>" class="form-control tab-block-text">
      </div>
    </div>
  </div>
  <div class="col-md-12 mt-3">
    <hr>
    <label for="">Параметры подписи</label>
  </div>
  <div class="col-md-12 mt-2">
    <input type="text" id="signatureImg" data-tag="<?= $tag ?>" class="form-control" placeholder="Текст" value="<?= (isset($data['signut']) && !empty($data['signut']) ? $data['signut'] : '') ?>">
  </div>
  <div class="col-md-12">
    <div class="row dfert-gg" style="<?= (isset($data['signut']) && !empty($data['signut']) ? 'display:block' : 'display:none') ?>">

      <div class="col-md-12">
        <div class="row">


          <div class="col-md-2 mt-2">
            <label for="">Фон</label>
            <?
            if (isset($data['outputSignut']['background']) && !empty($data['outputSignut']['background'])) {
              preg_match('#\((.*?)\)#', $data['outputSignut']['background'], $match);
              if (isset($match) && isset($match[1]) && !empty($match[1])) {
                $color = $match[1];
                $colArray = explode(",", $color);
                if (isset($colArray[3]) && !empty($colArray[3])) {
                  $alpha = $colArray[3];
                } else {
                  $alpha = null;
                }

                $valColor = rgbToHex($colArray[0], $colArray[1], $colArray[2], $alpha);
              } else {
                $valColor = '#00a6ca';
              }
            } else {
              $valColor = '#00a6ca';
            }
            ?>
            <input type="color" id="signatureBac" data-tag="<?= $tag ?>" value="<?= $valColor ?>">
          </div>

          <div class="col-md-2 mt-2">
            <label>Текст</label>
            <?
            if (isset($data['outputSignut']['color']) && !empty($data['outputSignut']['color'])) {
              preg_match('#\((.*?)\)#', $data['outputSignut']['color'], $match);
              if (isset($match) && isset($match[1]) && !empty($match[1])) {
                $color = $match[1];
                $colArray = explode(",", $color);
                if (isset($colArray[3]) && !empty($colArray[3])) {
                  $alpha = $colArray[3];
                } else {
                  $alpha = null;
                }
                $valColor = rgbToHex($colArray[0], $colArray[1], $colArray[2], $alpha);
              } else {
                $valColor = '#fff';
              }
            } else {
              $valColor = '#fff';
            }
            ?>
            <input type="color" id="signatureCol" data-tag="<?= $tag ?>" value="<?= $valColor ?>">
          </div>

          <div class="col-md-8 mt-2">
            <label style="width:100%; text-align: center">Положение</label>
            <div class="blosk-west">
              <ul class="nav nav-pills signitPol" style="margin: 0 auto">
                <li class="lirt-left nav-item">
                  <div class="nav-link" data-pos="left" data-tag="<?= $tag ?>">
                    <i class="fa fa-align-left" aria-hidden="true"></i>
                  </div>
                </li>
                <li class="lirt-center nav-item">
                  <div class="nav-link" data-pos="center" data-tag="<?= $tag ?>">
                    <i class="fa fa-align-center" aria-hidden="true"></i>
                  </div>
                </li>
                <li class="lirt-right nav-item">
                  <div class="nav-link" data-pos="right" data-tag="<?= $tag ?>">
                    <i class="fa fa-align-right" aria-hidden="true"></i>
                  </div>
                </li>
              </ul>
            </div>
          </div>

        </div>

      </div>

      <?= $this->render('../articles/param-padding', ['type' => 'signut', 'id' => $tag, 'def' => '10', 'output' => $data['outputSignut']]) ?>
    </div>
  </div>
  <div class="col-md-12">
    <hr>
  </div>
</div>
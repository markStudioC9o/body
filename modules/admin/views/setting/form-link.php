<?

use yii\helpers\Html;

?>

  <?
  if(isset($link->value) && !empty($link->value)){
    $array = json_decode($link->value, true);
  }
  
  
  ?>
  <div class="col-md-6">
    <div class="block_prel">

      <? if (!empty($array['left'])) : ?>
        <? foreach ($array['left'] as $key => $value) : ?>
          <? $type = $key; ?>
          <? if (isset($value['head']) && !empty($value['head'])) : ?>
            <div class="row bor operd">
              <input type="hidden" class="rand-s" value="<?= $type ?>">
              <div class="col-md-8 mt-1">
                <input type="text" value="<?= $value['head']['text'] ?>" name="footer[left][<?= $type; ?>][head][text]" class="form-control" placeholder="Текст заголовка" required>
              </div>
              <div class="col-md-1 mt-1">
                <span class="deleteThisElem">
                  <i class="fa fa-trash" aria-hidden="true"></i>
                </span>
              </div>
              <div class="col-md-8 mt-1">
                <input type="text" value="<?= $value['head']['link'] ?>" name="footer[left][<?= $type; ?>][head][link]" class="form-control" placeholder="Адресс ссылки заголовка" required>
              </div>
              <div class="col-md-4 mt-1">
              </div>
              <div class="col-md-2 mt-1">
                <input type="color" value="<?= $value['head']['color'] ?>" name="footer[left][<?= $type; ?>][head][color]">
              </div>
              <div class="col-md-3 mt-1">
                <input type="number" class="form-control" value="<?= $value['head']['size'] ?>" steep="1" min="1" max="40" name="footer[left][<?= $type; ?>][head][size]">
              </div>
              <div class="col-md-3 mt-1">
                <? $wieght = array("400", "500", "600", "700") ?>
                <select name="footer[left][<?= $type; ?>][head][weight]" class="form-control">
                  <? foreach ($wieght as $er => $rt) : ?>
                    <option value="<?= $rt ?>" <? if ($rt == $value['head']['weight']) echo "selected"; ?>><?= $rt ?></option>
                  <? endforeach; ?>
                </select>
              </div>
            </div>
          <? endif; ?>
          <? if (isset($value['block']) && !empty($value['block'])) : ?>
            <? $pos = "left"; ?>
            <? foreach ($value['block'] as $em => $en) : ?>
              <div class="row operd">
                <? $add = $em; ?>
                <div class="col-md-8 mt-1">
                  <input type="text" value="<?= $en['text'] ?>" name="footer[<?= $pos; ?>][<?= $type; ?>][block][<?= $add; ?>][text]" class="form-control" placeholder="Текст ссылки" required>
                </div>
                <div class="col-md-1 mt-1">
                  <span class="deleteThisElem">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                  </span>
                </div>
                <div class="col-md-8 mt-1">
                  <input type="text" value="<?= $en['link'] ?>" name="footer[<?= $pos; ?>][<?= $type; ?>][block][<?= $add; ?>][link]" class="form-control" placeholder="Адресс ссылки" required>
                </div>
                <div class="col-md-4 mt-1">
                  
                </div>
                <div class="col-md-2 mt-1">
                  <input type="color" value="<?= $en['color'] ?>" name="footer[<?= $pos; ?>][<?= $type; ?>][block][<?= $add; ?>][color]">
                </div>
                <div class="col-md-3 mt-1">
                  <input type="number" class="form-control" value="<?= $en['size'] ?>" steep="1" min="1" max="40" name="footer[<?= $pos; ?>][<?= $type; ?>][block][<?= $add; ?>][size]">
                </div>
                <div class="col-md-3 mt-1">
                  <? $wieght = array("400", "500", "600", "700") ?>

                  <select name="footer[<?= $pos; ?>][<?= $type; ?>][block][<?= $add; ?>][weight]" class="form-control">
                    <? foreach ($wieght as $er => $rt) : ?>
                      <option value="<?= $rt ?>" <? if ($rt == $en['weight']) echo "selected"; ?>><?= $rt ?></option>
                    <? endforeach; ?>
                  </select>
                </div>
              </div>
            <? endforeach; ?>
          <? endif; ?>
        <? endforeach; ?>
      <? else : ?>


        <div class="row bor operd">
          <? $type = rand(0, 999); ?>
          <input type="hidden" class="rand-s" value="<?= $type ?>">
          <div class="col-md-8 mt-1">
            <input type="text" name="footer[left][<?= $type; ?>][head][text]" class="form-control" placeholder="Текст заголовка" required>
          </div>
          <div class="col-md-1 mt-1">
            <span>
              <i class="fa fa-trash" aria-hidden="true"></i>
            </span>
          </div>
          <div class="col-md-8 mt-1">
            <input type="text" name="footer[left][<?= $type; ?>][head][link]" class="form-control" placeholder="Адресс ссылки заголовка" required>
          </div>
          <div class="col-md-4 mt-1">
          </div>
          <div class="col-md-2 mt-1">
            <input type="color" value="#00a6ca" name="footer[left][<?= $type; ?>][head][color]">
          </div>
          <div class="col-md-3 mt-1">
            <input type="number" class="form-control" value="18" steep="1" min="1" max="40" name="footer[left][<?= $type; ?>][head][size]">
          </div>
          <div class="col-md-3 mt-1">
            <select name="footer[left][<?= $type; ?>][head][weight]" class="form-control">
              <option value="400">400</option>
              <option value="500">500</option>
              <option value="600">600</option>
              <option value="700" selected>700</option>
            </select>
          </div>
        </div>
      <? endif; ?>
      <span class="add-link-block" data-pos="left" data-type="<?= $type ?>">
        <i class="fa fa-plus" aria-hidden="true"></i> Простая ссылка
      </span>
    </div>
    <span class="modal-block" data-pos="left">
      <i class="fa fa-plus" aria-hidden="true"></i> Заголовок
    </span>
  </div>


  <div class="col-md-6">
    <div class="block_prel">
      <? if (!empty($array['right'])) : ?>
        <? foreach ($array['right'] as $key => $value) : ?>
          <? $type = $key; ?>
          <? if (isset($value['head']) && !empty($value['head'])) : ?>
            <div class="row bor operd">
              <input type="hidden" class="rand-s" value="<?= $type ?>">
              <div class="col-md-8 mt-1">
                <input type="text" value="<?= $value['head']['text'] ?>" name="footer[right][<?= $type; ?>][head][text]" class="form-control" placeholder="Текст заголовка" required>
              </div>
              <div class="col-md-1 mt-1">
                <span class="deleteThisElem">
                  <i class="fa fa-trash" aria-hidden="true"></i>
                </span>
              </div>
              <div class="col-md-8 mt-1">
                <input type="text" value="<?= $value['head']['link'] ?>" name="footer[right][<?= $type; ?>][head][link]" class="form-control" placeholder="Адресс ссылки заголовка" required>
              </div>
              <div class="col-md-4 mt-1">
              </div>
              <div class="col-md-2 mt-1">
                <input type="color" value="<?= $value['head']['color'] ?>" name="footer[right][<?= $type; ?>][head][color]">
              </div>
              <div class="col-md-3 mt-1">
                <input type="number" class="form-control" value="<?= $value['head']['size'] ?>" steep="1" min="1" max="40" name="footer[right][<?= $type; ?>][head][size]">
              </div>
              <div class="col-md-3 mt-1">
                <? $wieght = array("400", "500", "600", "700") ?>
                <select name="footer[right][<?= $type; ?>][head][weight]" class="form-control">
                  <? foreach ($wieght as $er => $rt) : ?>
                    <option value="<?= $rt ?>" <? if ($rt == $value['head']['weight']) echo "selected"; ?>><?= $rt ?></option>
                  <? endforeach; ?>
                </select>
              </div>
            </div>
          <? endif; ?>
          <? if (isset($value['block']) && !empty($value['block'])) : ?>
            <? $pos = "right"; ?>
            <? foreach ($value['block'] as $em => $en) : ?>
              <div class="row operd">
                <? $add = $em; ?>
                <div class="col-md-8 mt-1">
                  <input type="text" value="<?= isset($en['text']) ? $en['text'] : "" ?>" name="footer[<?= $pos; ?>][<?= $type; ?>][block][<?= $add; ?>][text]" class="form-control" placeholder="Текст ссылки" required>
                </div>
                <div class="col-md-1 mt-1">
                  <span class="deleteThisElem">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                  </span>
                </div>
                <div class="col-md-8 mt-1">
                  <input type="text" value="<?= isset($en['link']) ? $en['link'] : "" ?>" name="footer[<?= $pos; ?>][<?= $type; ?>][block][<?= $add; ?>][link]" class="form-control" placeholder="Адресс ссылки" required>
                </div>
                <div class="col-md-4 mt-1">
                  
                </div>
                <div class="col-md-2 mt-1">
                  <input type="color" value="<?= (isset($en['color']) ? $en['color'] : "") ?>" name="footer[<?= $pos; ?>][<?= $type; ?>][block][<?= $add; ?>][color]">
                </div>
                <div class="col-md-3 mt-1">
                  <input type="number" class="form-control" value="<?= (isset($en['size']) ? $en['size'] : "")?>" steep="1" min="1" max="40" name="footer[<?= $pos; ?>][<?= $type; ?>][block][<?= $add; ?>][size]">
                </div>
                <div class="col-md-3 mt-1">
                  <? $wieght = array("400", "500", "600", "700") ?>
                  <select name="footer[<?= $pos; ?>][<?= $type; ?>][block][<?= $add; ?>][weight]" class="form-control">
                    <? foreach ($wieght as $er => $rt) : ?>
                      <option value="<?= $rt ?>" <? if (isset($en['weight']) && $rt == $en['weight']) echo "selected"; ?>><?= $rt ?></option>
                    <? endforeach; ?>
                  </select>
                </div>
              </div>
            <? endforeach; ?>
          <? endif; ?>
        <? endforeach; ?>
      <? else : ?>
        <div class="row bor">
          <? $type = rand(0, 999); ?>
          <input type="hidden" class="rand-s" value="<?= $type ?>">
          <div class="col-md-8 mt-1">
            <input type="text" name="footer[right][<?= $type; ?>][head][text]" class="form-control" placeholder="Текст ссылки заголовка" required>
          </div>
          <div class="col-md-1 mt-1">
            <span>
              <i class="fa fa-trash" aria-hidden="true"></i>
            </span>
          </div>
          <div class="col-md-8 mt-1">
            <input type="text" name="footer[right][<?= $type; ?>][head][link]" class="form-control" placeholder="Адресс ссылки заголовка" required>
          </div>
          <div class="col-md-4 mt-1">
            <span>
              <i class="fa fa-trash" aria-hidden="true"></i>
            </span>
          </div>
          <div class="col-md-2 mt-1">
            <input type="color" value="#00a6ca" name="footer[right][<?= $type; ?>][head][color]">
          </div>
          <div class="col-md-3 mt-1">
            <input type="number" class="form-control" value="18" steep="1" min="1" max="40" name="footer[right][<?= $type; ?>][head][size]">
          </div>
          <div class="col-md-4 mt-1">
            <select name="footer[right][<?= $type; ?>][head][weight]" class="form-control">
              <option value="400">400</option>
              <option value="500">500</option>
              <option value="600">600</option>
              <option value="700" selected>700</option>
            </select>
          </div>
        </div>
      <? endif; ?>
      <span class="add-link-block" data-pos="right" data-type="<?= $type ?>">
        <i class="fa fa-plus" aria-hidden="true"></i> Простая ссылка
      </span>
    </div>
    <span class="modal-block" data-pos="right">
      <i class="fa fa-plus" aria-hidden="true"></i> Заголовок
    </span>
  </div>

  
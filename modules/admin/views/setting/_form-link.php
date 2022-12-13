<? if (!empty($link)) : ?>
  <? if (!empty($link->value)) : ?>
    <? $array = json_decode($link->value, true)  ?>
      <div class="col-md-6">
        <div class="block_prel">
          <? if (!empty($array['left'])) : ?>
            <? foreach ($array['left'] as $type => $value) : ?>
              <div class="row">
                <div class="col-md-8 mt-1">
                  <input type="text" name="footer[left][<?= $type; ?>][text]" class="form-control" placeholder="Текст ссылки" required value="<?= $value['text'] ?>">
                </div>
                <div class="col-md-1 mt-1">
                  <span>
                    <i class="fa fa-trash" aria-hidden="true"></i>
                  </span>
                </div>
                <div class="col-md-8 mt-1">
                  <input type="text" name="footer[left][<?= $type; ?>][link]" class="form-control" placeholder="Адресс ссылки" required value="<?= $value['link'] ?>">
                </div>
                <div class="col-md-4 mt-1">
                  <span>
                    <i class="fa fa-trash" aria-hidden="true"></i>
                  </span>
                </div>
                <div class="col-md-2 mt-1">
                  <input type="color" name="footer[left][<?= $type; ?>][color]" value="<?= $value['color'] ?>">
                </div>
                <div class="col-md-3 mt-1">
                  <input type="number" class="form-control" value="<?= $value['size'] ?>" steep="1" min="1" max="40" name="footer[left][<?= $type; ?>][size]">
                </div>
                <div class="col-md-4 mt-1">
                  <select name="footer[left][<?= $type; ?>][weight]" class="form-control">
                    <option value="400" <?= ($value['weight'] == '400' ? 'selected' : '') ?>>400</option>
                    <option value="500" <?= ($value['weight'] == '500' ? 'selected' : '') ?>>500</option>
                    <option value="600" <?= ($value['weight'] == '600' ? 'selected' : '') ?>>600</option>
                    <option value="700" <?= ($value['weight'] == '700' ? 'selected' : '') ?>>700</option>
                  </select>
                </div>
              </div>
            <? endforeach; ?>
          <? else : ?>
            <div class="row">
              <? $type = rand(0, 999); ?>
              <div class="col-md-8 mt-1">
                <input type="text" name="footer[left][<?= $type; ?>][text]" class="form-control" placeholder="Текст ссылки" required>
              </div>
              <div class="col-md-1 mt-1">
                <span>
                  <i class="fa fa-trash" aria-hidden="true"></i>
                </span>
              </div>
              <div class="col-md-8 mt-1">
                <input type="text" name="footer[left][<?= $type; ?>][link]" class="form-control" placeholder="Адресс ссылки" required>
              </div>
              <div class="col-md-4 mt-1">
                <span>
                  <i class="fa fa-trash" aria-hidden="true"></i>
                </span>
              </div>
              <div class="col-md-2 mt-1">
                <input type="color" value="#000" name="footer[left][<?= $type; ?>][color]">
              </div>
              <div class="col-md-3 mt-1">
                <input type="number" class="form-control" value="14" steep="1" min="1" max="40" name="footer[left][<?= $type; ?>][size]">
              </div>
              <div class="col-md-4 mt-1">
                <select name="footer[left][<?= $type; ?>][weight]" class="form-control">
                  <option value="400">400</option>
                  <option value="500">500</option>
                  <option value="600">600</option>
                  <option value="700">700</option>
                </select>
              </div>
            </div>

          <? endif; ?>
          <span class="add-link-block" data-pos="left"><i class="fa fa-plus" aria-hidden="true"></i></span>
        </div>
      </div>
      <div class="col-md-6">
        <div class="block_prel">
          <? if (!empty($array['right'])) : ?>
            <? foreach ($array['right'] as $type => $value) : ?>
              <div class="row">
                <div class="col-md-8 mt-1">
                  <input type="text" name="footer[right][<?= $type; ?>][text]" class="form-control" placeholder="Текст ссылки" required value="<?= $value['text'] ?>">
                </div>
                <div class="col-md-1 mt-1">
                  <span>
                    <i class="fa fa-trash" aria-hidden="true"></i>
                  </span>
                </div>
                <div class="col-md-8 mt-1">
                  <input type="text" name="footer[right][<?= $type; ?>][link]" class="form-control" placeholder="Адресс ссылки" required value="<?= $value['link'] ?>">
                </div>
                <div class="col-md-4 mt-1">
                  <span>
                    <i class="fa fa-trash" aria-hidden="true"></i>
                  </span>
                </div>
                <div class="col-md-2 mt-1">
                  <input type="color" name="footer[right][<?= $type; ?>][color]" value="<?= $value['color'] ?>">
                </div>
                <div class="col-md-3 mt-1">
                  <input type="number" class="form-control" value="<?= $value['size'] ?>" steep="1" min="1" max="40" name="footer[right][<?= $type; ?>][size]">
                </div>
                <div class="col-md-4 mt-1">
                  <select name="footer[right][<?= $type; ?>][weight]" class="form-control">
                    <option value="400" <?= ($value['weight'] == '400' ? 'selected' : '') ?>>400</option>
                    <option value="500" <?= ($value['weight'] == '500' ? 'selected' : '') ?>>500</option>
                    <option value="600" <?= ($value['weight'] == '600' ? 'selected' : '') ?>>600</option>
                    <option value="700" <?= ($value['weight'] == '700' ? 'selected' : '') ?>>700</option>
                  </select>
                </div>
              </div>
            <? endforeach; ?>
          <? else : ?>
            <div class="row">
              <? $type = rand(0, 999); ?>
              <div class="col-md-8 mt-1">
                <input type="text" name="footer[right][<?= $type; ?>][text]" class="form-control" placeholder="Текст ссылки" required>
              </div>
              <div class="col-md-1 mt-1">
                <span>
                  <i class="fa fa-trash" aria-hidden="true"></i>
                </span>
              </div>
              <div class="col-md-8 mt-1">
                <input type="text" name="footer[right][<?= $type; ?>][link]" class="form-control" placeholder="Адресс ссылки" required>
              </div>
              <div class="col-md-4 mt-1">
                <span>
                  <i class="fa fa-trash" aria-hidden="true"></i>
                </span>
              </div>
              <div class="col-md-2 mt-1">
                <input type="color" value="#000" name="footer[right][<?= $type; ?>][color]">
              </div>
              <div class="col-md-3 mt-1">
                <input type="number" class="form-control" value="14" steep="1" min="1" max="40" name="footer[right][<?= $type; ?>][size]">
              </div>
              <div class="col-md-4 mt-1">
                <select name="footer[right][<?= $type; ?>][weight]" class="form-control">
                  <option value="400">400</option>
                  <option value="500">500</option>
                  <option value="600">600</option>
                  <option value="700">700</option>
                </select>
              </div>
            </div>
          <? endif; ?>
          <span class="add-link-block" data-pos="right"><i class="fa fa-plus" aria-hidden="true"></i></span>
        </div>
      </div>
  <? endif; ?>
<? endif; ?>
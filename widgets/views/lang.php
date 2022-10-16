<div class="wrapper_modal_lang">
  <div class="in_modal">
    <div class="cl-bt">
      <img src="/icon/modalcl.svg" alt="">
    </div>
    <div class="proof-tt">
      <? if (isset($title['value']) && !empty($title['value'])) : ?>
        <?= $title['value']; ?>
      <? else : ?>
        Выберите свой город
      <? endif; ?>
    </div>
    <div class="slo-g">
      <?
      $array = array();
      if (isset($country->citeslist)) {
        foreach ($country->citeslist as $elem) {
          $array[$country->name][] = array(
            'name' => $elem->name,
            'postscript' => $elem->postscript
          );
        }
      }
      ?>
      <? foreach ($countryDop as $item) {
        foreach ($item->citiesfield as $els) {
          $array[$item->name][] = array(
            'name' => $els->name,
            'postscript' => $els->postscript
          );
        }
      }

      $str = array(
        '0' => array(),
        '1' => array(),
        '2' => array()
      );
      foreach ($array as $em => $es) {
        if (isset($str[0]) && count($str[0]) + count($es) < 15) {
          $str[0][] = "<li class=\"title\">" . $em . "</li>";
          foreach ($es as $ir) {
            $str[0][] = "<li data-name=\"" . $ir['name'] . "\">" . $ir['name'] . "<span>" . $ir['postscript'] . "</span></li>";
          }
        } else {
          if (isset($str[1]) && count($str[1]) + count($es) < 15) {
            $str[1][] = "<li class=\"title\">" . $em . "</li>";
            foreach ($es as $ir) {
              $str[1][] = "<li data-name=\"" . $ir['name'] . "\">" . $ir['name'] . "<span>" . $ir['postscript'] . "</span></li>";
            }
          } else {
            $str[2][] = "<li class=\"title\">" . $em . "</li>";
            foreach ($es as $ir) {
              $str[2][] = "<li data-name=\"" . $ir['name'] . "\">" . $ir['name'] . "<span>" . $ir['postscript'] . "</span></li>";
            }
          }
        }
      }
      ?>
      <? foreach ($str as $vr => $vs) : ?>
        <? if (!empty($vs)) : ?>
          <ul class="clerf">
            <? foreach ($vs as $sdr => $vas) : ?>
              <?= $vas; ?>
            <? endforeach; ?>
          </ul>
        <? endif; ?>
      <? endforeach; ?>
    </div>
  </div>
</div>
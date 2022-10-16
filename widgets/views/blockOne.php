<?
$array = null;
if(!empty($con)){
  $array = json_decode($con, true);
}?>





<div class="block_1">
  <div class="container">
    <div class="fb1_wrap">
      <div class="item to_site">
        <div class="icon-item-shild" style="background-image: url('/img/fb_1_img_1.svg');">
        </div>
        <p class="title">
          <? if(isset($array[1]['name']) && !empty($array[1]['name'])){
            echo $array[1]['name'];
          }?>
        </p>
        <p class="desc">
          <? if(isset($array[1]['text']) && !empty($array[1]['text'])){
            echo $array[1]['text'];
          }?>
          </p>
      </div>
      <div class="item to_site">
        <div class="icon-item-shild" style="background-image: url('/img/fb_1_img_2.svg');">
        </div>
        <p class="title">
        <? if(isset($array[2]['name']) && !empty($array[2]['name'])){
            echo $array[2]['name'];
          }?>
        </p>
        <p class="desc">
        <? if(isset($array[2]['text']) && !empty($array[2]['text'])){
            echo $array[2]['text'];
          }?>
        </p>
      </div>
      <div class="item to_site">
        <div class="icon-item-shild" style="background-image: url('/img/fb_1_img_3.svg');">
        </div>
        <p class="title">
        <? if(isset($array[3]['name']) && !empty($array[3]['name'])){
            echo $array[3]['name'];
          }?>
        </p>
        <p class="desc">
        <? if(isset($array[3]['text']) && !empty($array[3]['text'])){
            echo $array[3]['text'];
          }?>
        </p>
      </div>
    </div>
  </div>
</div>
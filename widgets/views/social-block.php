<? if(isset($item['id']) && !empty($item['id']) && !empty($item['data'])):?>
<div class="item <?= (isset($item['value']) && !empty($item['value']) && $item['value'] == "promt" ? "promtr" : "net-promt" )?>">
  <?
  switch ($item['id']) {
    case 'email':
      echo "<a class=\"icon sp-sd\" href=\"mailto:" . $item['data'] . "\">"
        . "<img src=\"/icon/mailIconMain.svg\" alt=\"\">"
        . "<img src=\"/icon/hover/mail.svg\" alt=\"\" class=\"hover\">"
        . "</a>";
      break;
    case "instagram":
      echo "<a class=\"icon sp-sd\" target=\"_blank\" href=\"" . $item['data'] . "\">
        <img src=\"/icon/instagramMain.svg\" alt=\"\">
        <img src=\"/icon/hover/insta.svg\" alt=\"\" class=\"hover\">
        </a>";
      break;
    case "youtube":
      echo "<a class=\"icon sp-sd\" target=\"_blank\" href=\"" . $item['data'] . "\">
        <img src=\"/icon/YoutubeMain.svg\" alt=\"\">
        <img src=\"/icon/hover/you.svg\" alt=\"\" class=\"hover\">
        </a>";
      break;
    case "whatsapp":
      echo "<a class=\"icon sp-sd\" target=\"_blank\" href=\"" . $item['data'] . "\">
        <img src=\"/icon/what.svg\" alt=\"\">
        <img src=\"/vidget/iocn/wh.svg\" alt=\"\" class=\"hover\">
        </a>";
      break;
    case "telegram":
      echo "<a class=\"icon sp-sd\" target=\"_blank\" href=\"" . $item['data'] . "\">
        <img src=\"/icon/tlg.svg\" alt=\"\">
        <img src=\"/vidget/iocn/tg.svg\" alt=\"\" class=\"hover\">
        </a>";
      break;
    case "vkontakte":
      echo "<a class=\"icon sp-sd\" target=\"_blank\" href=\"" . $item['data'] . "\">
        <img src=\"/icon/vkicon.svg\" alt=\"\">
        <img src=\"/icon/vk.svg\" alt=\"\" class=\"hover\">
          </a>";
      break;

      case "viber":
        echo "<a class=\"icon sp-sd\" target=\"_blank\" href=\"" . $item['data'] . "\">
          <img src=\"/icon/what.svg\" alt=\"\">
          <img src=\"/icon/hover/Frame 8.svg\" alt=\"\" class=\"hover\">
            </a>";
        break;
  }
  ?>
</div>
<?//  = $item['id']?>
<? endif;?>
<!-- <div class="item user"><a class="icon icon-user" href="https://body-balance.com/account/"><img src="/icon/lk.svg" alt=""></a></div> -->
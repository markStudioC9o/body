<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
  // "https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf"
  public $basePath = '@webroot';
  public $baseUrl = '@web';
  public $css = [
    //'/stem/stylesheet.css',
    "/vidget/common.css",
    "/vidget/bb-arw-wall.css",
    "/vidget/bb-arw-card.css",
    "/vidget/bb-arw-tabs.css",
    "/vidget/bb-arw-select.css",
    "/vidget/bb-arw-input.css",
    "/vidget/bb-arw-checkbox.css",
    "/vidget/bb-arw-button.css",
    "/vidget/bb-arw-social.css",
    '/css/main.css',
    "//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css",
    '/css/swiper.min.css',
    'https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css',
    "https://use.fontawesome.com/releases/v5.8.1/css/all.css",
    // 'https://fonts.googleapis.com/css?family=Roboto:300,400,500&display=swap&subset=cyrillic',
    "//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css",
    '/css/style.css',
    '/css/mainMedia.css',
    '/css/header.css',
    "css/general.css",
    '/css/mediaHeader.css',
    '/css/mediaContent.css',
    '/css/defaultSetting.css',
    '/css/icon.css',
  ];
  public $js = [
    "http://www.youtube.com/player_api",
    'https://cdnjs.cloudflare.com/ajax/libs/Swiper/5.4.5/js/swiper.min.js?ver=1.1',
    "//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js",
    "adminStyle/plugins/jquery-ui/jquery-ui.min.js",
    "js/jquery.mask.js",
    "js/general.js",
    "/js/jquery.session.js",
    '/js/main.js',
    '/js/galleryNormalize.js',
    '/js/toshare.js',
  ];
  public $depends = [
    'yii\web\YiiAsset',
    'yii\bootstrap4\BootstrapAsset',
  ];
}

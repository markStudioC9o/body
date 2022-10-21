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
class AdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        "https://fonts.googleapis.com/icon?family=Material+Icons",
        "https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback",
        "adminStyle/plugins/fontawesome-free/css/all.min.css",
        "//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css",
        "https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css",
        "adminStyle/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css",
        "adminStyle/plugins/icheck-bootstrap/icheck-bootstrap.min.css",
        "//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css",
        "adminStyle/plugins/jqvmap/jqvmap.min.css",
        "adminStyle/dist/css/adminlte.min.css",
        "adminStyle/plugins/overlayScrollbars/css/OverlayScrollbars.min.css",
        "adminStyle/plugins/daterangepicker/daterangepicker.css",
        "adminStyle/plugins/summernote/summernote-bs4.min.css",
        "adminStyle/plugins/select2/css/select2.min.css",
        "adminStyle/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css",
        "css/redactor.css",
        "css/general.css",
        "js/croppie.css",
        "adminStyle/custom.css",
        "adminStyle/theme.css",
        'css/icon.css',
        //'css/defaultStyle1680.css'
    ];
    public $js = [
        //"adminStyle/plugins/jquery/jquery.min.js",
        "//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js",
        "https://use.fontawesome.com/c0e3b0c3fb.js",
        "adminStyle/plugins/jquery-ui/jquery-ui.min.js",
        "adminStyle/plugins/bootstrap/js/bootstrap.bundle.min.js",
        "adminStyle/plugins/chart.js/Chart.min.js",
        "adminStyle/plugins/sparklines/sparkline.js",
        "adminStyle/plugins/jqvmap/jquery.vmap.min.js",
        "adminStyle/plugins/jqvmap/maps/jquery.vmap.usa.js",
        "adminStyle/plugins/jquery-knob/jquery.knob.min.js",
        "adminStyle/plugins/moment/moment.min.js",
        "adminStyle/plugins/daterangepicker/daterangepicker.js",
        "adminStyle/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js",
        "adminStyle/plugins/summernote/summernote-bs4.min.js",
        "adminStyle/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js",
        "adminStyle/dist/js/adminlte.js",
        "adminStyle/dist/js/demo.js",
        "adminStyle/plugins/select2/js/select2.full.min.js",
        "sortable/jquery-sortable-lists.js",
        "sortable/jquery-sortable-lists-mobile.js",
        "js/dragdrop.js",
        "js/general.js",
        "js/croppie.js",
        "js/text-redactor.js",
        "js/custom.js",
        "jsAdmin/title-para.js",
        
        // "jsAdmin/title-para.min.js"
        
        
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}

<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/admin/bootstrap.min.css',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css',
        'https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css',
        'css/admin/AdminLTE.min.css',
        'css/admin/_all-skins.min.css',
        'css/admin/blue.css',
        'css/admin/morris.css',
        'css/admin/jquery-jvectormap-1.2.2.css',
        'css/admin/datepicker3.css',
        'css/admin/daterangepicker.css',
        'css/admin/bootstrap3-wysihtml5.min.css',
        'css/site.css',
    ];
    public $js = [
        'https://code.jquery.com/ui/1.11.4/jquery-ui.min.js',
        'js/admin/bootstrap.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js',
        'js/admin/morris.min.js',
        'js/admin/jquery.sparkline.min.js',
        'js/admin/jquery-jvectormap-1.2.2.min.js',
        'js/admin/jquery-jvectormap-world-mill-en.js',
        'js/admin/jquery.knob.js',
        'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js',
        'js/admin/daterangepicker.js',        
        'js/admin/bootstrap-datepicker.js',
        'js/admin/bootstrap3-wysihtml5.all.min.js',
        'js/admin/jquery.slimscroll.min.js',
        'js/admin/fastclick.js',
        'js/admin/app.min.js',
       // 'js/admin/dashboard.js',
        'js/admin/demo.js',        
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}

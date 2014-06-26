<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\site\assets;

use yii\web\AssetBundle;

/**
 * Description of SiteAsset
 *
 * @author melengo
 */
class SiteAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        /**
         * CSS Global Compulsory
         */
        'site/plugins/bootstrap/css/bootstrap.min.css',
        'site/css/style.css',
        /**
         * CSS Implementing Plugins
         */
        'site/plugins/line-icons/line-icons.css',
        'site/plugins/font-awesome/css/font-awesome.css',
        'site/plugins/revolution_slider/rs-plugin/css/settings.css',
        'site/plugins/owl-carousel/owl-carousel/owl.carousel.css',
        /**
         * CSS Page
         */
        'site/css/pages/blog.css',
        'site/css/pages/feature_timeline2.css',
        'site/css/pages/page_404_error.css',
        'site/css/pages/page_log_reg_v1.css',
        'site/css/pages/portfolio-v2.css',
        /**
         * CSS Theme
         */        
        'site/css/themes/default.css',
        
    ];
    public $depends = [
         'yii\web\YiiAsset',
     ];
    public $js = [
         'site/js/jquery.form.min.js',
        /**
         * JS Global Compulsory
         */
//        'site/plugins/jquery-1.10.2.min.js',
        'site/plugins/jquery-migrate-1.2.1.min.js',
        'site/plugins/bootstrap/js/bootstrap.min.js',
        /**
         * JS Implementing Plugins
         */
        'site/plugins/back-to-top.min.js',
        'site/plugins/owl-carousel/owl-carousel/owl.carousel.js',
        'site/plugins/revolution_slider/rs-plugin/js/jquery.themepunch.revolution.min.js',
        /**
         * JS Page Level
         */
        'site/js/app.js',
        'site/js/pages/index.js',
        'site/js/plugins/owl-carousel.js',
        
//        'site/js/plugins/upload/js/jquery.knob.js',
//        'site/js/plugins/upload/js/jquery.ui.widget.js',
//        'site/js/plugins/upload/js/jquery.iframe-transport.js',
//        'site/js/plugins/upload/js/jquery.fileupload.js',
//        'site/js/plugins/upload/js/script.js',
        /**
         * JS Contact page
         */
//        'http://maps.google.com/maps/api/js?sensor=true',
//        'site/plugins/gmap/gmap.js',
//        'site/js/pages/page_contacts.js',
       
    ];

}
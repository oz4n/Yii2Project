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
        'unify-v1.4/plugins/bootstrap/css/bootstrap.min.css',
        'unify-v1.4/css/style.css',
        /**
         * CSS Implementing Plugins
         */
        'unify-v1.4/plugins/line-icons/line-icons.css',
        'unify-v1.4/plugins/font-awesome/css/font-awesome.css',
        'unify-v1.4/plugins/revolution_slider/rs-plugin/css/settings.css',
        'unify-v1.4/plugins/owl-carousel/owl-carousel/owl.carousel.css',
        /**
         * CSS Page
         */
        'unify-v1.4/css/pages/blog.css',
        'unify-v1.4/css/pages/feature_timeline2.css',
        'unify-v1.4/css/pages/page_404_error.css',
        'unify-v1.4/css/pages/page_log_reg_v1.css',
        /**
         * CSS Theme
         */        
        'unify-v1.4/css/themes/default.css',
        
    ];
    public $js = [
        /**
         * JS Global Compulsory
         */
        'unify-v1.4/plugins/jquery-1.10.2.min.js',
        'unify-v1.4/plugins/jquery-migrate-1.2.1.min.js',
        'unify-v1.4/plugins/bootstrap/js/bootstrap.min.js',
        /**
         * JS Implementing Plugins
         */
        'unify-v1.4/plugins/back-to-top.js',
        'unify-v1.4/plugins/owl-carousel/owl-carousel/owl.carousel.js',
        'unify-v1.4/plugins/revolution_slider/rs-plugin/js/jquery.themepunch.revolution.min.js',
        /**
         * JS Page Level
         */
        'unify-v1.4/js/app.js',
        'unify-v1.4/js/pages/index.js',
        'unify-v1.4/js/plugins/owl-carousel.js',
        
        /**
         * JS Contact page
         */
        'http://maps.google.com/maps/api/js?sensor=true',
        'unify-v1.4/plugins/gmap/gmap.js',
        'unify-v1.4/js/pages/page_contacts.js'
    ];

}
<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\modules\dashboard\assets;

use yii\web\AssetBundle;
/**
 * Description of DashboardAsset
 *
 * @author melengo
 */
class DashboardAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        /*Open Sans font from Google CDN*/
        'http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&subset=latin',
        
        /*Pixel Admin's stylesheets*/
        'PixelAdmin/css/bootstrap.min.css',
        'PixelAdmin/css/pixel-admin.css',
        'PixelAdmin/css/widgets.css',
        'PixelAdmin/css/pages.css',
        'PixelAdmin/css/rtl.css',
        'PixelAdmin/css/themes.css',
    ];
    public $js = [
        /**
         * JS Global Compulsory
         */
//        'PixelAdmin/js/jquery.2.0.3.min.js',
        'PixelAdmin/js/bootstrap.min.js',
        'PixelAdmin/js/pixel-admin.min.js',      
    ];

}
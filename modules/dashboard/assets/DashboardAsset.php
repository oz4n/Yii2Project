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
        /* Open Sans font from Google CDN */
        'http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&subset=latin',
        /* Pixel Admin's stylesheets */
        'PixelAdmin/css/bootstrap.min.css',
        'PixelAdmin/css/pixel-admin.css',
        'PixelAdmin/css/widgets.css',
        'PixelAdmin/css/pages.css',
        'PixelAdmin/css/rtl.css',
        'PixelAdmin/css/themes.css',
        'PixelAdmin/css/profil.css',
        'PixelAdmin/css/label.css',
        'PixelAdmin/css/space.css',
        'PixelAdmin/css/widget-box.css',
        'PixelAdmin/css/thumbnail.css',
        'PixelAdmin/css/widgets.css',
        'redactor/redactor.css',
        'PixelAdmin/css/galery.css',
        'jnestable/nestable.css',
    ];
    public $js = [
        /**
         * JS Global Compulsory
         */
//        'PixelAdmin/js/jquery.2.0.3.min.js',
        'PixelAdmin/js/bootstrap.min.js',
        'PixelAdmin/js/pixel-admin.min.js',
        'PixelAdmin/js/bootstrap-datepicker.js',
        'PixelAdmin/js/bootstrap-datepicker.id.js',
        'redactor/redactor.js',
        'redactor/plugins/fullscreen/fullscreen.js',
        'redactor/lang/id.js',
       
        
        //jQuery UI widget factory
        'jfileupload/js/vendor/jquery.ui.widget.js', 
        //JavaScript-Load-Image
        'jloadimage/js/load-image.min.js',
        'jcanvastoblob/canvas-to-blob.min.js',
        //file upload
        'jfileupload/js/jquery.iframe-transport.js',        
        'jfileupload/js/jquery.fileupload.js',
        'jfileupload/js/jquery.fileupload-process.js',
        'jfileupload/js/jquery.fileupload-image.js',
        'jfileupload/js/jquery.fileupload-audio.js',
        'jfileupload/js/jquery.fileupload-video.js',
        'jfileupload/js/jquery.fileupload-validate.js',
        
        'jnestable/jquery.nestable.js',
    ];
    

}

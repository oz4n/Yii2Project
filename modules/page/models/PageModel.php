<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\page\models;

use app\modules\dao\ar\Post;

/**
 * Description of PageModel
 *
 * @author melengo
 */
class PageModel extends Post
{
    public $imgsliderstatus;
    public $imgslider;
    public $quotes_today;
    public $slider_title1;
    public $slider_title2;
    public $slider_title3;

    public function behaviors()
    {
        return [
            'slug' => [
                'class' => 'Zelenin\yii\behaviors\Slug',
                'source_attribute' => 'title',
                'slug_attribute' => 'slug',
                // optional params
                'translit' => false,
                'replacement' => '-',
                'lowercase' => true,
                'unique' => true
            ]
        ];
    }
    
   

}

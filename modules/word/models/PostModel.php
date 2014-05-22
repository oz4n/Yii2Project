<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 5/23/14
 * Time: 12:46 AM
 */

namespace app\modules\word\models;


use app\modules\dao\ar\Post;



class PostModel extends Post
{
    public $category;
    public $tag;

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
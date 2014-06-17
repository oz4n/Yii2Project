<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 5/8/14
 * Time: 5:54 PM
 */

namespace app\modules\member\models;


use app\modules\dao\ar\Taxonomy;

class YearModel extends Taxonomy
{

    public function behaviors()
    {
        return [
            'slug' => [
                'class' => 'Zelenin\yii\behaviors\Slug',
                'source_attribute' => 'name',
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
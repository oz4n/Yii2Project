<?php
/**
 * Created by LINUX UBUNTU.
 * User: Moh Fauzan Azim
 * Date: 5/8/14
 * Time: 5:46 PM
 */

namespace app\modules\member\models;


use app\modules\dao\ar\Taxonomy;

class AreaModel extends Taxonomy
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

    public function getParentName()
    {
        $m = self::findBySql("SELECT * FROM " . $this->tableName() . " WHERE id='" . $this->parent_id . "'")->one();
        return $m["name"];
    }
}
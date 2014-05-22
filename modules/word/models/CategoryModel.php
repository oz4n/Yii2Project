<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 5/22/14
 * Time: 11:35 PM
 */

namespace app\modules\word\models;


use app\modules\dao\ar\Taxonomy;

class CategoryModel extends Taxonomy
{
    public function getParentName()
    {
        $query = self::findBySql("SELECT * FROM " . $this->tableName() . " WHERE id='" . $this->parent_id . "'")->one();
        return $query['name'];
    }
} 
<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 5/8/14
 * Time: 5:33 PM
 */

namespace app\modules\member\models;

use app\modules\dao\ar\Taxonomy;

class AreaModel extends Taxonomy
{
    public function getParentName()
    {
        $m = Province::findBySql("SELECT * FROM " . $this->tableName() . " WHERE id='" . $this->parent_id . "'")->one();
        return $m["name"];
    }
} 
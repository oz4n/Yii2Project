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

    public function getParentName()
    {
        $m = self::findBySql("SELECT * FROM " . $this->tableName() . " WHERE id='" . $this->parent_id . "'")->one();
        return $m["name"];
    }
}
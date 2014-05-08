<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 5/8/14
 * Time: 5:57 PM
 */

namespace app\modules\member\models;


use app\modules\dao\ar\School;
use app\modules\dao\ar\Taxonomy;

class SchoolModel extends School
{
    public function getAreaName()
    {
        $m = Taxonomy::findBySql("SELECT * FROM taxonomy WHERE id='" . $this->taxonomy_id . "'")->one();
        return $m["name"];
    }
} 
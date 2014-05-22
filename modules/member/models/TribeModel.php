<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 5/22/14
 * Time: 1:30 AM
 */

namespace app\modules\member\models;


use app\modules\dao\ar\Taxonomy;

class TribeModel extends Taxonomy
{

    public function getParentName()
    {
        $query = self::findBySql("SELECT * FROM " . $this->tableName() . " WHERE id='" . $this->parent_id . "'")->one();
        return $query['name'];
    }
} 
<?php

namespace app\modules\member\models;


use app\modules\dao\ar\Taxonomy;

class BrevetAwardModel extends Taxonomy
{
    public function getParentName()
    {
        $query = self::findBySql("SELECT * FROM " . $this->tableName() . " WHERE id='" . $this->parent_id . "'")->one();
        return $query['name'];
    }
} 